<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

$arResult['DATE'] = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$arResult['DISPLAY_ACTIVE_FROM']));

if($duplicate = duplicateElement($arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE'])){
}else{
    $duplicate['DETAIL_PAGE_URL'] = $arResult['LIST_PAGE_URL'];
}
$arResult['DUPLICATE'] = $duplicate;

$moduleSectionId = $arResult['PROPERTIES']['MODULES_SECTION_ID']['VALUE'];
if ($moduleSectionId) {
    $moduleEntity = \Bitrix\Iblock\Iblock::wakeUp(MODULES)->getEntityDataClass();

    $module = $moduleEntity::getRow([
        'select' => [
            'ID',
        ],
        'filter' => [
            'IBLOCK_SECTION_ID' => $moduleSectionId,
            'ACTIVE' => 'Y',
        ],
        'order' => ['SORT' => 'ASC']
    ]);

    if ($module) {
        $arResult['MODULE'] = $module;
    }
}
?>