<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook,$USER;
$lang = $_COOKIE['mi_lang'];
if(!$lang){
    $lang = 's1';
}
$nextEvent = $arResult['ITEMS'][0];
?>
<div class="profile__tabs-body__item active">
    <div class="profile__events-list">
        <?$i=1;?>
        <?foreach ($arResult['ITEMS'] as $item){?>
            <div class="profile__event">
                <div class="profile__event-card">
                    <div class="profile__event-card__content">
                        <div class="profile__event-card__info">
                            <div class="profile__event-card__date">
                                <?if($lang == 's2'){?>
                                    <?=str_replace(RU_LONG_MONTH,RU_LONG_MONTH2,$item['DISPLAY_ACTIVE_FROM'])?>
                                <?}else{?>
                                    <?=str_replace(RU_LONG_MONTH,EN_LONG_MONTH,$item['DISPLAY_ACTIVE_FROM'])?>
                                <?}?>
                                <?if($item['PROPERTIES']['timezone']['VALUE']){?>
                                    (<?=$item['PROPERTIES']['timezone']['VALUE']?>)
                                <?}?>
                            </div>
                            <div class="profile__event-card__title"><?=$item['NAME']?></div>
                        </div>
                        <div class="profile__event-card__tools">
                            <div class="profile__event-card__explore">
                                <a href="#event<?=$i?>" class="hoverMe openProfilePopup" data-attr="<?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?>"><?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?></a>
                            </div>
                        </div>
                    </div>
                    <div class="profile__event-card__photo">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                        <?}?>
                        <div class="profile__event-card__photo-content">
                            <?if($item['PROPERTIES']['time']['VALUE']){?>
                                <div class="profile__event-card__photo-time"><?=$item['PROPERTIES']['time']['VALUE']?></div>
                            <?}?>
                            <?if($item['PROPERTIES']['type']['VALUE']){?>
                                <div class="profile__event-card__photo-type"><?=$item['PROPERTIES']['type']['VALUE']?></div>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="profile__popup" id="event<?=$i?>">
                    <div class="profile__popup-overlay"></div>
                    <div class="profile__popup-inner">
                        <div class="profile__popup-close">x</div>
                        <div class="profile__popup-wrap profile__popup-event">
                            <div class="profile__popup-title"><?=$item['NAME']?></div>
                            <div class="profile__popup-text"><p><?=$item['PREVIEW_TEXT']?></p></div>
                            <div class="profile__popup-event__meta">
                                <div class="profile__popup-event__meta-date">
                                    <?if($lang == 's2'){?>
                                        <?=str_replace(RU_LONG_MONTH,RU_LONG_MONTH2,FormatDate('d F Y',strtotime($item['ACTIVE_FROM'])))?>
                                    <?}else{?>
                                        <?=str_replace(RU_LONG_MONTH,EN_LONG_MONTH,FormatDate('d F Y',strtotime($item['ACTIVE_FROM'])))?>
                                    <?}?>
                                </div>
                                <div class="profile__popup-event__meta-type"><?=$item['PROPERTIES']['type']['VALUE']?></div>
                                <div class="profile__popup-event__meta-time">
                                    <?=FormatDate('h:i',strtotime($item['ACTIVE_FROM']))?>
                                    <?if($item['PROPERTIES']['timezone']['VALUE']){?>, <?=$item['PROPERTIES']['timezone']['VALUE']?><?}?>
                                </div>
                            </div>
                            <div class="profile__popup-event__photo">
                                <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                                <?}?>
                            </div>
                            <div class="profile__popup-event__content">
                                 <?=$item['DETAIL_TEXT']?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile__event-cal">
                    <div class="profile__event-cal__overlay"></div>
                    <div class="profile__event-cal__wrap">

                    </div>
                </div>
            </div>
            <?$i++;?>
        <?}?>
    </div>
</div>
<?$this->SetViewTarget('nextEvent');?>
    <?if($nextEvent){?>
        <?
        $timeNext = '';
        $timeStart = strtotime($nextEvent['ACTIVE_FROM']);
        $timeSec = $timeStart - strtotime("now");
        $timeMinAll = $timeSec/60;
        $timeHour = round($timeMinAll/60);
        $timeMin = ceil($timeMinAll - $timeHour*60);
        ?>
        <div class="profile__main-right">
            <div class="profile__events-times">
                <div class="profile__events-times__top">
                    <div class="profile__events-times__time"><?=$timeHour.':'.$timeMin?></div>
                    <div class="profile__events-times__next"><?=$arHandBook['PROFILE_EVENTS_NEXT_EVENT']['UF_VALUE']?></div>
                </div>
                <div class="profile__events-times__bottom">
                    <div class="profile__events-times__title"><?=$nextEvent['NAME']?></div>
                    <div class="profile__events-times__dates">
                        <?if($lang == 's2'){?>
                            <?=str_replace(RU_LONG_MONTH,RU_LONG_MONTH2,$nextEvent['DISPLAY_ACTIVE_FROM'])?>
                        <?}else{?>
                            <?=str_replace(RU_LONG_MONTH,EN_LONG_MONTH,$nextEvent['DISPLAY_ACTIVE_FROM'])?>
                        <?}?>
                        <?if($nextEvent['PROPERTIES']['timezone']['VALUE']){?>
                            (<?=$nextEvent['PROPERTIES']['timezone']['VALUE']?>)
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
<?$this->EndViewTarget();?>