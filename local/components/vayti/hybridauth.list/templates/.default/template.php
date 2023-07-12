<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\UI\Extension::load("ui.alerts");
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
?>
<div class="popup__settings-login__sso">
    <div class="popup__settings-login__sso-title"><?= $arHandBook['PROFILE_SETTINGS_SOCIAL']['UF_VALUE'] ?></div>
    <div class="popup__settings-login__sso-list">
        <? foreach ($arResult['ITEMS'] as $item) { ?>
            <div class="popup__settings-login__sso-item">
                <? if ($item['EXTERNAL_SITE'] == 'Vkontakte') { ?>
                    <div class="popup__settings-login__social" data-type="vk">VK</div>
                <? } ?>
                <? if ($item['EXTERNAL_SITE'] == 'Google') { ?>
                    <div class="popup__settings-login__social" data-type="google">Google</div>
                <? } ?>
                <? if ($item['EXTERNAL_SITE'] == 'Yandex') { ?>
                    <div class="popup__settings-login__social" data-type="yandex">Yandex</div>
                <? } ?>
                <a data-action="auth_unlink" data-provider="<?= $item['EXTERNAL_SITE'] ?>" href="#"
                   class="popup__settings-login__social-unlink hoverMe"
                   data-attr="<?= $arHandBook['PROFILE_SETTINGS_SOCIAL_UNLINK']['UF_VALUE'] ?>">
                    <?= $arHandBook['PROFILE_SETTINGS_SOCIAL_UNLINK']['UF_VALUE'] ?>
                </a>
            </div>
        <? } ?>

        <? $APPLICATION->IncludeComponent(
            "vayti:hybridauth.form",
            "settings",
            array(
                "COMPONENT_TEMPLATE" => "settings",
                'PROVIDERS' => $arResult['PROVIDERS']
            ),
            false
        ); ?>

    </div>
</div>