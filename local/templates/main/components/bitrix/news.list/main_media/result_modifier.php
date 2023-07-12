<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

$arSection = [];
$rsSection = \Bitrix\Iblock\SectionTable::getList([
    'filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID']],
    'select' => ['ID','NAME']
]);
while($section = $rsSection->fetch()){
    $arSection[$section['ID']] = $section['NAME'];
}
foreach ($arResult['ITEMS'] as &$item){
    $item['SECTION_NAME'] = $arSection[$item['IBLOCK_SECTION_ID']];
    if ($_COOKIE['mi_lang'] == 's2') {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH, RU_SHORT_MONTH2, $item['DISPLAY_ACTIVE_FROM']));
    } else {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$item['DISPLAY_ACTIVE_FROM']));
    }
}
?>