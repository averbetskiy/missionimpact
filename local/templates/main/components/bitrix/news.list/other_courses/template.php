<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?$this->SetViewTarget('other_courses');?>
<?if($arResult['ITEMS']){?>
    <div class="pageCourse__other">
        <div class="container">
            <div class="heading__columns">
                <div class="heading__columns-title"><?=$arHandBook['OTHER_COURSES']['UF_VALUE']?></div>
            </div>
            <div class="pageCourses__list">
                <?foreach ($arResult['ITEMS'] as $item){?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="pageCourses__list-item">
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
                                        <div class="pageCourses__item-media-level"><?=$arHandBook['LEVEL']['UF_VALUE']?>: <?=$item['PROPERTIES']['level']['VALUE']?></div>
                                    <?}?>
                                </div>
                            </div>
                            <div class="pageCourses__item-content">
                                <div class="pageCourses__item-content__title"><?=$item['NAME']?></div>
                                <div class="pageCourses__item-content_meta">
									<?=$item['PREVIEW_TEXT'];?>
									<?php //$arHandBook['BY']['UF_VALUE']?> <span><?php //current($item['DISPLAY_PROPERTIES']['author']['LINK_ELEMENT_VALUE'])['NAME']?></span>
                                </div>
                            </div>
                        </div>
                        <div class="pageCourses__item-content__more hoverMe" data-attr="<?=$arHandBook['EXPLORE']['UF_VALUE']?>"><?=$arHandBook['EXPLORE']['UF_VALUE']?></div>
                    </a>
                <?}?>
            </div>
        </div>
    </div>
<?}?>
<?$this->EndViewTarget();?>