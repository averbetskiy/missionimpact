<? use Bitrix\Main\Context;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
global $arHandBook;
$request = Context::getCurrent()->getRequest();
$ajax = $request->get('ajax');
$class = '';
$sectionId= $request->get('section');
$type = $request->get('type');
if(!$type){
    $type = 'listing';
}
?>
<div class="diveinblog__tabs tabs filtering">
    <div class="diveinblog__tabs_head-wrap">
        <div class="diveinevents__views">
            <div class="tabs__head">
                <div class="tabs__head-item tabAjaxEventsType <?=($type == 'listing')?'active':''?> hoverMe"
                     data-attr="<?=$arHandBook['LISTING']['UF_VALUE']?>"
                    data-type="listing">
                    <?=$arHandBook['LISTING']['UF_VALUE']?>
                </div>
                <div class="tabs__head-item tabAjaxEventsType <?=($type == 'calendar')?'active':''?> hoverMe"
                     data-attr="<?=$arHandBook['CALENDAR']['UF_VALUE']?>"
                    data-type="calendar">
                    <?=$arHandBook['CALENDAR']['UF_VALUE']?>
                </div>
            </div>
        </div>
        <div class="diveinblog__tabs-head">
            <a href="#"
               class="diveinblog__tabs-head__item divein__events-tabs__item <?=($sectionId == 0 || !$sectionId)?'active':''?> cat-all hoverMe tabAjaxEvents"
               data-attr="<?=$arHandBook['ALL_EVENTS']['UF_VALUE']?>"
               data-id="0">
                <?=$arHandBook['ALL_EVENTS']['UF_VALUE']?>
            </a>
            <?foreach ($arResult['SECTION'] as $key => $section){?>
                <a href="#" class="diveinblog__tabs-head__item divein__events-tabs__item hoverMe tabAjaxEvents <?=($sectionId == $section['ID'])?'active':''?>"
                   data-id="<?=$section['ID']?>"
                   data-cat="<?=strtolower($section['CODE'])?>"
                   data-attr="<?=$section['NAME']?>">
                    <?=$section['NAME']?>
                </a>
            <?}?>
        </div>
    </div>
    <?if($type == 'listing'){?>
        <div class="divein__events-wrap tabs__body-item <?=($type == 'listing')?'active':''?>" data-type="listing">
            <?foreach ($arResult['MONTH'] as $month){?>
                <div class="divein__events-section">
                    <div class="divein__events-date"><?=$month['MONTH']?></div>
                    <div class="divein__events-inner">
                        <div class="divein__events-list">
                            <?foreach ($month['ITEMS'] as $item){?>
                                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="divein__events-item f-cat" data-cat="Competition">
                                    <div class="divein__events-item__photo">
                                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                                        <?}?>
                                        <?if($item['PROPERTIES']['tags']['VALUE']){?>
                                            <div class="divein__events-item__tags">
                                                <?foreach ($item['PROPERTIES']['tags']['VALUE'] as $tag){?>
                                                    <div class="divein__events-item__tags-item"><?=$tag?></div>
                                                <?}?>
                                            </div>
                                        <?}?>
                                    </div>
                                    <div class="divein__events-item__content">
                                        <div class="divein__events-item__date">
                                            <?if($_COOKIE['mi_lang'] == 's2'){?>
                                                <?=$item['DISPLAY_ACTIVE_FROM']?>
                                            <?}else{?>
                                                <?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,$item['DISPLAY_ACTIVE_FROM'])?>
                                            <?}?>
                                        </div>
                                        <div class="divein__events-item__title">
                                            <?=$item['NAME']?>
                                        </div>
                                        <div class="divein__events-item__text">
                                            <?=$item['PREVIEW_TEXT']?>
                                        </div>
                                    </div>
                                </a>
                            <?}?>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    <?}?>
    <?if($type == 'calendar'){?>
        <div class="divein__events-wrap tabs__body-item calendar <?=($type == 'calendar')?'active':''?>" data-type="calendar">
            <div id="month-calendar">
                <ul class="month">
                    <?
                    $date = new DateTime();
                    $datePrev = new DateTime();
                    $datePrev->modify('-1 month');
                    $dateNext = new DateTime();
                    $dateNext->modify('+1 month')
                    ?>
                    <li class="prev monthAjaxPrev"
                        data-month="<?=$datePrev->format('m')?>"
                        data-year="<?=$datePrev->format('Y')?>"
                    ><i class="fas fa-angle-double-left"></i></li>

                    <li class="title">
                        <span class="month-name" data-month="<?=$date->format('m')?>"></span>
                        <span class="year-name" data-year="<?=$date->format('Y')?>"></span </li>
                    <li class="next monthAjaxNext"
                        data-month="<?=$dateNext->format('m')?>"
                        data-year="<?=$dateNext->format('Y')?>"
                    ><i class="fas fa-angle-double-right"></i></li>
                </ul>
                <ul class="weekdays">
                    <?if($_COOKIE['mi_lang'] == 's2') {?>
                        <li>Пн</li>
                        <li>Вт</li>
                        <li>Ср</li>
                        <li>Чт</li>
                        <li>Пт</li>
                        <li>Сб</li>
                        <li>Вс</li>
                    <?}else{?>
						<li>M<span>on</span></li>
						<li>T<span>ue</span></li>
						<li>W<span>ed</span></li>
						<li>T<span>hu</span></li>
						<li>F<span>ri</span></li>
						<li>S<span>at</span></li>
						<li>S<span>un</span></li>
                    <?}?>
                </ul>
                <ul class="days"></ul>
				<div class="mobileEvents"></div>
            </div>
        </div>
    <?}?>
</div>