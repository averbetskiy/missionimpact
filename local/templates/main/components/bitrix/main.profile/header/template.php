<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook,$USER,$notificationsNew;
$arUser = $arResult['arUser'];
$percent = $arResult['PERCENT'];
$lang = $_COOKIE['mi_lang'];
if(!$lang){
    $lang = 's1';
}
?>
<div class="profile__top">
    <div class="profile__top-photo">
        <div class="profile__top-photo__progress">
            <?php $percentCircle = $percent * 6.04; ?>
            <svg viewBox="0 0 196 196">
                <circle cx="98" cy="98" r="96" stroke-dasharray="<?=$percentCircle;?> 900">
                </circle>
            </svg>
        </div>
        <div class="profile__top-photo__inner">
            <?if($arUser['UF_PHOTO']){?>
                <img src="<?=CFile::GetPath($arUser['UF_PHOTO'])?>">
            <?}else{?>
                <?=strtoupper(mb_substr($arUser['NAME'],0,1).mb_substr($arUser['LAST_NAME'],0,1))?>
            <?}?>
        </div>
    </div>
    <div class="profile__top-info">
        <div class="profile__member-name"><?=$arUser['NAME'].' '.$arUser['LAST_NAME']?></div>
        <div class="profile__member-meta">
            <div class="profile__member-role"><?=$arResult['CUSTOMER']?></div>
            <div class="profile__member-progress"><?=str_replace('#PERCENT#',ceil($percent),$arHandBook['PROFILE_COMPLETE_PERCENT']['UF_VALUE'])?></div>
        </div>
    </div>
    <div class="profile__top-tools">
<!--         если есть новые уведомления, показываем data-status="new" -->
        <a href="#notify" class="profile__tools-notify openProfilePopup notify_read" <?if($notificationsNew > 0){?>data-status="new"<?}?>>
            <?if($notificationsNew > 0){?>
                <?
                if($notificationsNew > 1) {
                    $message = $notificationsNew .' '. $arHandBook['PROFILE_NOTIFICATION_MESSAGE_MORE']['UF_VALUE'];
                }else{
                    $message = $notificationsNew .' '. $arHandBook['PROFILE_NOTIFICATION_MESSAGE_ONE']['UF_VALUE'];
                }
                ?>
                <div class="profile__tools-notify__count hoverMe" data-attr="<?=$message?>"><?=$message?></div>
            <?}?>
            <div class="profile__tools-notify__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                    <path d="M8.99967 0C7.05475 0 5.18949 0.772617 3.81422 2.14788C2.43896 3.52315 1.66634 5.38841 1.66634 7.33333V13.3333H0.333008V14.6667H17.6663V13.3333H16.333V7.33333C16.333 5.38841 15.5604 3.52315 14.1851 2.14788C12.8099 0.772617 10.9446 0 8.99967 0ZM5.66634 16.6667V16H12.333V16.6667C12.333 17.5507 11.9818 18.3986 11.3567 19.0237C10.7316 19.6488 9.88373 20 8.99967 20C8.11562 20 7.26777 19.6488 6.64265 19.0237C6.01753 18.3986 5.66634 17.5507 5.66634 16.6667Z" fill="#1A1A1A"/>
                </svg>
            </div>
        </a>
        <a href="#settings" class="profile__tools-settings openProfilePopup">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_2710_9501)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.424 0H12.5707L12.7893 1.116V1.12L13.1493 2.9C13.66 3.12933 14.136 3.41467 14.5733 3.736L16.3667 3.12533L17.428 2.79067L17.984 3.76L19.4333 6.232L20 7.22267L19.156 7.97333L17.8107 9.13867C17.8533 9.40133 17.892 9.696 17.892 10C17.892 10.304 17.852 10.6 17.812 10.8613L19.1613 12.032L20 12.7773L19.4293 13.7747L17.984 16.24L17.428 17.2133L16.352 16.8693L14.5733 16.264C14.1294 16.592 13.6521 16.8723 13.1493 17.1L12.7893 18.88V18.884L12.5733 20H7.42667L7.20933 18.8813L6.84933 17.1C6.34655 16.8723 5.86923 16.592 5.42533 16.264L3.63467 16.8733L2.56933 17.2133L2.016 16.24L0.565333 13.7667L0 12.7773L0.842667 12.0267L2.18667 10.86C2.13722 10.5759 2.11047 10.2883 2.10667 10C2.10667 9.69733 2.14667 9.4 2.188 9.14L0.836 7.96667L0 7.224L0.568 6.22667L2.01467 3.76L2.568 2.78933L3.64533 3.13067L5.424 3.736C5.86789 3.40794 6.34521 3.12772 6.848 2.9L7.208 1.11733L7.424 0ZM10 6.66667C8.192 6.66667 6.72667 8.16 6.72667 10C6.72667 11.84 8.19333 13.3333 9.99867 13.3333C11.8053 13.3333 13.2707 11.84 13.2707 10C13.2707 8.16 11.804 6.66667 10 6.66667Z" fill="#1A1A1A"/>
                </g>
                <defs>
                    <clipPath id="clip0_2710_9501">
                        <rect width="20" height="20" fill="white"/>
                    </clipPath>
                </defs>
            </svg>
        </a>
    </div>
</div>

<?$this->SetViewTarget('notifications');?>
    <div class="profile__popup" id="notify">
        <div class="profile__popup-overlay"></div>
        <div class="profile__popup-inner">
            <div class="profile__popup-close">x</div>
            <div class="profile__popup-wrap profile__popup-notify">
                <div class="popup__notify-title profile__popup-title"><?=$arHandBook['PROFILE_NOTIFICATION']['UF_VALUE']?></div>
                <div class="popup__notify-count">
                    <?if($notificationsNew > 0){?>
                        <?if($notificationsNew > 1) {
                        $message = $notificationsNew .' '. $arHandBook['PROFILE_NOTIFICATION_MESSAGE_MORE']['UF_VALUE'];
                        }else{
                        $message = $notificationsNew .' '. $arHandBook['PROFILE_NOTIFICATION_MESSAGE_ONE']['UF_VALUE'];
                        }?>
                        <?=$message?>
                    <?}?>
                </div>
                <?
                $arId = [];
                foreach ($arResult['NOTIFICATIONS'] as $item){
                    if(!$item['READ']) {
                        $arId[] = $item['ID'];
                    }
                }
                ?>
                <div class="popup__notify-list" data-ids="<?=implode(',',$arId)?>">
                    <?foreach ($arResult['NOTIFICATIONS'] as $item){?>
                        <a href="<?=$item['UF_LINK']?>" class="popup__notify-item <?=(!$item['READ'])?'popup__notify-item-read':''?>"
                            <?=($item['READ'])?'data-type="success"':'data-status="new"'?> data-id="<?=$item['ID']?>">
                            <div class="popup__notify-item__photo">
                                <?if($item['UF_IMAGE']){?>
                                    <img src="<?=$item['UF_IMAGE']?>" alt="" loading="lazy">
                                <?}?>
                            </div>
                            <div class="popup__notify-item__content">
                                <div class="popup__notify-item__top">
                                    <div class="popup__notify-item__meta">
                                        <div class="popup__notify-item__cat"><?=$item['UF_TYPE']?></div>
                                        <div class="popup__notify-item__date">
                                            <?if($lang == 's2'){?>
                                                <?=str_replace(RU_LONG_MONTH,RU_LONG_MONTH2,FormatDate('d F',$item['UF_DATE']))?>
                                                at
                                                <?=str_replace(RU_LONG_MONTH,RU_LONG_MONTH2,FormatDate('H:i',$item['UF_DATE']))?>
                                            <?}else{?>
                                                <?=str_replace(RU_LONG_MONTH,EN_LONG_MONTH,FormatDate('d F',$item['UF_DATE']))?>
                                                at
                                                <?=str_replace(RU_LONG_MONTH,EN_LONG_MONTH,FormatDate('H:i',$item['UF_DATE']))?>
                                            <?}?>
                                        </div>
                                    </div>
                                    <div class="popup__notify-item__title">
                                        <?if($lang == 's2'){?>
                                            <?=$item['UF_NAME_RU']?:$item['UF_NAME']?>
                                        <?}else{?>
                                            <?=$item['UF_NAME']?>
                                        <?}?>
                                    </div>
                                    <div class="popup__notify-item__text">
                                        <?if($lang == 's2'){?>
                                            <?=$item['UF_PREVIEW_RU']?:$item['UF_PREVIEW']?>
                                        <?}else{?>
                                            <?=$item['UF_PREVIEW']?>
                                        <?}?>
                                    </div>
                                </div>
<!--
                                <div class="popup__notify-item__view">
                                    <div data-attr="<?=$arHandBook['PROFILE_NOTIFICATION_VIEW']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['PROFILE_NOTIFICATION_VIEW']['UF_VALUE']?></div>
                                </div>
-->
                            </div>
                        </a>
                    <?}?>
                    <?if(!$arResult['NOTIFICATIONS']){?>
                        <p><?=$arHandBook['PROFILE_NOTIFICATION_NOT']['UF_VALUE']?></p>
                    <?}?>
            </div>
        </div>
    </div>
    </div>
<?$this->EndViewTarget();?>