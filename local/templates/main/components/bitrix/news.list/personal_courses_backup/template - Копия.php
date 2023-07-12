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
    </div>
<?$this->EndViewTarget();?>
<?$this->SetViewTarget('personal_courses');?>
    <div class="profile__tabs-body">
    <div class="profile__tabs-body__item active">
        <div class="profile__courses-list">
        <? if ($arResult['ITEMS']['NEW']) { ?>
            <? foreach ($arResult['ITEMS']['NEW'] as $item) {?>
                <div class="profile__course" id="<?=$item['CODE'];?>">
                    <div class="profile__courses-item__section">
                        <div class="profile__courses-item__row">
                            <div class="profile__courses-item__content">
                                <div class="profile__courses-item__info">
                                    <div class="profile__courses-item__status">
                                        <? $show = false; if ($item['PROPERTIES']['time']['VALUE'] && $show!=false) { ?>
                                            <?= $item['PROPERTIES']['time']['VALUE'] ?>
											<?=$arHandBook['PERSONAL_COURSES_TIME_LEFT']['UF_VALUE']?>
                                        <? } ?>
                                        <span>・<?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
                                            <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
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
                                <? if ($item['PROPERTIES']['time']['VALUE']) { ?>
                                    <?= $item['PROPERTIES']['time']['VALUE'] ?> <?=$arHandBook['PERSONAL_COURSES_TIME_LEFT']['UF_VALUE']?>
                                <? } ?>
                                <span>・<?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?>
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
                                        <div class="pageCourse__module-status" style="<?=($module['COMPLETED'] == 'Y') ? 'width:100%' : 'width:0%'?>"></div>
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
                                    <? if ($item['PROPERTIES']['time']['VALUE']) { ?>
                                        <?= $item['PROPERTIES']['time']['VALUE'] ?> <?=$arHandBook['PERSONAL_COURSES_TIME_LEFT']['UF_VALUE']?>
                                    <? } ?>
                                    <span>・<?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?> <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
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
                            <? if ($item['PROPERTIES']['time']['VALUE']) { ?>
                                <?= $item['PROPERTIES']['time']['VALUE'] ?> <?=$arHandBook['PERSONAL_COURSES_TIME_LEFT']['UF_VALUE']?>
                            <? } ?>
                            <span>・<?=count($item['MODULES'])?> <?=$arHandBook['PERSONAL_COURSES_MODULES_COUNT']['UF_VALUE']?> <?=($item['TEST']) ? $arHandBook['PERSONAL_COURSES_AND_TEST']['UF_VALUE'] : ''?></span></div>
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
                                    <div class="pageCourse__module-status" style="<?=($module['COMPLETED'] == 'Y') ? 'width:100%' : 'width:0%'?>"></div>
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
    </div>
<?$this->EndViewTarget();?>