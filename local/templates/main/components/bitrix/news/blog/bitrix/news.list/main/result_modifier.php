<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

$arSection = [];
$arSectionCount = [];
$rsSection = \Bitrix\Iblock\SectionTable::getList([
    'filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID']],
    'select' => ['ID','NAME','CODE']
]);
while($section = $rsSection->fetch()){
    $countSection = \Bitrix\Iblock\ElementTable::getCount(['IBLOCK_ID' => $arParams['IBLOCK_ID'],'IBLOCK_SECTION_ID' => $section['ID'],'ACTIVE' => 'Y']);
    if($countSection > 0) {
        $section['COUNT'] = $countSection;
        $arSection[$section['ID']] = $section;
    }
}

foreach ($arResult['ITEMS'] as &$item){
    $item['SECTION_NAME'] = $arSection[$item['IBLOCK_SECTION_ID']]['NAME'];
    $arSectionCount['COUNT'][$item['IBLOCK_SECTION_ID']] += 1;
    $arSectionCount['NAME'][$item['IBLOCK_SECTION_ID']] = $arSection[$item['IBLOCK_SECTION_ID']]['NAME'];
    if ($_COOKIE['mi_lang'] == 's2') {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,$item['DISPLAY_ACTIVE_FROM']));
    } else {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$item['DISPLAY_ACTIVE_FROM']));
    }
}
$arResult['COUNT_SECTION'] = $arSectionCount;
$arResult['SECTION'] = $arSection;
?>