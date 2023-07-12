<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $APPLICATION;
if ($arResult['CUSTOMER']){
    $APPLICATION->AddViewContent("USER_CUSTOMER_STATUS", $arResult['CUSTOMER']);
}
?>