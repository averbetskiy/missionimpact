<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
$site_info = CSite::GetByID(SITE_ID)->Fetch();
?>
<div class="login__popup-section" data-section="2">
    <div class="login__popup-head">
        <div class="login__popup-title"><a href="#" class="hoverMe changeSection" data-section="1" data-attr="<?=$arHandBook['SIGN_IN_BACK']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_BACK']['UF_VALUE']?></a></div>
        <div class="login__popup-areyou">
            <span><?=$arHandBook['SIGN_IN_NOT_MEMBER']['UF_VALUE']?></span>
            <a href="#" data-section="4" class="hoverMe changeSection" data-attr="<?=$arHandBook['SIGN_IN_REGISTER']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_REGISTER']['UF_VALUE']?></a>
        </div>
    </div>
    <div class="login__popup-resetWrap">
        <div class="login__popup-resetBox">
            <p class="login__popup-resetBox__title"><?=$arHandBook['SIGN_IN_RESET']['UF_VALUE']?></p>
            <div class="login__popup-resetBox__text"><p><?=$arHandBook['SIGN_IN_RESET_TEXT']['UF_VALUE']?></p></div>
            <form name="bform" method="post" class="login__popup-form forgot_form validation" action="<?=$arResult["AUTH_URL"]?>">
                <input type="hidden" name="AUTH_FORM" value="Y">
                <input type="hidden" name="TYPE" value="SEND_PWD">
                <div class="login__popup-form__group">
                    <div class="login__popup-form__name">
                        <label for="password"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></label>
                    </div>
                    <input type="email" name="USER_LOGIN" placeholder="example@example.com" value="<?=$arResult["USER_LOGIN"]?>" required aria-required="true" >
                    <input type="hidden" name="USER_EMAIL" />
                </div>
                <button type="submit" class="login__popup-form__button changeSection" data-section="3"><?=$arHandBook['SIGN_IN_RESET']['UF_VALUE']?></button>
            </form>
        </div>
    </div>
</div>
<div class="login__popup-section __fullHeight" data-section="3">
    <div class="login__popup-resetWrap">
        <div class="login__popup-resetBox">
            <p class="login__popup-resetBox__title"><?=$arHandBook['SIGN_IN_RESET']['UF_VALUE']?></p>
            <div class="login__popup-resetBox__text">
                <?=$arHandBook['SIGN_IN_RESET_FULL_TEXT']['UF_VALUE']?>
            </div>
        </div>
		<a href="mailto:<?=$site_info['EMAIL'];?>" class="login__popup-resetWrap__link hoverMe" data-attr="<?=$arHandBook['SIGN_IN_RESET_CONTACT']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_RESET_CONTACT']['UF_VALUE']?></a>
    </div>
</div>
