<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?$this->SetViewTarget('personal_courses_tabs');?>
    <div class="profile__tabs-select">
        <div class="profile__tabs-select__item active">
            <?=$arHandBook['PERSONAL_COURSES_TAB_MY_COURSES']['UF_VALUE']?> <?=$arResult['ITEMS']['NEW'] ? count ($arResult['ITEMS']['NEW']) : ''?>
        </div>
        <div class="profile__tabs-select__item">
            <?=$arHandBook['PERSONAL_COURSES_TAB_PASSED']['UF_VALUE']?> <?=$arResult['ITEMS']['PASSED'] ? count ($arResult['ITEMS']['PASSED']) : ''?>
        </div>
        <div class="profile__tabs-select__item">
            <?=$arHandBook['PERSONAL_COURSES_TAB_ALL_COURSES']['UF_VALUE']?>
        </div>
    </div>
<?$this->EndViewTarget();?>
<?$this->SetViewTarget('personal_courses');?>
    <div class="profile__tabs-body">
    <div class="profile__tabs-body__item active">
        <div class="profile__courses-list">
        <? if ($arResult['ITEMS']['NEW']) { ?>
            <? foreach ($arResult['ITEMS']['NEW'] as $item) {?>
                <div class="profile__course">
                    <div class="profile__courses-item__section">
                        <div class="profile__courses-item__row">
                            <div class="profile__courses-item__content">
                                <div class="profile__courses-item__info">
                                    <div class="profile__courses-item__status">
                                        <span><?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
                                            <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
                                    <div class="profile__courses-item__title"><?= $item['NAME'] ?></div>
                                </div>
								<div class="profile__courses-item__tools">
                    				<div class="profile__courses-item__more">
                                    	<a href="<?= $item['DETAIL_PAGE_URL'] ?>" data-attr="<?=$arHandBook['PERSONAL_COURSES_MORE_COURSE']['UF_VALUE']?> ↓"
                                       class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_MORE_COURSE']['UF_VALUE']?> ↓</a>
                                	</div>
                				</div>
                            </div>
                            <div class="profile__courses-item__modules">
                                <?foreach ($item['MODULES'] as $key => $module){?>
                                    <?if ($module['PREVIEW_PICTURE']){?>
                                        <div class="profile__courses-item__modules-item">
                                            <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                                        </div>
                                    <?}?>
                                <?}?>
                            </div>
							<div class="profile__courses-item__more">
                            	<a href="<?= $item['DETAIL_PAGE_URL'] ?>" data-attr="<?=$arHandBook['PERSONAL_COURSES_MORE_COURSE']['UF_VALUE']?> ↓"
                                       class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_MORE_COURSE']['UF_VALUE']?> ↓</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile__courses-item__section active">
                        <div class="profile__courses-item__top">
                            <div class="profile__courses-item__status">
                                <span><?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
                                    <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
                            <div class="profile__courses-item__passed"><?=$item['PASSED']?>% <?=$arHandBook['PERSONAL_COURSES_PASSED']['UF_VALUE']?></div>
                        </div>
                        <div class="profile__courses-item__title"><?= $item['NAME'] ?></div>
                        <div class="profile__courses-item__list">
                            <?foreach ($item['MODULES'] as $key => $module){?>
                                <a href="<?=$item['DETAIL_PAGE_URL']?>module/<?=$module['ID']?>/" class="pageCourse__module" data-type="video">
                                    <div class="pageCourse__module-media">
                                        <div class="pageCourse__module-photo">
                                            <?if ($module['PREVIEW_PICTURE']){?>
                                                <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                                            <?}?>
                                        </div>
                                        <div class="pageCourse__module-content">
                                            <div class="pageCourse__module-name"><?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$module['NUMBER_VALUE']?></div>
                                            <div class="pageCourse__module-title"><?=$module['NAME']?></div>
                                        </div>
                                    </div>
                                    <div class="pageCourse__module-info">
                                        <div class="pageCourse__module-type"><?=$module['VIDEO_VALUE'] ?
                                                $arHandBook['MODULE_TYPE_VIDEO']['UF_VALUE']
                                                : $arHandBook['MODULE_TYPE_TEXT']['UF_VALUE']
                                            ?></div>
                                        <div class="pageCourse__module-time"><?=$module['DURATION_VALUE']?></div>
                                    </div>
                                    <div class="pageCourse__module-status__wrap">
                                        <div class="pageCourse__module-status" style="width: <?=$module['PROGRESS']?>%"></div>
                                    </div>
                                </a>
                            <?}?>
                            <?if ($item['TEST']){?>
                                    <?if ($item['TEST']['AVAIL'] == 'Y'){?>
                                <a href="<?=$item['DETAIL_PAGE_URL']?>test/" class="pageCourse__module" data-type="test">
                                    <?}else{?>
                                    <div class="pageCourse__module" data-type="test">
                                <?}?>
                                    <div class="pageCourse__module-media">
                                        <div class="pageCourse__module-photo"></div>
                                        <div class="pageCourse__module-content">
                                            <?if ($item['TEST']['AVAIL'] != 'Y') {?>
                                                <div class="pageCourse__module-title __close">
                                                    <?=$arHandBook['TEST_MODULES_NOT_COMPLETED']['UF_VALUE']?>
                                                </div>
                                            <?}else{?>
                                                <div class="pageCourse__module-title">
                                                    <?=$arHandBook['TEST_MODULES_COMPLETED']['UF_VALUE']?>
                                                </div>
                                            <?}?>
                                        </div>
                                    </div>
                                    <div class="pageCourse__module-info">
                                        <div class="pageCourse__module-type"><?=$arHandBook['TEST_TYPE']['UF_VALUE']?></div>
<!--                                        <div class="pageCourse__module-time">00:05</div>-->
                                    </div>
                                        <?if ($item['TEST']['AVAIL'] == 'Y'){?>
                                </a>
                                            <?}else{?>
                                    </div>
                                                <?}?>
                            <?}?>
                        </div>
                        <div class="profile__courses-item__tools">
                            <div class="profile__courses-item__more">
                                <a href="#" data-attr="<?=$arHandBook['PERSONAL_COURSES_HIDE']['UF_VALUE']?> ↑" class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_HIDE']['UF_VALUE']?> ↑</a>
                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        <?} else {?>
            <a href="/courses/" class="profile__courses-empty">
                <div class="profile__courses-empty__text">
                    <p><?=$arHandBook['PERSONAL_COURSES_EMPTY']['UF_VALUE']?></p>
                </div>
                <div class="profile__courses-empty__more">
                    <div data-attr="<?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →" class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →</div>
                </div>
            </a>
        <?}?>
    </div>
    </div>
    <div class="profile__tabs-body__item">
        <div class="profile__courses-list">
        <? if ($arResult['ITEMS']['PASSED']) { ?>
            <? foreach ($arResult['ITEMS']['PASSED'] as $item) {?>
            <div class="profile__course">
                <div class="profile__courses-item__section">
                    <div class="profile__courses-item__row">
                        <div class="profile__courses-item__content">
                            <div class="profile__courses-item__info">
                                <div class="profile__courses-item__status">
                                    <span><?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?> <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
                                <div class="profile__courses-item__title"><?= $item['NAME'] ?></div>
                            </div>
                            <div class="profile__courses-item__more">
                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>" data-attr="<?=$arHandBook['PERSONAL_COURSES_START_COURSE']['UF_VALUE']?> ↓"
                                   class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_START_COURSE']['UF_VALUE']?> ↓</a>
                            </div>
                        </div>
                        <div class="profile__courses-item__modules">
                            <?foreach ($item['MODULES'] as $key => $module){?>
                                <?if ($module['PREVIEW_PICTURE']){?>
                                    <div class="profile__courses-item__modules-item">
                                        <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                                    </div>
                                <?}?>
                            <?}?>
                        </div>
                    </div>
                </div>
                <div class="profile__courses-item__section active">
                    <div class="profile__courses-item__top">
                        <div class="profile__courses-item__status">
                            <span><?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?> <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
                        <div class="profile__courses-item__passed"><?=$item['PASSED']?>% <?=$arHandBook['PERSONAL_COURSES_PASSED']['UF_VALUE']?></div>
                    </div>
                    <div class="profile__courses-item__title"><?= $item['NAME'] ?></div>
                    <div class="profile__courses-item__list">
                        <?foreach ($item['MODULES'] as $key => $module){?>
                            <a href="<?=$item['DETAIL_PAGE_URL']?>module/<?=$module['ID']?>/" class="pageCourse__module" data-type="video">
                                <div class="pageCourse__module-media">
                                    <div class="pageCourse__module-photo">
                                        <?if ($module['PREVIEW_PICTURE']){?>
                                            <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                                        <?}?>
                                    </div>
                                    <div class="pageCourse__module-content">
                                        <div class="pageCourse__module-name"><?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$module['NUMBER_VALUE']?></div>
                                        <div class="pageCourse__module-title"><?=$module['NAME']?></div>
                                    </div>
                                </div>
                                <div class="pageCourse__module-info">
                                    <div class="pageCourse__module-type"><?=$module['VIDEO_VALUE'] ?
                                            $arHandBook['MODULE_TYPE_VIDEO']['UF_VALUE']
                                            : $arHandBook['MODULE_TYPE_TEXT']['UF_VALUE']
                                        ?></div>
                                    <div class="pageCourse__module-time"><?=$module['DURATION_VALUE']?></div>
                                </div>
                                <div class="pageCourse__module-status__wrap">
                                    <div class="pageCourse__module-status" style="width:<?=$module['PROGRESS']?>%"></div>
                                </div>
                            </a>
                        <?}?>
                        <?if ($item['TEST']){?>
                        <?if ($item['TEST']['AVAIL'] == 'Y'){?>
                        <a href="<?=$item['DETAIL_PAGE_URL']?>test/" class="pageCourse__module" data-type="test">
                            <?}else{?>
                            <div class="pageCourse__module" data-type="test">
                                <?}?>
                                <div class="pageCourse__module-media">
                                    <div class="pageCourse__module-photo"></div>
                                    <div class="pageCourse__module-content">
                                        <?if ($item['TEST']['AVAIL'] != 'Y') {?>
                                            <div class="pageCourse__module-title __close">
                                                <?=$arHandBook['TEST_MODULES_NOT_COMPLETED']['UF_VALUE']?>
                                            </div>
                                        <?}else{?>
                                            <div class="pageCourse__module-title">
                                                <?=$arHandBook['TEST_MODULES_COMPLETED']['UF_VALUE']?>
                                            </div>
                                        <?}?>
                                    </div>
                                </div>
                                <div class="pageCourse__module-info">
                                    <div class="pageCourse__module-type"><?=$arHandBook['TEST_TYPE']['UF_VALUE']?></div>
<!--                                    <div class="pageCourse__module-time">00:05</div>-->
                                </div>
                                <?if ($item['TEST']['AVAIL'] == 'Y'){?>
                        </a>
                        <?}else{?>
                    </div>
                    <?}?>
                    <?}?>
                </div>
                <div class="profile__courses-item__tools">
                    <div class="profile__courses-item__more">
                        <a href="#" data-attr="<?=$arHandBook['PERSONAL_COURSES_HIDE']['UF_VALUE']?> ↑" class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_HIDE']['UF_VALUE']?> ↑</a>
                    </div>
                </div>
            </div>
        </div>
        <? } ?>
    <?} else {?>
            <a href="/courses/" class="profile__courses-empty">
                <div class="profile__courses-empty__text">
                    <p><?=$arHandBook['PERSONAL_COURSES_EMPTY']['UF_VALUE']?></p>
                </div>
                <div class="profile__courses-empty__more">
                    <div data-attr="<?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →" class="hoverMe"><?=$arHandBook['PERSONAL_COURSES_EMPTY_EXPLORE']['UF_VALUE']?> →</div>
                </div>
            </a>
    <?}?>
    </div>
    </div>
	<div class="profile__tabs-body__item">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "personal_other_courses",
                        array(
                            "IBLOCK_TYPE" => "",
                            "IBLOCK_ID" => COURSES,
                            "NEWS_COUNT" => "0",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "",
                            "SORT_ORDER2" => "",
                            "FIELD_CODE" => array(
                                0 => "DATE_CREATE",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "photos",
                                2 => "",
                            ),
                            "SECTION_URL" => '',
                            "IBLOCK_URL" => '',
                            "DISPLAY_PANEL" => '',
                            "SET_TITLE" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "MESSAGE_404" => "",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "FILE_404" => '',
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "N",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "",
                            "PAGER_TEMPLATE" => "search",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "PAGER_BASE_LINK" => '',
                            "PAGER_PARAMS_NAME" => '',
                            "DISPLAY_DATE" => '',
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => '',
                            "DISPLAY_PREVIEW_TEXT" => '',
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d F Y",
                            "USE_PERMISSIONS" => '',
                            "GROUP_PERMISSIONS" => '',
                            //"FILTER_NAME" => "courseOtherFilter",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "CHECK_DATES" => "N",
                            "COMPONENT_TEMPLATE" => "personal_courses",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "Y",
                            "STRICT_SECTION_CHECK" => "N",
                            "DETAIL_URL" => ""
                        ),
                        false
                    );?>
		</div>
    </div>
<?$this->EndViewTarget();?>