<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?if($arResult['ITEMS']){?>
    <div class="indexSection4">
        <div class="container">
            <h3 class="index__heading"><?=$arHandBook['MAIN_BLOCK_NAME_EVENTS']['UF_VALUE']?></h3>
            <div class="heading__columns">
                <div class="heading__columns-title"><?=$arHandBook['MAIN_BLOCK_EVENTS_TEXT']['UF_VALUE']?></div>
                <div class="heading__columns-subtitle"><a href="/events/"><?=$arHandBook['MAIN_BLOCK_EVETNS_VIEW']['UF_VALUE']?></a></div>
            </div>
            <div class="indexSection4__wrap ">
                <?foreach ($arResult['ITEMS'] as $item){?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="indexSection4__item ">
                        <div class="indexSection4__item-media">
                            <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                <div class="indexSection4__item_media-photo">
                                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                                </div>
                            <?}?>
                            <div class="indexSection4__item_media-content">
                                <div class="indexSection4__item_media-top">
                                    <div class="indexSection4__item_media-type"><?=$item['PROPERTIES']['type']['VALUE']?></div>
                                    <div class="indexSection4__item_media-title"><?=$item['NAME']?></div>
                                </div>
                                <div class="indexSection4__item_media-bottom">
                                    <div class="indexSection4__item_media-logo">
                                        <?if($item['PROPERTIES']['logo']['VALUE']){?>
                                            <img src="<?=CFile::GetPath($item['PROPERTIES']['logo']['VALUE'])?>" alt="">
                                        <?}?>
                                    </div>
                                    <div class="indexSection4__item_media-tags">
                                        <?foreach ($item['PROPERTIES']['tags']['VALUE'] as $tag){?>
                                            <div class="indexSection4__item_media_tags-item"><?=$tag?></div>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="indexSection4__item-content">
                            <div class="indexSection4__item-date"><?=$item['DISPLAY_ACTIVE_FROM']?></div>
                            <div class="indexSection4__item-more"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                        </div>
                    </a>
                <?}?>
            </div>
        </div>
    </div>
<?}?>