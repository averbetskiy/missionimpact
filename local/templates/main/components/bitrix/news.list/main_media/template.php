<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?$this->SetViewTarget('blog_news');?>
<div class="divein__blog">
    <div class="divein__blog-list">
        <?foreach ($arResult['ITEMS'] as $item){?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="divein__blog-item" data-cat="articles">
                <div class="divein__blog_item-top">
                    <div class="divein__blog_item-meta">
                        <?if($item['IBLOCK_ID'] == INSIGHTS){?>
                            <span class="orange"><?=($item['PROPERTIES']['number']['VALUE'])?'№'.$item['PROPERTIES']['number']['VALUE']:''?></span> <?=($item['DISPLAY_ACTIVE_FROM'])?' \ '.$item['DISPLAY_ACTIVE_FROM']:''?>
                        <?}else{?>
                            <?=$item['SECTION_NAME'].' \ '.$item['DISPLAY_ACTIVE_FROM']?>
                        <?}?>
                    </div>
                    <div class="divein__blog_item-photo">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                        <?}?>
                    </div>
                    <div class="divein__blog_item-title"><?=$item['NAME']?></div>
                </div>
                <div class="divein__blog_item-more hoverMe" data-attr="<?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?>"><?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?></div>
            </a>
        <?}?>
    </div>
</div>
<?$this->EndViewTarget();?>