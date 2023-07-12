<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<nav class="header__menu">
    <ul>
        <?foreach ($arResult as $item){?>
            <li class="dropdown">
                <a href="#" class="header__menu-link"><span><?=$item['TEXT']?></span></a>
                <div class="megamenu <?=($item['PARAMS']['UF_TYPE'] == "divein")?"megamenu__divein":""?>">
                    <div class="container">
                        <?if($item['PARAMS']['UF_TYPE'] == "solutions"){?>
                            <div class="megamenu__heading"><?=$item['PARAMS']['DESCRIPTION']?></div>
                            <div class="megamenu__solutions">
                                <div class="megamenu__links">
									<?if($item['PARAMS']['SUB_SECTIONS']){?>
                                        <ul>
                                            <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                                                <li class="megamenu__links-item">
                                                    <a href="<?=$subSection['UF_LINK']?>" class="megamenu__links-link hoverMe" data-attr="<?=$subSection['~NAME']?>"><?=$subSection['~NAME']?></a>
                                                    <p class="megamenu__links-info"><?=$subSection['DESCRIPTION']?></p>
                                                </li>
                                            <?}?>
                                        </ul>
                                    <?}?>
                                    <!-- <ul>
                                        <li class="megamenu__links-item">
                                            <a href="<?=$item['LINK']?>" class="megamenu__links-link hoverMe" data-attr="<?=$item['PARAMS']['UF_LINK_TITLE']?>"><?=$item['PARAMS']['UF_LINK_TITLE']?></a>
                                            <p class="megamenu__links-info"><?=$item['PARAMS']['UF_LINK_TEXT']?></p>
                                        </li>
                                    </ul> -->
                                </div>
                                <div class="megamenu__solutions-list">
                                    <?foreach ($item['PARAMS']['ITEMS'] as $element){?>
                                        <a href="<?=$element['DETAIL_PAGE_URL']?>" class="megamenu__solutions-item">
                                            <div class="megamenu__solutions_item-photo">
                                                <?if($element['PREVIEW_PICTURE']){?>
                                                    <img src="<?=$element['PREVIEW_PICTURE']?>" alt="">
                                                <?}?>
                                            </div>
                                            <div class="megamenu__solutions_item-title">
                                                <?=$element['NAME']?>
                                            </div>
                                        </a>
                                    <?}?>
                                </div>
                            </div>
                        <?}elseif ($item['PARAMS']['UF_TYPE'] == "about"){?>
                            <div class="megamenu__wrap">
                                <div class="megamenu__links">
                                    <div class="megamenu__heading"><?=$item['PARAMS']['DESCRIPTION']?></div>
                                    <?if($item['PARAMS']['SUB_SECTIONS']){?>
                                        <ul>
                                            <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                                                <li class="megamenu__links-item">
                                                    <a href="<?=$subSection['UF_LINK']?>" class="megamenu__links-link hoverMe" data-attr="<?=$subSection['~NAME']?>"><?=$subSection['~NAME']?></a>
                                                    <p class="megamenu__links-info"><?=$subSection['DESCRIPTION']?></p>
                                                </li>
                                            <?}?>
                                        </ul>
                                    <?}?>
                                </div>
                                <?foreach ($item['PARAMS']['ITEMS'] as $element){?>
                                    <a href="<?=$element['DETAIL_PAGE_URL']?>" class="megamenu__banner">
                                        <div class="megamenu__banner-image">
                                            <?if($element['PREVIEW_PICTURE']){?>
                                                <img src="<?=$element['PREVIEW_PICTURE']?>" alt="">
                                            <?}?>
                                        </div>
                                        <div class="megamenu__banner-content">
                                            <div class="megamenu__banner_content-top">
                                                <div class="megamenu__banner_content-type"><?=$arHandBook['TEXT_UPCOMING_EVENT']['UF_VALUE']?></div>
                                                <div class="megamenu__banner_content-title"><?=$element['NAME']?></div>
                                            </div>
                                            <?if($element['DATE_ACTIVE_FROM']){?>
                                                <?
                                                if($_COOKIE['mi_lang'] == 's2') {
                                                    $date = ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,FormatDate('d M',strtotime($element['DATE_ACTIVE_FROM']))));
                                                }else{
                                                    $date = ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M',strtotime($element['DATE_ACTIVE_FROM']))));
                                                }
                                                ?>
                                                <div class="megamenu__banner_content-bottom hoverMe" data-attr="\ <?=$date?> →">\ <?=$date?> →</div>
                                            <?}?>
                                        </div>
                                    </a>
                                <?}?>
                            </div>
                        <?}elseif ($item['PARAMS']['UF_TYPE'] == "divein"){?>
                            <div class="megamenu__divein-wrap">
                                <div class="megamenu__divein-left">
                                    <div class="megamenu__divein-top">
                                        <div class="megamenu__links">
                                            <ul>
												<?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection2){?>
													<?php if (!$subSection2['UF_COUNT_ELEMENT']): ?>
														<li class="megamenu__links-item">
															<a href="<?=$subSection2['UF_LINK']?>" class="megamenu__links-link hoverMe" data-attr="<?=$subSection2['~NAME']?>"><?=$subSection2['~NAME']?></a>
															<p class="megamenu__links-info"><?=$subSection2['DESCRIPTION']?></p>
														</li>
													<?php endif; ?>
												<?}?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="megamenu__divein-menu">
                                        <?$i=0;?>
                                        <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
											<?php if ($subSection['UF_COUNT_ELEMENT']): ?>
                                          	 <a href="#" class="megamenu__divein-menu__link <?=($i == 0)?"active":""?>"><?=$subSection['~NAME']?></a>
											<?php endif; ?>
                                            <?$i++;?>
                                        <?}?>
                                    </div>
                                </div>
                                <div class="megamenu__divein-right">
                                    <?$i=0;?>
                                    <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
										<?php if ($subSection['UF_COUNT_ELEMENT']): ?>
                                        <div class="megamenu__divein-content__item <?=($i == 0)?"active":""?>">
                                            <div class="megamenu__divein-right__title"><?=htmlspecialchars_decode($subSection['DESCRIPTION'])?></div>
                                            <div class="megamenu__divein-content">
                                                <?if($subSection['UF_IBLOCK'] == EVENTS){?>
                                                    <div class="megamenu__divein-events">
                                                        <?foreach ($subSection['ITEMS'] as $itemSection){?>
                                                            <a href="<?=$itemSection['DETAIL_PAGE_URL']?>" class="megamenu__divein-events__item">
                                                                <div class="megamenu__divein-events__item-type">
                                                                    <?=$itemSection['PROPERTY_TYPE_VALUE']?>
                                                                    <?if($itemSection['DATE_ACTIVE_FROM']){?>
                                                                    \
                                                                        <?
                                                                        if($_COOKIE['mi_lang'] == 's2') {
                                                                            echo ucwords(str_replace(RU_SHORT_MONTH,RU_LONG_MONTH2,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                        }else{
                                                                            echo ucwords(str_replace(RU_SHORT_MONTH,EN_LONG_MONTH,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                        }
                                                                        ?>
                                                                    <?}?>
                                                                </div>
                                                                <div class="megamenu__divein-events__item-title"><?=$itemSection['NAME']?></div>
                                                            </a>
                                                        <?}?>
                                                    </div>
                                                <?}elseif ($subSection['UF_IBLOCK'] == COURSES){?>
                                                    <div class="megamenu__divein-courses">
                                                        <?foreach ($subSection['ITEMS'] as $itemSection){?>
                                                            <a href="<?=$itemSection['DETAIL_PAGE_URL']?>" class="megamenu__divein-courses__item">
                                                                <div class="megamenu__divein-courses__item-photo">
                                                                    <img src="<?=$itemSection['PREVIEW_PICTURE']?>" alt="">
                                                                </div>
                                                                <div class="megamenu__divein-courses__item-content">
                                                                    <div class="megamenu__divein-courses__item-top">
                                                                        <div class="megamenu__divein-courses__item-title">
                                                                            <?=$itemSection['NAME']?>
                                                                        </div>
                                                                        <?
                                                                        $author = $subSection['AUTHOR'][$itemSection['PROPERTY_AUTHOR_VALUE']]['NAME'];
                                                                        ?>
                                                                        <?if($author){?>
                                                                            <div class="megamenu__divein-courses__item-by">
                                                                                <?=$arHandBook['BY']['UF_VALUE']?> <span><?=$author?></span>
                                                                            </div>
                                                                        <?}?>
                                                                    </div>
                                                                    <?if($itemSection['PREVIEW_TEXT']){?>
                                                                        <div class="megamenu__divein-courses__item-meta">
                                                                            <?=$itemSection['PREVIEW_TEXT']?>
                                                                        </div>
                                                                    <?}?>
                                                                </div>
                                                            </a>
                                                        <?}?>
                                                    </div>
                                                <?}elseif ($subSection['UF_IBLOCK'] == BLOG){?>
                                                    <div class="megamenu__divein-blog">
                                                        <?foreach ($subSection['ITEMS'] as $itemSection){?>
                                                            <a href="<?=$itemSection['DETAIL_PAGE_URL']?>" class="megamenu__divein-blog__item" data-cat="<?=$subSection['SECTION_ELEMENT'][$itemSection['IBLOCK_SECTION_ID']]['CODE']?>">
                                                                <div class="megamenu__divein-blog__item-meta">
                                                                    <?=$subSection['SECTION_ELEMENT'][$itemSection['IBLOCK_SECTION_ID']]['NAME']?>
                                                                    <?if($itemSection['DATE_ACTIVE_FROM']){?>
                                                                        \
                                                                        <?
                                                                        if($_COOKIE['mi_lang'] == 's2') {
                                                                            echo ucwords(str_replace(RU_SHORT_MONTH,RU_LONG_MONTH2,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                        }else{
                                                                            echo ucwords(str_replace(RU_SHORT_MONTH,EN_LONG_MONTH,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                        }
                                                                        ?>
                                                                    <?}?>
                                                                </div>
                                                                <div class="megamenu__divein-blog__item-content">
                                                                    <div class="megamenu__divein-blog__item-photo">
                                                                        <?if($itemSection['PREVIEW_PICTURE']){?>
                                                                            <img src="<?=$itemSection['PREVIEW_PICTURE']?>" alt="">
                                                                        <?}?>
                                                                        <?if($itemSection['PROPERTY_TIME_VALUE']){?>
                                                                            <div class="megamenu__divein-blog__item-time">
                                                                                <span><?=$itemSection['PROPERTY_TIME_VALUE']?></span>
                                                                            </div>
                                                                        <?}?>
                                                                    </div>
                                                                    <div class="megamenu__divein-blog__item-title">
                                                                        <?=$itemSection['NAME']?>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        <?}?>
                                                    </div>
                                                <?}elseif ($subSection['UF_IBLOCK'] == INSIGHTS){?>
                                                    <div class="megamenu__divein-insights">
                                                        <?foreach ($subSection['ITEMS'] as $itemSection){?>
                                                            <a href="<?=$itemSection['DETAIL_PAGE_URL']?>" class="megamenu__divein-insights__item">
                                                                <div class="megamenu__divein-insights__item-photo">
                                                                    <?if($itemSection['PREVIEW_PICTURE']){?>
                                                                        <img src="<?=$itemSection['PREVIEW_PICTURE']?>" alt="">
                                                                    <?}?>
                                                                </div>
                                                                <div class="megamenu__divein-insights__item-content">
                                                                    <div class="megamenu__divein-insights__item-meta">
                                                                        <?if($itemSection['PROPERTY_NUMBER_VALUE']){?>
                                                                            №<?=$itemSection['PROPERTY_NUMBER_VALUE']?>
                                                                        <?}?>
                                                                        <?if($itemSection['DATE_ACTIVE_FROM']){?>
                                                                            \
                                                                            <?
                                                                            if($_COOKIE['mi_lang'] == 's2') {
                                                                                echo ucwords(str_replace(RU_SHORT_MONTH,RU_LONG_MONTH2,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                            }else{
                                                                                echo ucwords(str_replace(RU_SHORT_MONTH,EN_LONG_MONTH,FormatDate('d M Y',strtotime($itemSection['DATE_ACTIVE_FROM']))));
                                                                            }
                                                                            ?>
                                                                        <?}?>
                                                                    </div>
                                                                    <div class="megamenu__divein-insights__item-text">
                                                                        <?=$itemSection['NAME']?>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        <?}?>
                                                    </div>
                                                <?}elseif ($subSection['UF_IBLOCK'] == TEST){?>
                                                    <div class="megamenu__divein-tests">
                                                        <?foreach ($subSection['ITEMS'] as $itemSection){?>
                                                            <a href="<?=$itemSection['DETAIL_PAGE_URL']?>" class="megamenu__divein-tests__item">
                                                                <div class="megamenu__divein-tests__item-photo">
                                                                    <?if($itemSection['PREVIEW_PICTURE']){?>
                                                                        <img src="<?=$itemSection['PREVIEW_PICTURE']?>" alt="">
                                                                    <?}?>
                                                                </div>
                                                                <div class="megamenu__divein-tests__item-content">
                                                                    <div class="megamenu__divein-tests__item-title">
                                                                        <?=$itemSection['NAME']?>
                                                                    </div>
                                                                    <div class="megamenu__divein-tests__item-more hoverMe" data-attr="<?=$arHandBook['LETS_GO']['UF_VALUE']?>">
                                                                        <?=$arHandBook['LETS_GO']['UF_VALUE']?>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        <?}?>
                                                    </div>
                                                <?}?>
                                            </div>
                                        </div>
										<?php endif; ?>
                                        <?$i++;?>
                                    <?}?>
                                </div>
                            </div>
                            <div class="megamenu__divein-tools">
                                <div class="megamenu__divein-left">
                                    <div class="megamenu__divein-button__wrap">
                                        <?if($item['PARAMS']['UF_LINK_BOTTOM']){?>
                                            <a href="<?=$item['PARAMS']['UF_LINK_BOTTOM']?>" class="hoverMe button" data-attr="<?=$item['PARAMS']['UF_LINK_BOTTOM_TEXT']?>"><?=$item['PARAMS']['UF_LINK_BOTTOM_TEXT']?></a>
                                        <?}?>
                                    </div>
                                </div>
                                <div class="megamenu__divein-right">
                                    <div class="megamenu__divein-links">
                                        <?$i=0;?>
                                        <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                                            <?if($subSection['UF_LINK']){?>
                                                <a href="<?=$subSection['UF_LINK']?>" class="megamenu__divein-links__item hoverMe <?=($i == 0)?'active':''?>" data-attr="<?=$subSection['UF_LINK_TITLE']?>"><?=$subSection['UF_LINK_TITLE']?></a>
                                            <?}?>
                                            <?$i++;?>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
            </li>
        <?}?>
    </ul>
</nav>