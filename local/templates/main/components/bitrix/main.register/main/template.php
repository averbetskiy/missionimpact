<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
 ?>
<div class="login__popup-section" data-section="4">
            <div class="login__popup-head">
                <div class="login__popup-title"><?=$arHandBook['SIGN_IN_TITLE']['UF_VALUE']?></div>
                <div class="login__popup-areyou">
                    <span><?=$arHandBook['SIGN_IN_MEMBER']['UF_VALUE']?></span>
                    <a href="#" class="hoverMe changeSection" data-section="1" data-attr="<?=$arHandBook['SIGN_IN_LOG_IN']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_LOG_IN']['UF_VALUE']?></a>
                </div>
            </div>
            <div class="login__popup-body regform">
                <?if (!$arResult["ERRORS"]) { ?>
                    <form method="post" action="<?= POST_FORM_ACTION_URI ?>" name="regform" id="regform" class="login__popup-form" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="register">
                        <div class="login__popup-form__group __half">
                            <div class="login__popup-form__name">
                                <label for="firstname"><?=$arHandBook['SIGN_IN_NAME']['UF_VALUE']?></label>
                            </div>
                            <input type="text" name="REGISTER[NAME]" placeholder="Mary" required aria-required="true" data-rule-nonumber="true">
                        </div>
                        <div class="login__popup-form__group __half">
                            <div class="login__popup-form__name">
                                <label for="lastname"><?=$arHandBook['SIGN_IN_LAST_NAME']['UF_VALUE']?></label>
                            </div>
                            <input type="text" name="REGISTER[LAST_NAME]" placeholder="Jane" required aria-required="true" data-rule-nonumber="true">
                        </div>
                        <div class="login__popup-form__group">
                            <div class="login__popup-form__name">
                                <label for="email"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></label>
                            </div>
                            <input type="email" name="REGISTER[LOGIN]" placeholder="example@example.com" required aria-required="true" class="ajax-check-email">
                            <input type="hidden" name="REGISTER[EMAIL]">
                        </div>
                        <div class="login__popup-form__group">
                            <div class="login__popup-form__name">
                                <label for="password"><?=$arHandBook['SIGN_IN_PASSWORD']['UF_VALUE']?></label>
                                <a href="#" id="generate__password"><?=$arHandBook['SIGN_IN_GENEREATE']['UF_VALUE']?></a>
                            </div>
							<div class="login__popup-form__password">
								<input type="text" name="REGISTER[PASSWORD]" data-rule-password="true" placeholder="<?=$arHandBook['SIGN_IN_GENEREATE_PLACE']['UF_VALUE']?>" required aria-required="true">
								<span class="login__popup-form__password-hide"></span>
							</div>
                            <input type="hidden" name="REGISTER[CONFIRM_PASSWORD]">
                        </div>
                        <div class="login__popup-form__checkboxes">
                            <div class="login__popup-form__checkbox login__popup-form__group">
                                <input type="checkbox" name="terms" id="regterms" required aria-required="true">
                                <label for="regterms" class="regterms_label"><?=$arHandBook['SIGN_IN_GENEREATE_TERMS']['UF_VALUE']?></label>
                            </div>
                            <div class="login__popup-form__checkbox">
                                <input type="checkbox" name="subscribe" value="0" id="regsubscribe">
                                <label for="regsubscribe"><?=$arHandBook['SIGN_IN_SUBSCRIBE']['UF_VALUE']?></label>
                            </div>
                        </div>
                        <button type="submit" class="login__popup-form__button changeSection" data-section="7" name="register_submit_button"
                                value="Register"><?=$arHandBook['SIGN_IN_BUTTON']['UF_VALUE']?></button>
                    </form>
                <?}else{?>
                    <?foreach ($arResult["ERRORS"] as $error){?>
                        <?=$error.'<br>'?>
                    <?}?>
                <?}?>
				<div class="login__popup-form__social">
                    <div class="login__popup-form__social-title"><span><?=$arHandBook['REGISTER_SOCIAL']['UF_VALUE']?></span></div>
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
            <!-- <div class="regform_success" style="display:none;text-align: center;">
                <p><?=$arHandBook['SIGN_IN_CONFIRM_EMAIL']['UF_VALUE']?></p>
            </div> -->
        </div>
<div class="login__popup-section __fullHeight" data-section="7">
    <div class="login__popup-resetWrap">
        <div class="login__popup-resetBox __confirm">
            <p class="login__popup-resetBox__title"><?=$arHandBook['REGISTER_CONFIRM_TITLE']['UF_VALUE']?></p>
            <div class="login__popup-resetBox__text">
                <?=$arHandBook['REGISTER_CONFIRM_TEXT']['UF_VALUE']?>
            </div>
        </div>
		<a href="mailto:<?=$site_info['EMAIL'];?>" class="login__popup-resetWrap__link hoverMe" data-attr="<?=$arHandBook['SIGN_IN_RESET_CONTACT']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_RESET_CONTACT']['UF_VALUE']?></a>
    </div>
</div>