<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
use Bitrix\Main\UI;

global $arHandBook;
?>

<?if(!$arResult['User']){?>
    <a href="#sign" class="header__profile-sign openLoginPopup"><?=$arHandBook['SIGN_IN']['UF_VALUE'];?></a>
<?}else{?>
    <!-- если есть новые уведомления - выводим у div'a с классом header__profile-photo атрибут data-notify="true" -->
    <?
    $userId = $USER->GetID();
    $photoUser = \Bitrix\Main\UserTable::getRow([
        'filter'=>['ID'=>$userId],
        'select'=>['UF_PHOTO']]);
    $firstName = $USER->GetFirstName();
    $lastName = $USER->GetLastName();
    ?>
    <div class="header__profile-photo __icon" <?=($arResult['NOTIFICATIONS']>0)?'data-notify="true"':''?>>
        <?if($arResult['User']['UF_PHOTO']){?>
			<div class="header__profile-photo__media">
            	<img src="<?=CFile::GetPath($arResult['User']['UF_PHOTO'])?>" class="header_photo_user">
			</div>
        <?}else{?>
            <?=strtoupper(mb_substr($arResult['User']['NAME'],0,1).mb_substr($arResult['User']['LAST_NAME'],0,1))?>
        <?}?>
        <div class="header__profile-menu">
            <div class="header__profile-overlay"></div>
            <div class="header__profile-menu__wrap">
                <div class="header__profile-menu__top">
                    <a href="/personal/profile/" class="header__profile-photo">
                        <?if($arResult['User']['UF_PHOTO']){?>
							<div class="header__profile-photo__media">
								<img src="<?=CFile::GetPath($arResult['User']['UF_PHOTO'])?>" class="header_photo_user">
							</div>
                        <?}else{?>
                            <?=strtoupper(mb_substr($arResult['User']['NAME'],0,1).mb_substr($arResult['User']['LAST_NAME'],0,1))?>
                        <?}?>
                    </a>
                    <div class="header__profile-menu__info">
                        <div class="header__profile-menu__name"><?=$arResult['NAME_FORMATTED']?></div>
                        <div class="header__profile-menu__role"><?=$arResult['CUSTOMER']?></div>
                    </div>
                </div>
                <div class="header__profile-menu__list">
										<a href="/personal/projects/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_PROJECTS']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_PROJECTS']['UF_VALUE']?></a>
										<a href="/personal/courses/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_COURSES']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_COURSES']['UF_VALUE']?></a>
										<!--<a href="/personal/events/">My Events</a>-->
										<a href="/personal/profile/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_PROFILE']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_PROFILE']['UF_VALUE']?></a>
									</div>
									<div class="header__profile-menu__list">
										<a href="/personal/projects/" class="hoverMe" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_NOTIFY']['UF_VALUE']?>"><?=$arHandBook['HEADER_MENU_PROFILE_NOTIFY']['UF_VALUE']?></a>
										<a href="#settings" class="hoverMe openProfilePopup" data-attr="<?=$arHandBook['PROFILE_SETTINGS']['UF_VALUE'];?>"><?=$arHandBook['PROFILE_SETTINGS']['UF_VALUE'];?></a>
									</div>
									<div class="header__profile-menu__list">
										<a href="/?logout=yes&<?=bitrix_sessid_get()?>" class="hoverMe" data-attr="<?=$arHandBook['PROFILE_SIGN_OUT']['UF_VALUE'];?>"><?=$arHandBook['PROFILE_SIGN_OUT']['UF_VALUE'];?></a>
									</div>
            </div>
        </div>
    </div>
<?}?>