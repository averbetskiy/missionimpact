<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
?>

<?//$APPLICATION->IncludeComponent(
//    "bitrix:voting.form",
//    ".default",
//    Array(
//        "VOTE_ID" => $arResult["VOTE_ID"],
//        "VOTE_ASK_CAPTCHA" => $arParams["VOTE_ASK_CAPTCHA"],
//        "PERMISSION" => $arParams["PERMISSION"],
//        "VOTE_RESULT_TEMPLATE" => $arResult["VOTE_RESULT_TEMPLATE"],
//        "ADDITIONAL_CACHE_ID" => $arResult["ADDITIONAL_CACHE_ID"],
//        "CACHE_TIME" => $arParams["CACHE_TIME"],
//        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//    ),
//    ($this->__component->__parent ? $this->__component->__parent : $component)
//);?>

<?
if ($arParams["SHOW_RESULTS"] == "Y")
{
?>
<?//$APPLICATION->IncludeComponent("bitrix:voting.result", ".default",
//        Array(
//            "VOTE_ID" => $arResult["VOTE_ID"],
//            "CACHE_TIME" => $arParams["CACHE_TIME"],
//            "PERMISSION" => $arParams["PERMISSION"],
//            "ADDITIONAL_CACHE_ID" => $arResult["ADDITIONAL_CACHE_ID"],
//            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
//            "VOTE_ALL_RESULTS" => $arParams["VOTE_ALL_RESULTS"],
//            "CAN_VOTE" => $arParams["CAN_VOTE"]),
//        ($this->__component->__parent ? $this->__component->__parent : $component),
//        array("HIDE_ICONS" => "Y")
//    );?>
<?
}
?>