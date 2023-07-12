<?

use \Bitrix\Main\Loader;
use \Bitrix\Iblock\SectionTable;
class SectionSynchronization
{

    const duplicatePropCode = 'UF_DUPLICATE'; //Код свойства "Дублировать элемент"
    const duplicateSectionIdPropCode = 'UF_DUPLICATE_SECTION'; //Код свойства "ID дублированного элемента"

    /**
     * Дублирование элемента на другие версии сайта
     * @param $curFields
     * @param bool $active
     * @param bool $duplicateSubSections
     * @throws
     */
    public static function SectionSync(&$curFields, $active = false, $duplicateSubSections = true)
    {
        if ($curFields['RESULT'] == false) return;
        if (!Loader::includeModule("iblock")) die();
        $newFields = static::getSectionNewFields($curFields, $active);
        $bs = new CIBlockSection;
        if ($newSectionId = $curFields[static::duplicateSectionIdPropCode]) {
            if (!$curFields[static::duplicatePropCode])
                $bs->Update($newSectionId, ['ACTIVE' => 'N']);
        } else {
            if (!$curFields[static::duplicatePropCode]) return;
            $newSectionId = $bs->Add($newFields);
            if ($newSectionId) {
                $bs->Update($curFields['ID'], [static::duplicateSectionIdPropCode => $newSectionId, static::duplicatePropCode => '1']);
            }
        }

        if ($duplicateSubSections && in_array($curFields['IBLOCK_ID'], [16, 145, 3, 136])) {
            static::TreeSync($curFields);
        }
    }

    /**
     * Синхронизация древа раздела
     * @param $curFields
     * @throws
     */
    protected static function TreeSync($curFields){
        $sectionIds = [$curFields['ID']];
        $section = SectionTable::GetByID($curFields['ID'])->Fetch();
        $entity = \Bitrix\Iblock\Model\Section::compileEntityByIblock($curFields['IBLOCK_ID']);
        if ($section && $entity){
            $rsSection = $entity::getList(array(
                'order' => array('LEFT_MARGIN'=>'ASC'),
                'filter' => array(
                    'IBLOCK_ID' => $curFields['IBLOCK_ID'],
                    'ACTIVE' => 'Y',
                    'GLOBAL_ACTIVE' => 'Y',
                    '>LEFT_MARGIN' => $section['LEFT_MARGIN'],
                    '<RIGHT_MARGIN' => $section['RIGHT_MARGIN'],
                    '>=DEPTH_LEVEL' => $section['DEPTH_LEVEL'],
                ),
                'select' =>  array(
                    '*',
                    'UF_*',
                ),
            ));
            while ($arSection = $rsSection->fetch()) {
                $ipropSectionValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection['IBLOCK_ID'],$arSection['ID']);
                $arSection['IPROPERTY_TEMPLATES'] = $ipropSectionValues->getValues();
                $arSection[static::duplicatePropCode] = '1';
                static::SectionSync($arSection, true, false);
                $sectionIds[] = $arSection['ID'];
            }
        }

        if (!empty($sectionIds)){
            $el = new CIBlockElement;

            $rsEnums = CIBlockPropertyEnum::GetList([], ["IBLOCK_ID"=>$curFields['IBLOCK_ID'], "CODE"=>"DUPLICATE"]);
            $duplicatePropertyEnumId = 0;
            if($enumField = $rsEnums->Fetch())
            {
                $duplicatePropertyEnumId = $enumField['ID'];
            }

            $rsElement = \Bitrix\Iblock\ElementTable::getList([
                'filter' => [
                    'IBLOCK_SECTION_ID' => $sectionIds,
                    'ACTIVE' => 'Y',
                ],
                'select' => [
                    'ID',
                    'IBLOCK_ID'
                ]
            ]);
            while ($arElement = $rsElement->fetch()) {
                CIBlockElement::SetPropertyValuesEx($arElement['ID'], false, ['DUPLICATE' => $duplicatePropertyEnumId, 'DUPLICATE_ACTIVE' => 'Y']);
                $el->Update($arElement['ID'], ['ACTIVE' => 'Y']);
            }
        }

    }


    /**
     * Изменение полей текущего элемента для дубликата
     * @param $curFields
     * @param bool $active
     * @return mixed
     */
    protected static function getSectionNewFields($curFields, $active = false)
    {
        $resSection = CIBlockSection::GetList(['id' => 'asc'], ['ID' => $curFields["ID"], 'IBLOCK_ID' => $curFields['IBLOCK_ID']], false, ['*', 'UF_*']);
        while ($arSection = $resSection->Fetch()) {
            $curFields = $arSection;
        }
        $newFields = $curFields;
        if ($active){
            $newFields['ACTIVE'] = 'Y';
        } else {
            $newFields['ACTIVE'] = 'N';
        }
        $newFields['IBLOCK_ID'] = static::getDuplicateIBlockId($curFields['IBLOCK_ID']);
        $newFields['IBLOCK_SECTION_ID'] = static::getDuplicateSectionId($curFields['IBLOCK_SECTION_ID'], $newFields['IBLOCK_ID']);
        $newFields[static::duplicateSectionIdPropCode] = $curFields['ID'];
        $newFields[static::duplicatePropCode] = true;
        if ($curFields['PICTURE'])
            $newFields['PICTURE'] = CFile::MakeFileArray($curFields['PICTURE']);
        if ($curFields['DETAIL_PICTURE'])
            $newFields['DETAIL_PICTURE'] = CFile::MakeFileArray($curFields['DETAIL_PICTURE']);
        return $newFields;
    }

    /**
     * Получение ID родительского раздела - дубликата
     * @param $sectionId
     * @param $duplicateIBlockId
     * @return int
     */
    protected static function getDuplicateSectionId($sectionId, $duplicateIBlockId)
    {
        if (!$sectionId) return $sectionId;
        $newSectionId = 0;

        $arFilter = ['ID' => $sectionId]; // выберет потомков без учета активности
        $arSelect = ['CODE']; // выберет потомков без учета активности
        $rsCurSection = CIBlockSection::GetList([], $arFilter, false, $arSelect);
        if ($arCurSection = $rsCurSection->Fetch()) {
            if ($arCurSection['CODE']) {
                $arFilter = ['IBLOCK_ID' => $duplicateIBlockId, 'CODE' => $arCurSection['CODE']]; // выберет потомков без учета активности
                $arSelect = ['ID']; // выберет потомков без учета активности
                $rsNewSection = CIBlockSection::GetList([], $arFilter, false, $arSelect);
                if ($arNewSection = $rsNewSection->Fetch()) {
                    $newSectionId = $arNewSection['ID'];
                }
            }
        }
        return $newSectionId;
    }

    /**
     * Получение ID инфоблок элемента - дубликата
     * @param $currentIBlockId
     * @return int
     */
    protected static function getDuplicateIBlockId($currentIBlockId)
    {
        $newIBlockId = 0;
        foreach (IBLOCK_IDS[IBLOCK_CONTST[$currentIBlockId]] as $iBlockId) {
            if ($currentIBlockId != $iBlockId)
                $newIBlockId = $iBlockId;
        }
        return $newIBlockId;
    }

}