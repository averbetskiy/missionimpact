<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

require_once('vendors/hybridauth/src/autoload.php');

//Loader::registerAutoLoadClasses('vayti.hybridauth', array(
//    'Vayti\HybridAuth\HybridAuthTable' => 'lib/HybridAuthTable.php',
//    'Vayti\HybridAuth\HybridAuthProvider' => 'lib/HybridAuthProvider.php',
//    'Vayti\HybridAuth\Providers\Yandex' => 'lib/providers/Yandex.php',
//    'Vayti\HybridAuth\Providers\Mailru' => 'lib/providers/Mailru.php',
//));
//
//EventManager::getInstance()->addEventHandler('main', 'OnAfterUserAdd', function(){
//    // do something when new user added
//});
