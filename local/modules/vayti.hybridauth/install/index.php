<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\ModuleManager;
use \Vayti\HybridAuth\HybridAuthTable;

Loc::loadMessages(__FILE__);

if (class_exists('vayti_hybridauth')) {
    return;
}

class vayti_hybridauth extends CModule
{
    public $MODULE_ID;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    public $MODULE_GROUP_RIGHTS;
    public $PARTNER_NAME;
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'vayti.hybridauth';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2019-05-20 14:39:14';
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Vayti";
        $this->PARTNER_URI = "https://www.vayti.ru/";
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        $this->installFiles();
        $this->InstallEvents();
    }

    public function getPath($excludeDocumentRoot = false)
    {
        if($excludeDocumentRoot)
        {
            return str_ireplace($_SERVER["DOCUMENT_ROOT"], '', dirname(__DIR__));
        }
        return dirname(__DIR__);
    }

    public function installFiles()
    { //todo не работает???
        CopyDirFiles($this->GetPath()."/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components");
        mkdir($_SERVER['DOCUMENT_ROOT'].'/bitrix/tools/'.$this->MODULE_ID);
        file_put_contents($_SERVER['DOCUMENT_ROOT'].'/bitrix/tools/'.$this->MODULE_ID.'/auth.php',
            '<? require($_SERVER["DOCUMENT_ROOT"]."'.$this->getPath(true).'/tools/auth.php");?>');
    }

    public function uninstallFiles()
    {   //todo deleting the whole folder is terrible
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/components/vayti');
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"] . '/bitrix/tools/'.$this->MODULE_ID);
    }


    public function doUninstall()
    {
        $this->uninstallDB();
        $this->uninstallFiles();
        $this->UnInstallEvents();
        ModuleManager::unregisterModule($this->MODULE_ID);
        DeleteDirFilesEx('/bitrix/tools/vayti.hybridauth/');
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            HybridAuthTable::getEntity()->createDbTable();
        }
    }

    function InstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->registerEventHandler("main", "OnUserDelete", "vayti.hybridauth", 'Vayti\\HybridAuth\\HybridAuthTable', "OnUserDelete");
        //RegisterModuleDependences("main", "OnUserDelete", "socialservices", "CSocServAuthDB", "OnUserDelete");
        return true;
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            Application::getConnection()->queryExecute('drop table if exists '.HybridAuthTable::getTableName());
        }
    }

    function UnInstallEvents()
    {
        $eventManager = \Bitrix\Main\EventManager::getInstance();
        $eventManager->unRegisterEventHandler("main", "OnUserDelete", "vayti.hybridauth", 'Vayti\\HybridAuth\\HybridAuthTable', "OnUserDelete");
//        UnRegisterModuleDependences("main", "OnUserDelete", "socialservices", "CSocServAuthDB", "OnUserDelete");
        return true;
    }
}
