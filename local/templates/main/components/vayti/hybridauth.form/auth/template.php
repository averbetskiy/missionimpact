<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\UI\Extension::load("ui.alerts");
/** @var array $arParams */
/** @var array $arResult */
?>
<div class="login__popup-form__social-list">
    <a href="<?=$arResult["CALLBACK"]?>?provider=Google" class="login__popup-form__social-item" data-type="google"></a>
    <a href="<?=$arResult["CALLBACK"]?>?provider=Yandex" class="login__popup-form__social-item" data-type="yandex"></a>
<!--    <a href="<?=$arResult["CALLBACK"]?>?provider=Vkontakte" class="login__popup-form__social-item" data-type="vk"></a>-->
<!--    <a href="#" class="login__popup-form__social-item" data-type="apple"></a>-->
<!--    <a href="#" class="login__popup-form__social-item" data-type="outlook"></a>-->
<!--    <a href="#" class="login__popup-form__social-item" data-type="yahoo"></a>-->
</div>