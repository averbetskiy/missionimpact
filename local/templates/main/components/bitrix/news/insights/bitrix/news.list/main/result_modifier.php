<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$arTabs = [];
foreach ($arResult['ITEMS'] as &$item){
    $arTabs[$item['PROPERTIES']['type']['VALUE_XML_ID']] = $item['PROPERTIES']['type']['VALUE'];
    if ($_COOKIE['mi_lang'] == 's2') {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,$item['DISPLAY_ACTIVE_FROM']));
    } else {
        $item['DISPLAY_ACTIVE_FROM'] = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$item['DISPLAY_ACTIVE_FROM']));
    }
}
$arResult['TABS'] = $arTabs;
?>