<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Hybridauth_Form extends CBitrixComponent
{
    public $auth;

    function onPrepareComponentParams($params)
    {
        return array_merge($params, [
            "CALLBACK" => sprintf(
                "%s://%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
                $_SERVER["SERVER_NAME"])
                ."/bitrix/tools/vayti.hybridauth/auth.php"
        ]);
    }

    function checkModules()
    {
        if(!Loader::IncludeModule("vayti.hybridauth"))
            throw new Main\LoaderException("hybridauth not loaded");
    }

    function getResult()
    {
        $this->arResult["CALLBACK"] = $this->arParams["CALLBACK"];
    }

    /**
     * Для колбэка в hybridauth.auth
     * @throws \Hybridauth\Exception\RuntimeException
     */
    function saveCurrentPage()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").
            "://{$_SERVER["HTTP_HOST"]}{$_SERVER["REQUEST_URI"]}";
        if (strpos($url, '.min.js.map') === false) {
            $s = new \Hybridauth\Storage\Session();
            $s->set("CURRENT_PAGE", $url);
        }
    }

    function executeComponent()
    {
        global $USER, $APPLICATION;
        try
        {
            $this->checkModules();
            $this->getResult();
            $this->saveCurrentPage();
            $this->includeComponentTemplate();
        }
        catch(Exception $e)
        {
            pre("ОШИБКА:");
            pre($e);
            //ShowError($e->getMessage());
        }
    }
}