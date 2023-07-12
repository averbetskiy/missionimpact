<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
$arUser = $arResult['arUser'];
?>
<div class="profile__popup" id="settings">
    <div class="profile__popup-overlay"></div>
    <div class="profile__popup-inner">
        <div class="profile__popup-close">x</div>
        <div class="profile__popup-wrap">
            <div class="popup__settings-title profile__popup-title"><?=$arHandBook['PROFILE_SETTINGS']['UF_VALUE']?></div>
            <div class="popup__settings-section">
                <div class="popup__settings-section__title"><?=$arHandBook['PROFILE_LOGIN_DETAILS']['UF_VALUE']?></div>
                <div class="popup__settings-sections">
                    <div class="popup__settings-login__section active">
                        <div class="popup__settings-login__row">
                            <div class="popup__settings-login__col">
                                <div class="popup__settings-login__label"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></div>
                                <div class="popup__settings-login__value"><?=$arUser['EMAIL']?></div>
                            </div>
                            <div class="popup__settings-login__col">
                                <div class="popup__settings-login__label"><?=$arHandBook['SIGN_IN_PASSWORD']['UF_VALUE']?></div>
                                <div class="popup__settings-login__value passwordHidden">Ztd~ggp_Iy)uLuc</div>
                            </div>
                            <div class="popup__settings-login__col">
<!--                                <div class="popup__settings-login__label">Single Sign On</div>-->
<!--                                <div class="popup__settings-login__value">-->
<!--                                    <div class="popup__settings-login__social" data-type="google">Google</div>-->
<!--                                </div>-->
                            </div>
                        </div>
                        <div class="popup__settings-login__edit">
                            <a href="#" class="hoverMe" data-attr="<?=$arHandBook['PROFILE_EDIT_SETTINGS']['UF_VALUE']?>"><?=$arHandBook['PROFILE_EDIT_SETTINGS']['UF_VALUE']?></a>
                        </div>
                    </div>
                    <div class="popup__settings-login__section">
                        <form action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data" method="POST" class="popup__settings-login__form  validation_profile settings_profile_form">
                            <input type="hidden" name="action" value="settings_profile">
                            <input type="hidden" name="user" value="<?=$arUser['ID']?>">
                            <div class="popup__settings-login__group profile__popup-form__group input_group">
                                <label for="loginemail"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></label>
                                <input name="USER_LOGIN" id="loginemail" class="profile_login" type="email" placeholder="gert@mail.com" required aria-required="true" value="<?=$arUser['EMAIL']?>" data-login="<?=$arUser['EMAIL']?>">
                            </div>
                            <div class="popup__settings-login__group profile__popup-form__group input_group">
                                <label for="logincurrentpass"><?=$arHandBook['PROFILE_CURRENT_PASS']['UF_VALUE']?></label>
                                <input name="USER_PASSWORD" id="logincurrentpass" type="text" placeholder="Enter Password" required aria-required="true" data-rule-password="true" class="ajax-check-password-profile">
                            </div>
                            <div class="popup__settings-login__group profile__popup-form__group __half input_group">
                                <label for="loginnewpass"><?=$arHandBook['PROFILE_NEW_PASS']['UF_VALUE']?></label>
                                <input name="NEW_PASSWORD" id="loginnewpass" type="text" placeholder="Enter Password">
                            </div>
                            <div class="popup__settings-login__group profile__popup-form__group __half input_group">
                                <label for="loginnewpass2"><?=$arHandBook['PROFILE_NEW_PASS']['UF_VALUE']?></label>
                                <input name="NEW_PASSWORD_CONFIRM" id="loginnewpass2" type="text" placeholder="Enter Password">
                            </div>
<!--                            <div class="popup__settings-login__sso">-->
<!--                                <div class="popup__settings-login__sso-title">Single Sign On</div>-->
<!--                                <div class="popup__settings-login__sso-list">-->
<!--                                    <div class="popup__settings-login__sso-item">-->
<!--                                        <div class="popup__settings-login__social" data-type="google">Google</div>-->
<!--                                        <a href="#" class="popup__settings-login__social-unlink hoverMe" data-attr="Unlink">Unlink</a>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <button type="button" class="popup__settings-button hoverMe" data-attr="<?=$arHandBook['PROFILE_SAVE']['UF_VALUE']?>"><?=$arHandBook['PROFILE_SAVE']['UF_VALUE']?></button>
                        </form>
                    </div>
                </div>
            </div>
<!--            <div class="popup__settings-section">-->
<!--                <div class="popup__settings-section__title">Notifications</div>-->
<!--                <form action="#" method="post" class="popup__settings-form">-->
<!--                    <div class="popup__settings-form__group popup__settings-form__checkbox">-->
<!--                        <label>-->
<!--                            <input type="checkbox" name="reminder" checked/><i></i>-->
<!--                            <div class="popup__settings-form__checkbox-content">-->
<!--                                <div class="popup__settings-form__checkbox-title">Reminders about failed modules</div>-->
<!--                                <div class="popup__settings-form__checkbox-text">These notifications will appears on the page «Notifications» inside of platform</div>-->
<!--                            </div>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    <div class="popup__settings-form__group popup__settings-form__checkbox">-->
<!--                        <label>-->
<!--                            <input type="checkbox" name="digest"/><i></i>-->
<!--                            <div class="popup__settings-form__checkbox-content">-->
<!--                                <div class="popup__settings-form__checkbox-title">Digest subscription</div>-->
<!--                                <div class="popup__settings-form__checkbox-text">Receive information materials by E-mail</div>-->
<!--                            </div>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                    <div class="popup__settings-form__group popup__settings-form__checkbox">-->
<!--                        <label>-->
<!--                            <input type="checkbox" name="emailnotify"/><i></i>-->
<!--                            <div class="popup__settings-form__checkbox-content">-->
<!--                                <div class="popup__settings-form__checkbox-title">E-mail Notifications</div>-->
<!--                                <div class="popup__settings-form__checkbox-text">Information about activities on the platform</div>-->
<!--                            </div>-->
<!--                        </label>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
            <div class="popup__settings-section">
                <div class="popup__settings-section__title"><?=$arHandBook['PROFILE_PREFERNCES']['UF_VALUE']?></div>
                <div class="popup__settings-sections">
                    <div class="popup__settings-login__section active">
                        <div class="popup__settings-login__row">
                            <div class="popup__settings-login__col">
                                <div class="popup__settings-login__label"><?=$arHandBook['PROFILE_INTERFACE']['UF_VALUE']?></div>
                                <div class="popup__settings-login__value">
                                    <?if($arUser['UF_LANG'] == 'RU'){?>
                                        Русский
                                    <?}if($arUser['UF_LANG'] == 'EN'){?>
                                        English
                                    <?}?>
                                </div>
                            </div>
                            <div class="popup__settings-login__col">
                                <div class="popup__settings-login__label"><?=$arHandBook['PROFILE_TIMEZONE']['UF_VALUE']?></div>
                                <div class="popup__settings-login__value"><?=$arUser['UF_TIMEZONE']?></div>
                            </div>
                            <div class="popup__settings-login__col">
                                <div class="popup__settings-login__label"><?=$arHandBook['PROFILE_DATE_FORMAT']['UF_VALUE']?></div>
                                <div class="popup__settings-login__value"><?=$arUser['UF_DATE_FORMAT']?></div>
                            </div>
                        </div>
                        <div class="popup__settings-login__edit">
                            <a href="#" class="hoverMe" data-attr="<?=$arHandBook['PROFILE_EDIT_SETTINGS']['UF_VALUE']?>"><?=$arHandBook['PROFILE_EDIT_SETTINGS']['UF_VALUE']?></a>
                        </div>
                    </div>
                    <div class="popup__settings-login__section">
                        <form action="#" method="post" class="popup__settings-login__form settings_profile_form">
                            <input type="hidden" name="action" value="settings_profile_preferences">
                            <input type="hidden" name="user" value="<?=$arUser['ID']?>">
                            <div class="popup__settings-login__group profile__popup-form__group __half popup__settings-login__select">
                                <label for="language"><?=$arHandBook['PROFILE_INTERFACE']['UF_VALUE']?></label>
                                <select name="UF_LANG" id="normal-select-1" id="language" placeholder-text="<?=$arUser['UF_LANG']?:'English'?>">
                                    <option value="EN" class="select-dropdown__list-item" <?if($arUser['UF_LANG'] == 'EN'){?>selected="selected"<?}?>>English</option>
                                    <option value="RU" class="select-dropdown__list-item" <?if($arUser['UF_LANG'] == 'RU'){?>selected="selected"<?}?>>Русский</option>
                                </select>
                            </div>
                            <div class="popup__settings-login__group profile__popup-form__group __half popup__settings-login__select">
                                <label for="timezone"><?=$arHandBook['PROFILE_TIMEZONE']['UF_VALUE']?></label>
                                <select name="UF_TIMEZONE" id="normal-select-2" id="timezone" placeholder-text="<?=$arUser['UF_TIMEZONE']?:'Europe/Moscow'?>">
                                    <option value="Europe/Moscow" class="select-dropdown__list-item" <?if($arUser['UF_TIMEZONE'] == 'Europe/Moscow'){?>selected="selected"<?}?>>Europe/Moscow</option>
                                    <option value="Asia/Omsk" class="select-dropdown__list-item" <?if($arUser['UF_TIMEZONE'] == 'Asia/Omsk'){?>selected="selected"<?}?>>Asia/Omsk</option>
                                </select>
                            </div>
                            <div class="popup__settings-login__group profile__popup-form__group popup__settings-login__select">
                                <label for="formatdate"><?=$arHandBook['PROFILE_DATE_FORMAT']['UF_VALUE']?></label>
                                <select name="UF_DATE_FORMAT" id="normal-select-3" id="formatdate" placeholder-text="<?=$arUser['UF_DATE_FORMAT']?:'dd/mm/yyyy'?>">
                                    <option value="dd/mm/yyyy" class="select-dropdown__list-item" <?if($arUser['UF_DATE_FORMAT'] == 'dd/mm/yyyy'){?>selected="selected"<?}?>>dd/mm/yyyy</option>
                                    <option value="dd.mm.yyyy" class="select-dropdown__list-item" <?if($arUser['UF_DATE_FORMAT'] == 'dd.mm.yyyy'){?>selected="selected"<?}?>>dd.mm.yyyy</option>
                                </select>
                            </div>
                            <button type="button" class="popup__settings-button hoverMe" data-attr="<?=$arHandBook['PROFILE_SAVE']['UF_VALUE']?>"><?=$arHandBook['PROFILE_SAVE']['UF_VALUE']?></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="popup__settings-section">
                <div class="popup__settings-section__cover">
                    <div class="popup__settings-section__top">
                        <div class="popup__settings-section__title"><?=$arHandBook['PROFILE_COVER']['UF_VALUE']?></div>
                        <div class="popup__settings-cover__title"><?=$arHandBook['PROFILE_COVER_OPTIMAL']['UF_VALUE']?></div>
                    </div>
					<form action="#" class="popup__settings-cover__form settings_profile_form">
                        <input type="hidden" name="action" value="settings_profile_cover">
                        <input type="hidden" name="user" value="<?=$arUser['ID']?>">
                        <input type="file" class="popup__settings-cover__form-input" name="COVER">
						<div class="popup__settings-cover__media">
							<div class="popup__settings-cover__image">
								<img src="<?=CFile::GetPath($arUser['UF_COVER'])?:'/images/profile/cover.png'?>" alt="" loading="lazy">
							</div>
							<div class="popup__settings-cover__buttons">
								<span data-type="edit"><?=$arHandBook['PROFILE_PHOTO_EDIT']['UF_VALUE']?></span>
								<span data-type="delete"><?=$arHandBook['PROFILE_PHOTO_DELETE']['UF_VALUE']?></span>
							</div>
						</div>
					</form>
                    
<!--
                        <div class="popup__settings-cover__media">
                            <div class="popup__settings-cover__image">
                                <img src="<?=CFile::GetPath($arUser['UF_COVER'])?:'/images/profile/cover.png'?>" alt="" loading="lazy">
                            </div>
                        </div>
                        <div class="popup__settings-cover__tools">
                            <div class="popup__settings-cover__tools-left">
                                <button class="popup__settings-cover__tools-save"><?=$arHandBook['PROFILE_EDIT_SETTINGS']['UF_VALUE']?></button>
                                <a href="#" class="popup__settings-cover__tools-replace"><?=$arHandBook['PROFILE_COVER_REPLACE']['UF_VALUE']?></a>
                            </div>
                            <div class="popup__settings-cover__tools-right">
                                <a href="#" class="popup__settings-cover__tools-cancel"><?=$arHandBook['PROFILE_CANCEL']['UF_VALUE']?></a>
                            </div>
                        </div>
                    </form>
-->
                </div>
            </div>
            <div class="popup__settings-section">
                <div class="popup__settings-section__title"><?=$arHandBook['PROFILE_SETTINGS_DELET']['UF_VALUE']?></div>
                <div class="popup__settings-section__text">
                    <p><?=$arHandBook['PROFILE_SETTINGS_DELET_TEXT']['UF_VALUE']?></p></div>
                <div class="popup__settings-delete">
                    <div class="popup__settings-form__group popup__settings-form__checkbox">
                        <label>
                            <input type="checkbox" name="removedaccount"/><i></i>
                            <div class="popup__settings-form__checkbox-content">
                                <div class="popup__settings-form__checkbox-title"><?=$arHandBook['PROFILE_SETTINGS_DELET_CHECK']['UF_VALUE']?></div>
                            </div>
                        </label>
                    </div>
                    <div class="popup__settings-delete__action"><a href="#" class="hoverMe" data-attr="<?=$arHandBook['PROFILE_SETTINGS_DELET_BUTTON']['UF_VALUE']?>" data-user="<?=$arUser['ID']?>"><?=$arHandBook['PROFILE_SETTINGS_DELET_BUTTON']['UF_VALUE']?></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
