<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class Hybridauth_List extends CBitrixComponent
{
    public $auth;

    function onPrepareComponentParams($params)
    {
        return $params;
    }

    function checkModules()
    {
        if(!Loader::IncludeModule("vayti.hybridauth"))
            throw new Main\LoaderException("hybridauth not loaded");
    }

    function getResult()
    {
        global $USER;
        if ($USER->GetID()) {
            $this->arResult["ITEMS"] = \Vayti\HybridAuth\Auth::getUserAuths($USER->GetID(), false);
        }
    }

    function executeComponent()
    {
        global $USER, $APPLICATION;
        try
        {
            $this->checkModules();
            $this->getResult();
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