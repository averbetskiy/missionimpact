<?

use Bitrix\Main\Loader;

class ElementSynchronization
{

    const duplicatePropCode = 'DUPLICATE'; //Код свойства "Дублировать элемент"
    const duplicateElementIdPropCode = 'DUPLICATE_ELEMENT'; //Код свойства "ID дублированного элемента"

    /**
     * Дублирование элемента на другие версии сайта
     * @param $curFields
     * @throws
     */
    public static function ElementSync(&$curFields)
    {
        if ($curFields['RESULT'] == false) return;
        if (!Loader::includeModule("iblock")) return;
        $currentProps = static::getElementProps($curFields['ID'], $curFields['IBLOCK_ID']);
        $newFields = static::getElementNewFields($curFields, $currentProps['DUPLICATE_ACTIVE']);
        $newFields["PROPERTY_VALUES"] = static::getPropsValues($currentProps, $newFields);
        $newFields["PROPERTY_VALUES"][static::duplicateElementIdPropCode] = $curFields['ID'];

        $el = new CIBlockElement;
        if ($newElementId = $currentProps[static::duplicateElementIdPropCode]['VALUE']) {
            if (!$currentProps[static::duplicatePropCode]['VALUE'])
                $el->Update($newElementId, ['ACTIVE' => 'N']);
        } else {
            if (!$currentProps[static::duplicatePropCode]['VALUE']) return;
            $newElementId = $el->Add($newFields);
            if ($newElementId) {
                CIBlockElement::SetPropertyValuesEx($curFields['ID'], $curFields['IBLOCK_ID'], [static::duplicateElementIdPropCode => $newElementId]);

                $newProps = static::getElementProps($newElementId, $newFields['IBLOCK_ID']);

                $newPropValues =
                    static::getNewPropEnums($newProps, $currentProps)
                    + static::getNewPropElements($newProps, $currentProps);
                CIBlockElement::SetPropertyValuesEx($newElementId, $newFields['IBLOCK_ID'], $newPropValues);
            }
        }
    }

    /**
     * Синхронизация свойств типа Привязка к элементу
     * @param array $newProps
     * @param array $currentProps
     * @return array $newValues
     */
    protected static function getNewPropElements($newProps, $currentProps)
    {
        $newValues = [];
        foreach ($newProps as $newProp) {
            if ($newProp['PROPERTY_TYPE'] !== 'E') continue;
            foreach ($currentProps as $currentProp) {
                $currentVal = array_filter($currentProp['VALUE']);
                if (!$currentVal) continue;
                if ($newProp['CODE'] == $currentProp['CODE']) {
                    $propValueElementIds = $currentVal;
                    $propValueElementCodes = static::getElementCodeById($propValueElementIds, $currentProp['LINK_IBLOCK_ID']);
                    if (!empty($propValueElementCodes)) {
                        $newValues[$newProp['CODE']] = static::getElementIdByCode($propValueElementCodes, $newProp['LINK_IBLOCK_ID']);
                    }
                }
            }
        }
        return $newValues;
    }

    /**
     * Получение символьного кода элемента по ID
     * @param mixed $propValueElementIds
     * @param int $iBlockId
     * @return array
     */
    protected static function getElementCodeById($propValueElementIds, $iBlockId)
    {
        if (empty($propValueElementIds)) return [];
        $arCodes = [];
        $arSelect = ["CODE"];
        $arFilter = ['ID' => $propValueElementIds, 'IBLOCK_ID' => $iBlockId];
        $resElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while ($arElement = $resElement->Fetch()) {
            if ($arElement['CODE']) {
                $arCodes[] = $arElement['CODE'];
            }
        }
        return $arCodes;
    }

    /**
     * Получение ID элемента по символьному коду
     * @param mixed $propValueElementCodes
     * @param int $iBlockId
     * @return array
     */
    protected static function getElementIdByCode($propValueElementCodes, $iBlockId)
    {
        if (empty($propValueElementCodes)) return [];
        $arIds = [];
        $arSelect = ["ID"];
        $arFilter = ['CODE' => $propValueElementCodes, 'IBLOCK_ID' => $iBlockId];
        $resElement = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while ($arElement = $resElement->Fetch()) {
            if ($arElement['ID'])
                $arIds[] = $arElement['ID'];
        }
        return $arIds;
    }

    /**
     * Синхронизация свойств типа Список
     * @param array $newProps
     * @param array $currentProps
     * @return array $newValues
     */
    protected static function getNewPropEnums($newProps, $currentProps)
    {
        $newValues = [];
        foreach ($newProps as $newProp) {
            if ($newProp['PROPERTY_TYPE'] !== 'L') continue;
            foreach ($currentProps as $currentProp) {
                if (!$currentProp['VALUE']) continue;
                if ($newProp['CODE'] == $currentProp['CODE']) {
                    if (is_array($currentProp['VALUE'])) {
                        foreach ($currentProp['VALUE'] as $propValue) {
                            $newValues[$newProp['CODE']][] = static::getDuplicateEnumValue($propValue, $currentProp, $newProp);
                        }
                    } else {
                        $newValues[$newProp['CODE']] = static::getDuplicateEnumValue($currentProp['VALUE'], $currentProp, $newProp);
                    }
                }
            }

        }
        return $newValues;
    }

    /**
     * Получил значение типа Список для элемента - дубликата
     * @param $propValue
     * @param $currentProp
     * @param $newProp
     * @return string $newValue
     */
    protected static function getDuplicateEnumValue($propValue, $currentProp, $newProp)
    {
        $currentEnumKey = array_search($propValue, array_column($currentProp['ENUM'], 'ID'));
        $xmlId = $currentProp['ENUM'][$currentEnumKey]['EXTERNAL_ID'];
        $newEnumKey = array_search($xmlId, array_column($newProp['ENUM'], 'XML_ID'));
        $newValue = $newProp['ENUM'][$newEnumKey]['ID'];
        return $newValue;
    }

    /**
     * Добавление элемента - дубликата
     * @param $newFields
     * @return mixed
     */
    protected static function addDuplicateElement($newFields)
    {
        $el = new CIBlockElement;
        $newElementId = $el->Add($newFields);
        return $newElementId;
    }

    /**
     * Получение значений свойств
     * @param array $currentProps
     * @param array $newFields
     * @return array
     */
    protected static function getPropsValues($currentProps, $newFields)
    {
        $arPropValues = [];
        foreach ($currentProps as $currentProp) {
            if (in_array($currentProp['PROPERTY_TYPE'], ['L', 'E'])
                || !$currentProp['VALUE']) continue;
            $arPropValues[$currentProp['CODE']] = $currentProp['VALUE'];
        }

        $rsEnum = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$newFields['IBLOCK_ID'], "CODE"=>"DUPLICATE"));
        while($arEnum = $rsEnum->Fetch())
        {
            $arPropValues[static::duplicatePropCode] = $arEnum['ID'];
        }

        return $arPropValues;
    }

    /**
     * Изменение полей текущего элемента для дубликата
     * @param $curFields
     * @param bool $active
     * @return mixed
     */
    protected static function getElementNewFields($curFields, $active = false)
    {
        $resElement = CIBlockElement::GetByID($curFields["ID"]);
        if ($arElement = $resElement->Fetch())
            $curFields = $arElement;

        $newFields = $curFields;
        if ($active){
            $newFields['ACTIVE'] = 'Y';
        } else {
            $newFields['ACTIVE'] = 'N';
        }
        $newFields['IBLOCK_ID'] = static::getDuplicateIblockId($curFields['IBLOCK_ID']);
        $newFields['IBLOCK_SECTION_ID'] = static::getDuplicateSectionId($curFields['IBLOCK_SECTION_ID'], $newFields['IBLOCK_ID']);
        if ($curFields['PREVIEW_PICTURE'])
            $newFields['PREVIEW_PICTURE'] = CFile::MakeFileArray($curFields['PREVIEW_PICTURE']);
        if ($curFields['DETAIL_PICTURE'])
            $newFields['DETAIL_PICTURE'] = CFile::MakeFileArray($curFields['DETAIL_PICTURE']);
        return $newFields;
    }

    protected static function getDuplicateSectionId($sectionId, $duplicateIBlockId){
        if (!$sectionId) return $sectionId;
        $newSectionId = 0;

        $arFilter = ['ID' => $sectionId]; // выберет потомков без учета активности
        $arSelect = ['CODE']; // выберет потомков без учета активности
        $rsCurSection = CIBlockSection::GetList([],$arFilter, false, $arSelect);
        if ($arCurSection = $rsCurSection->Fetch()){
            if ($arCurSection['CODE']){
                $arFilter = ['IBLOCK_ID' => $duplicateIBlockId, 'CODE' => $arCurSection['CODE']]; // выберет потомков без учета активности
                $arSelect = ['ID']; // выберет потомков без учета активности
                $rsNewSection = CIBlockSection::GetList([],$arFilter, false, $arSelect);
                if ($arNewSection = $rsNewSection->Fetch()){
                    $newSectionId = $arNewSection['ID'];
                }
            }
        }
        return $newSectionId;
    }

    /**
     * Получение свойств элемента
     * @param $elementId
     * @param $iBlockId
     * @return array
     */
    protected static function getElementProps($elementId, $iBlockId)
    {
        $arProps = [];
        $resProp = CIBlockElement::GetProperty($iBlockId, $elementId, ['sort' => 'asc']);
        while ($arPropItem = $resProp->Fetch()) {
            $arPropValues[$arPropItem['CODE']][] = $arPropItem['VALUE'];

            $resEnum = CIBlockProperty::GetPropertyEnum($arPropItem['ID'], [], []);
            while ($arEnum = $resEnum->Fetch())
                $arPropItem['ENUM'][] = $arEnum;
            if (isset($arProps[$arPropItem['CODE']])) {
                $arProps[$arPropItem['CODE']]['VALUE'][] = $arPropItem['VALUE'];
            } else {
                $arProps[$arPropItem['CODE']] = $arPropItem;
                if ($arPropItem['MULTIPLE'] == 'Y')
                    $arProps[$arPropItem['CODE']]['VALUE'] = [$arPropItem['VALUE']];
            }
        }
        return $arProps;
    }

    /**
     * Получение ID инфоблок элемента - дубликата
     * @param $currentIBlockId
     * @return int
     */
    protected static function getDuplicateIblockId($currentIBlockId)
    {
        $newIBlockId = 0;
        foreach (IBLOCK_IDS[IBLOCK_CONTST[$currentIBlockId]] as $iBlockId) {
            if ($currentIBlockId != $iBlockId)
                $newIBlockId = $iBlockId;
        }
        return $newIBlockId;
    }

    /**
     * @deprecated
     * Получение ID сайта
     * @param $iBlockId
     * @return bool
     */
    protected static function getSiteId($iBlockId)
    {
        $siteId = false;
        $resIBlock = CIBlock::GetList([], ['ID' => $iBlockId]);
        if ($arIBlockItem = $resIBlock->Fetch()) {
            $siteId = $arIBlockItem['LID'];
        }
        return $siteId;
    }
}