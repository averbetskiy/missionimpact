<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?if($arResult['ITEMS']){?>
    <div class="profile__courses-other">
<!--
        <div class="profile__courses-other__title">
            <?=$arHandBook['PERSONAL_COURSES_OTHER']['UF_VALUE']?>
        </div>
-->
        <div class="profile__courses-other__list pageCourses__list">

            <?foreach ($arResult['ITEMS'] as $item){?>
            <a href="#other<?=$item['ID']?>" class="pageCourses__list-item openProfilePopup">
                <div class="pageCourses__list-item__top">
                    <div class="pageCourses__item-media">
                        <div class="courses__item-media__photo">
        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
            <?}?>
                        </div>
                        <div class="pageCourses__item-media__content">
                            <div class="pageCourses__item-media-time">
                                <?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
                                <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?>
                            </div>
<!--
                            <div class="pageCourses__item-media-level">
                                <?=$item['PROPERTIES']['time']['VALUE']?>
                            </div>
-->
                        </div>
                    </div>
                    <div class="pageCourses__item-content">
                        <div class="pageCourses__item-content__title">
                            <?=$item['NAME']?>
                        </div>
                        <div class="pageCourses__item-content_meta">
                        </div>
                    </div>
                </div>
                <div class="pageCourses__item-content__more hoverMe" data-attr="<?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →">
                    <?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →
                </div>
            </a>
            <div class="profile__popup" id="other<?=$item['ID']?>">
                <div class="profile__popup-overlay">
                </div>
                <div class="profile__popup-inner">
                    <div class="profile__popup-close">
                        x
                    </div>
                    <div class="profile__popup-wrap profile__popup-courses">
                        <div class="profile__popup-title">
                            <?=$item['NAME']?>
                        </div>
                        <div class="profile__popup-courses__meta">
                            <div class="profile__popup-courses__meta-item __count">
                                <?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
                                <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?>
                            </div>
<!--
                            <div class="profile__popup-courses__meta-item __times">
                                <?=$arHandBook['PERSONAL_COURSES_DURATION']['UF_VALUE']?>: <?=$item['PROPERTIES']['time']['VALUE']?>
                            </div>
-->
                            <div class="profile__popup-courses__meta-item __certs">
                                <?=$arHandBook['PERSONAL_COURSES_CERT_ON_COMPLETE']['UF_VALUE']?>
                            </div>
                        </div>
                        <div class="profile__popup-courses__photo">
                            <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                            <?}?>
                        </div>
                        <div class="profile__popup-courses__text">
                            <p>
                                <?=$item['PREVIEW_TEXT']?>
                            </p>
                        </div>
                        <div class="profile__popup-courses__program">
        <?foreach ($item['MODULES'] as $key => $module){?>
                            <div class="profile__popup-courses__program-item">
                                <div class="profile__popup-courses__program-item__meta">
                                    <div class="profile__popup-courses__program-item__index">
                                        <?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$module['NUMBER_VALUE']?>
                                    </div>
                                    <div class="profile__popup-courses__program-item__type">
                                        <?=$module['VIDEO_VALUE'] ? 'Video' : 'Text'?>
                                    </div>
                                </div>
                                <div class="profile__popup-courses__program-item__title">
                                    <?=$module['NAME']?>
                                </div>
                                <div class="profile__popup-courses__program-item__text">
                                    <p>
                                        <?=$module['PREVIEW_TEXT']?>
                                    </p>
                                </div>
                            </div>
            <?}?>
        <?if ($item['TEST']){?>
                            <div class="profile__popup-courses__program-item">
                                <div class="profile__popup-courses__program-item__meta">
                                    <div class="profile__popup-courses__program-item__index">
                                        <?=$arHandBook['TEST_TYPE']['UF_VALUE']?>
                                    </div>
                                </div>
                                <div class="profile__popup-courses__program-item__title">
                                    <?=$arHandBook['PERSONAL_COURSES_CERT_ON_COMPLETE']['UF_VALUE']?>
                                </div>
                            </div>
            <?}?>
                        </div>
                        <?if ($item['MODULES']){?>
                                <a class="profile__popup-courses__start"
                                   data-action="get_course"
                                   data-course="<?=$item['ID']?>"
                                   data-url="<?=$item['DETAIL_PAGE_URL']?>module/<?=current($item['MODULES'])['ID']?>/"
                                ><?=$arHandBook['PERSONAL_COURSES_START_OTHER_COURSE']['UF_VALUE']?></a>
                        <?}?>
                    </div>
                </div>
            </div>
            <?}?>
        </div>
    </div>
<?}?>