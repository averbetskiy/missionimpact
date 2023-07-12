<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
?>
<div class="login__popup-section active" data-section="1">
    <div class="login__popup-head">
        <div class="login__popup-title"><?=$arHandBook['SIGN_IN']['UF_VALUE']?></div>
        <div class="login__popup-areyou">
            <span><?=$arHandBook['SIGN_IN_NOT_MEMBER']['UF_VALUE']?></span>
            <a href="#" class="hoverMe changeSection" data-section="4" data-attr="<?=$arHandBook['SIGN_IN_REGISTER']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_REGISTER']['UF_VALUE']?></a>
        </div>
    </div>
    <div class="login__popup-body">
		<p class="login__popup-user__error"><?=$arHandBook['SIGN_IN_USER_NOT_ACTIVE']['UF_VALUE']?></p>
		<form action="<?php //$arResult["AUTH_URL"];?>/personal/profile/" method="POST" class="login__popup-form auth_form validation" name="system_auth_form<?=$arResult["RND"]?>">
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />
            <div class="login__popup-form__group">
                <div class="login__popup-form__name">
                    <label for="email"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></label>
                </div>
                <input type="email" name="USER_LOGIN" placeholder="example@example.com" required aria-required="true" class="ajax-check-login">
            </div>
            <div class="login__popup-form__group">
                <div class="login__popup-form__name">
                    <label for="password"><?=$arHandBook['SIGN_IN_PASSWORD']['UF_VALUE']?></label>
                    <a href="#" class="changeSection" data-section="2"><?=$arHandBook['SIGN_IN_FORGOT']['UF_VALUE']?></a>
                </div>
				<div class="login__popup-form__password">
					<input type="text" name="USER_PASSWORD" placeholder="<?=$arHandBook['ENTER_PASSWORD']['UF_VALUE']?>" required aria-required="true" data-rule-password="true" class="ajax-check-password">
					<span class="login__popup-form__password-hide"></span>
				</div>
			</div>
            <div class="login__popup-form__checkboxes">
                <div class="login__popup-form__checkbox">
                    <input type="checkbox" name="USER_REMEMBER" value="Y" id="signterms">
                    <label for="signterms"><?=$arHandBook['SIGN_IN_REMEMBER']['UF_VALUE']?></label>
                </div>
            </div>
            <button type="submit" class="login__popup-form__button"><?=$arHandBook['SIGN_IN_ENTER']['UF_VALUE']?></button>
        </form>
        <div class="login__popup-form__social">
            <div class="login__popup-form__social-title"><span><?=$arHandBook['SIGN_IN_SOCIAL']['UF_VALUE']?></span></div>
            <? $APPLICATION->IncludeComponent(
                "vayti:hybridauth.form",
                "auth",
                array(
                    "COMPONENT_TEMPLATE" => ".default",
                ),
                false
            ); ?>
        </div>
    </div>
</div>