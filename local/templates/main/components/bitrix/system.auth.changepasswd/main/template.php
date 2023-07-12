<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
if($_POST['USER_PASSWORD'] && $_POST['USER_CONFIRM_PASSWORD']){
    LocalRedirect('/');
}
?>
<div class="profileSample__box-title"><?=$arHandBook['PROFILE_NEW_PASSWORD']['UF_VALUE']?></div>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" class="login__popup-form validation">
    <input type="hidden" name="AUTH_FORM" value="Y">
    <input type="hidden" name="TYPE" value="CHANGE_PWD">
    <input type="hidden" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input" autocomplete="off" />
    <input type="hidden" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="bx-auth-input" />
    <div class="login__popup-form__group">
        <div class="login__popup-form__name">
            <label for="password"><?=$arHandBook['SIGN_IN_PASSWORD']['UF_VALUE']?></label>
        </div>
		<div class="login__popup-form__password">
        	<input type="text" name="USER_PASSWORD" placeholder="<?=$arHandBook['PROFILE_ENTER_PASSWORD']['UF_VALUE']?>" value="<?=$arResult["USER_PASSWORD"]?>" required aria-required="true" data-rule-password="true">
			<span class="login__popup-form__password-hide"></span>
		</div>
	</div>
    <div class="login__popup-form__group">
        <div class="login__popup-form__name">
            <label for="repeat"><?=$arHandBook['PROFILE_REPEAT']['UF_VALUE']?></label>
        </div>
		<div class="login__popup-form__password">
        	<input type="text" name="USER_CONFIRM_PASSWORD" placeholder="<?=$arHandBook['PROFILE_CONFIRM_PASSWORD']['UF_VALUE']?>" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" required aria-required="true" data-rule-password="true">
			<span class="login__popup-form__password-hide"></span>
		</div>
	</div>
    <button type="submit" class="login__popup-form__button hoverMe" data-attr="<?=$arHandBook['PROFILE_SAVE_PASSWORD']['UF_VALUE']?>"><?=$arHandBook['PROFILE_SAVE_PASSWORD']['UF_VALUE']?></button>
</form>
