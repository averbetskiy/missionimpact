<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\UI\Extension::load("ui.alerts");
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;

$arParams['PROVIDERS'] = $arParams['PROVIDERS'] ?: [];
?>

    <? if (!in_array('Vkontakte', $arParams['PROVIDERS'])) { ?>
        <div class="popup__settings-login__sso-item">
            <div class="popup__settings-login__social" data-type="vk">VK</div>
            <a href="<?=$arResult["CALLBACK"]?>?provider=Vkontakte"
               class="popup__settings-login__social-unlink hoverMe"
               data-attr="<?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>">
                <?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>
            </a>
        </div>
    <? } ?>

    <? if (!in_array('Google', $arParams['PROVIDERS'])) { ?>
        <div class="popup__settings-login__sso-item">
            <div class="popup__settings-login__social" data-type="google">Google</div>
            <a href="<?=$arResult["CALLBACK"]?>?provider=Google"
               class="popup__settings-login__social-unlink hoverMe"
               data-attr="<?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>">
                <?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>
            </a>
        </div>
    <? } ?>

    <? if (!in_array('Yandex', $arParams['PROVIDERS'])) { ?>
        <div class="popup__settings-login__sso-item">
            <div class="popup__settings-login__social" data-type="yandex">Yandex</div>
            <a href="<?=$arResult["CALLBACK"]?>?provider=Yandex"
               class="popup__settings-login__social-unlink hoverMe"
               data-attr="<?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>">
                <?= $arHandBook['PROFILE_SETTINGS_SOCIAL_LINK']['UF_VALUE'] ?>
            </a>
        </div>
    <? } ?>
