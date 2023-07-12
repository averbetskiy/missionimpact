<? /** @var $block array */?>
<?
global $APPLICATION;
$APPLICATION->IncludeComponent(
    "bitrix:voting.current",
    "main",
    array(
        "AJAX_MODE" => "Y",
        "AJAX_OPTION_ADDITIONAL" => "main",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHANNEL_SID" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "VOTE_ALL_RESULTS" => "Y",
        "VOTE_ID" => $block['poll']['value']
    )
);
?>
