<? /** @var $block array */?>
<?
global $arHandBook;
if($block['solutions']['iblock_id']) {
    $arItem = [];
    $arFilter = [];
    $sort = ["ACTIVE_FROM" => "ASC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE","PROPERTY_logo"];
    $arFilter = ["IBLOCK_ID" => $block['solutions']['iblock_id']];
    if($block['solutions']['element_ids']){
        $arFilter['ID'] = $block['solutions']['element_ids'];
        $sort = ["ID" => $block['solutions']['element_ids']];
    }else{
        $arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize"=>3], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
    }
}
?>
<div class="indexSection2">
    <div class="container">
        <?if($block['name_block']['value']){?>
            <<?=$block['name_block']['type']?> class="index__heading"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
        <?}?>
        <div class="heading__columns __multiply">
            <div class="heading__columns-title">
                <?=$block['title']['value']?>
            </div>
        </div>
        <div class="heading__columns">
            <div class="heading__columns-subtitle">
                <?=$block['sub_title']['value']?>
            </div>
            <div class="heading__columns-subtitle">
                <?if($block['link']['value']){?>
                    <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?php echo strip_tags($block['text_botton']['value']); ?>"><?=$block['text_botton']['value']?></a>
                <?}?>
            </div>
        </div>
        <div class="indexSection2__cards">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="indexSection2__cards-item" target="_blank">
                    <div class="indexSections2__cards_item-media">
                        <?if($item['PREVIEW_PICTURE']){?>
                            <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                        <?}?>
                    </div>
                    <div class="indexSections2__cards_item-content">
                        <div class="indexSections2__cards_item-top">
							<?if($item['PROPERTY_LOGO_VALUE']){?>
								<div class="indexSections2__cards_item-logo">
                                    <img src="<?php echo CFile::GetPath($item['PROPERTY_LOGO_VALUE']); ?>" alt="">
                            	</div>
							<?}?>
                            <div class="indexSections2__cards_item-title"><?=$item['NAME']?></div>
                        </div>
                        <div class="indexSections2__cards_item-more hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
</div>