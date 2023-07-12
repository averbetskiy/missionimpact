<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

if ($_COOKIE['mi_lang'] == 's2') {
    $arResult['DATE'] = ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,$arResult['DISPLAY_ACTIVE_FROM']));
} else {
    $arResult['DATE'] = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$arResult['DISPLAY_ACTIVE_FROM']));
}
if($duplicate = duplicateElement($arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE'])){
}else{
    $duplicate['DETAIL_PAGE_URL'] = $arResult['LIST_PAGE_URL'];
}
$arResult['DUPLICATE'] = $duplicate;
?>