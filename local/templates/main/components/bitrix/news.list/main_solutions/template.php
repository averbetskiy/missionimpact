<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?
if($arResult['ITEMS']) {?>
    <div class="indexSection2">
        <div class="container">
            <h3 class="index__heading"><?=$arHandBook['MAIN_BLOCK_SOLUTIONS_NAME']['UF_VALUE']?></h3>
            <div class="heading__columns __multiply">
                <div class="heading__columns-title">
                    <?=$arHandBook['MAIN_BLOCK_SOLUTIONS_TEXT_NAME']['UF_VALUE']?>
                </div>
            </div>
            <div class="heading__columns">
                <div class="heading__columns-subtitle">
                    <?=$arHandBook['MAIN_BLOCK_SOLUTIONS_SUBTEXT_NAME']['UF_VALUE']?>
                </div>
                <div class="heading__columns-subtitle"><a href="/solutions/"><?=$arHandBook['MAIN_BLOCK_SOLUTIONS_VIEW_TEXT_NAME']['UF_VALUE']?></a></div>
            </div>
            <div class="indexSection2__cards">
                <?foreach ($arResult['ITEMS'] as $item){?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="indexSection2__cards-item" target="_blank">
                        <div class="indexSections2__cards_item-media">
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                        </div>
                        <div class="indexSections2__cards_item-content">
                            <div class="indexSections2__cards_item-top">
                                <div class="indexSections2__cards_item-logo">
                                    <?if($item['DISPLAY_PROPERTIES']['logo']['FILE_VALUE']['SRC']){?>
                                        <img src="<?=$item['DISPLAY_PROPERTIES']['logo']['FILE_VALUE']['SRC']?>" alt="">
                                    <?}?>
                                </div>
                                <div class="indexSections2__cards_item-title"><?=$item['NAME']?></div>
                            </div>
                            <div class="indexSections2__cards_item-more"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                        </div>
                    </a>
                <?}?>
            </div>
        </div>
    </div>
    <?
}
?>
