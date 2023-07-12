<? /** @var $block array */?>
<?
global $APPLICATION;
$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "project",
    array(
        "AJAX_MODE" => "N",
        "SEF_MODE" => "N",
        "WEB_FORM_ID" => $block['form']['value'],
        "RESULT_ID" => $_REQUEST["RESULT_ID"],
        "START_PAGE" => "new",
        "SHOW_LIST_PAGE" => "Y",
        "SHOW_EDIT_PAGE" => "Y",
        "SHOW_VIEW_PAGE" => "Y",
        "SUCCESS_URL" => "",
        "SHOW_ANSWER_VALUE" => "Y",
        "SHOW_ADDITIONAL" => "Y",
        "SHOW_STATUS" => "Y",
        "EDIT_ADDITIONAL" => "Y",
        "EDIT_STATUS" => "Y",
        "NOT_SHOW_FILTER" => "",
        "NOT_SHOW_TABLE" => "",
        "CHAIN_ITEM_TEXT" => "",
        "CHAIN_ITEM_LINK" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "Y",
        "USE_EXTENDED_ERRORS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "SEF_FOLDER" => "/",
        "COMPONENT_TEMPLATE" => "",
        "LIST_URL" => "result_list.php",
        "EDIT_URL" => "result_edit.php",
        "VARIABLE_ALIASES" => array(
            "WEB_FORM_ID" => "WEB_FORM_ID",
            "RESULT_ID" => "RESULT_ID",
        )
    ),
    false
);
?>
