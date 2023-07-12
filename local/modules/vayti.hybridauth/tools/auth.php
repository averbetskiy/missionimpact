<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$params = Context::getCurrent()->getRequest();

if(!Bitrix\Main\Loader::IncludeModule('vayti.hybridauth'))
{
    throw new \Bitrix\Main\SystemException("Module vayti.hybridauth not found");
}

$APPLICATION->IncludeComponent(
    "vayti:hybridauth.auth",
    ".default",
    array(
        "COMPONENT_TEMPLATE" => ".default",
        "PROVIDER" => $params["provider"],
        "CALLBACK" => (new \Hybridauth\Storage\Session())->get('CURRENT_PAGE') ?: null,
    ),
    false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");