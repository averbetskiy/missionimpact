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
?>
<?if ($request->isAjaxRequest() && $ajax == 'Y') {
    $class = 'active';
} ?>
<div class="solutions__tabs filtering">
    <div class="tabs__head">
        <a href="#" class="tabs__head-item filtering__button cat-all active hoverMe" data-attr="<?=$arHandBook['ALL_TOPICS']['UF_VALUE']?>"><?=$arHandBook['ALL_TOPICS']['UF_VALUE']?></a>
        <?foreach ($arResult['TABS'] as $key => $value){?>
            <a href="#" class="tabs__head-item filtering__button hoverMe" data-cat="<?=$key?>" data-attr="<?=$value?>"><?=$value?></a>
        <?}?>
    </div>
    <div class="tabs__body">
        <div class="pageCourses__list filter-cat-results">
            <?foreach ($arResult['ITEMS'] as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="pageCourses__list-item f-cat" data-cat="<?=$item['PROPERTIES']['type']['VALUE_XML_ID']?>">
                    <div class="pageCourses__list-item__top">
                        <div class="pageCourses__item-media">
                            <div class="courses__item-media__photo">
                                <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                                <?}?>
                            </div>
                            <div class="pageCourses__item-media__content">
                                <?if($item['PROPERTIES']['time']['VALUE']){?>
                                    <div class="pageCourses__item-media-time"><?=$item['PROPERTIES']['time']['VALUE']?></div>
                                <?}?>
                                <?if($item['PROPERTIES']['level']['VALUE']){?>
                                    <div class="pageCourses__item-media-level">
										<?=$arHandBook['LEVEL']['UF_VALUE']?>
										<?=$item['PROPERTIES']['level']['VALUE']?>
									</div>
                                <?}?>
                            </div>
                        </div>
                        <div class="pageCourses__item-content">
                            <div class="pageCourses__item-content__title"><?=$item['NAME']?></div>
                            <div class="pageCourses__item-content_meta">
								<?php //if($item['PROPERTIES']['author']['VALUE']){?>
								<?php //$arHandBook['BY']['UF_VALUE']?> <span><?php //current($item['DISPLAY_PROPERTIES']['author']['LINK_ELEMENT_VALUE'])['NAME']?></span>
								<?//}?>
								<?=$item['PREVIEW_TEXT'];?>
                            </div>
                        </div>
                    </div>
                    <div class="pageCourses__item-content__more hoverMe" data-attr="<?=$arHandBook['EXPLORE']['UF_VALUE']?>"><?=$arHandBook['EXPLORE']['UF_VALUE']?></div>
                </a>
            <?}?>
        </div>
    </div>
</div>