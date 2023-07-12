<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

if($duplicate = duplicateElement($arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE'])){
}else{
$duplicate['DETAIL_PAGE_URL'] = $arResult['LIST_PAGE_URL'];
}
$arResult['DUPLICATE'] = $duplicate;