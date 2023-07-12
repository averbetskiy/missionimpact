<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

require_once("include/const.php");
require_once("include/events.php");
require_once("include/functions.php");
\Bitrix\Main\Loader::registerAutoLoadClasses(
    null, [
        "HighLoad" => "/local/php_interface/include/class/HighLoad.php"
    ]
);
spl_autoload_register(function ($className) {
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once __DIR__ . '/include/class/' . $className . '.php';
});
?>