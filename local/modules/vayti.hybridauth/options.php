<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();
defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'vayti.hybridauth');

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;

if (!$USER->isAdmin()) {
    $APPLICATION->authForm('Nope');
}

$app = Application::getInstance();
$context = $app->getContext();
$request = $context->getRequest();

Loc::loadMessages($context->getServer()->getDocumentRoot() . "/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET"),
    ),
));
If(!\Bitrix\Main\Loader::IncludeModule('vayti.hybridauth'))
    throw new Bitrix\Main\LoaderException("Failed to load module");
$providers = \Vayti\HybridAuth\Auth::$providers;

if ((!empty($save) || !empty($restore)) && $request->isPost() && check_bitrix_sessid()) {
    //Providers
    foreach ($providers as $providerKey){
        Option::set(
                ADMIN_MODULE_NAME,
                "{$providerKey}_enabled",
                $request->getPost("{$providerKey}_enabled") == 'Y' ? 'Y' : 'N'
        );
        Option::set(
            ADMIN_MODULE_NAME,
            "{$providerKey}_private_key",
            $request->getPost("{$providerKey}_private_key")
        );
        Option::set(
            ADMIN_MODULE_NAME,
            "{$providerKey}_secret_key",
            $request->getPost("{$providerKey}_secret_key")
        );
    }

    CAdminMessage::showMessage(array(
        "MESSAGE" => Loc::getMessage("REFERENCES_OPTIONS_SAVED"),
        "TYPE" => "OK",
    ));
}



$tabControl->begin();
?>

<form method="post"
      action="<?= sprintf('%s?mid=%s&lang=%s', $request->getRequestedPage(), urlencode($mid), LANGUAGE_ID) ?>">
    <?= bitrix_sessid_post() ?>
    <? $tabControl->beginNextTab(); ?>
    <? foreach ($providers as $providerKey): ?>
        <tr class="heading">
            <td colspan="2"><?= Loc::getMessage("REFERENCES_" . strtoupper($providerKey) . "_TITLE") ?></td>
        </tr>
        <tr>
            <td width="40%">
                <label for="<?= $providerKey ?>_enabled"><?= Loc::getMessage("REFERENCES_ENABLED") ?></label>
            </td>
            <td width="60%">
                <input type="checkbox"
                       id="<?=$providerKey?>_enabled"
                       name="<?=$providerKey?>_enabled"
                       value="Y"
                       <?=Option::get(ADMIN_MODULE_NAME, "{$providerKey}_enabled") == 'Y' ? 'checked' : ''?>
            </td>
        </tr>
        <tr>
            <td width="40%">
                <label for="<?= $providerKey ?>_private_key"><?= Loc::getMessage("REFERENCES_PRIVATE_KEY") ?></label>
            <td width="60%">
                <input type="text"
                       id="<?= $providerKey ?>_private_key"
                       size="50"
                       name="<?= $providerKey ?>_private_key"
                       value="<?=Option::get(ADMIN_MODULE_NAME, "{$providerKey}_private_key", '');?>"
                />
            </td>
        </tr>
        <tr>
            <td width="40%">
                <label for="<?= $providerKey ?>_secret_key"><?= Loc::getMessage("REFERENCES_SECRET_KEY") ?></label>
            <td width="60%">
                <input type="text"
                       id="<?= $providerKey ?>_secret_key"
                       size="50"
                       name="<?= $providerKey ?>_secret_key"
                       value="<?=Option::get(ADMIN_MODULE_NAME, "{$providerKey}_secret_key", '');?>"
                />
            </td>
        </tr>
    <? endforeach; ?>
    <? $tabControl->EndTab(); ?>

    <? $tabControl->buttons(); ?>
    <input type="submit"
           name="save"
           value="<?= Loc::getMessage("MAIN_SAVE") ?>"
           title="<?= Loc::getMessage("MAIN_OPT_SAVE_TITLE") ?>"
           class="adm-btn-save"
    />
    <? $tabControl->end(); ?>
</form>
