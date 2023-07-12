<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\UI\Extension::load("ui.alerts");
/** @var array $arParams */
/** @var array $arResult */

$providers = [];
foreach ($arResult['ITEMS'] as $item) {
    $providers[] = $item['EXTERNAL_SITE'];
}
$arResult['PROVIDERS'] = $providers;