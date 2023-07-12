<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use Vayti\HybridAuth\Auth;

Loc::loadMessages(__FILE__);

class Hybridauth_Auth extends CBitrixComponent
{
    public $auth;

    function onPrepareComponentParams($params)
    {
        return [
            "PROVIDER" => $params["PROVIDER"],
            "CALLBACK" => $params["CALLBACK"] ?: sprintf(
                "%s://%s",
                isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http', $_SERVER["SERVER_NAME"]),
        ];
    }

    function checkModules()
    {
        if(!Loader::IncludeModule("vayti.hybridauth"))
            throw new Main\LoaderException("hybridauth not loaded");
    }

    function Authorize()
    {
        $this->auth->login(true);//$this->arParams["CALLBACK"]);
    }

    function executeComponent()
    {
        global $USER, $APPLICATION;
        $status = 'success';
        try {
            $callback = $this->arParams["CALLBACK"];
            $this->checkModules();
            //$callback = false; //debug
            $provider = $this->arParams["PROVIDER"];
            $this->auth = new Auth($provider);
            $this->Authorize();
        }
        catch(Exception $e)
        {
            CEventLog::Add(
                [
                    'SEVERITY' => 'ERROR',
                    'MODULE_ID' => 'vayti.hybridauth',
                    'ITEM_ID' => $USER->GetID(),
                    'AUDIT_TYPE_ID' => 'HAUTH_ERROR',
                    'DESCRIPTION' => $e->getMessage(),
                ]);
            $APPLICATION->set_cookie('auth_error', $e->getMessage(), time() + 60);
            $status = 'failed';
        }
        finally
        {
            if($callback)
            {
                $url = parse_url($callback);
                if ($url['path'] == null) {
                    $callback .= '/';
                }
                if($url['query']) //rebuild the http query
                {
                    $s = [];
                    parse_str($url['query'], $s);
                    $s["auth"] = $status;
                    $get = http_build_query($s);
                    $sub = substr($callback, 0, strpos($callback, '?')+1); //get url without query
                } else {
                    $get = "?auth=$status";
                    $sub = $callback;
                }
                LocalRedirect($sub . $get);
            }
        }
    }
}