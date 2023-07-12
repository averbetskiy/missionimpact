<?php

use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$arComponentParameters = [
    "PARAMETERS" => [
        "PROVIDER" => [
            "PARENT" => "BASE",
            "NAME" => "PROVIDER",
            "TYPE" => "STRING",
        ],
        "CALLBACK" => [
            "PARENT" => "BASE",
            "NAME" => "CALLBACK",
            "TYPE" => "STRING",
        ]
    ],
];