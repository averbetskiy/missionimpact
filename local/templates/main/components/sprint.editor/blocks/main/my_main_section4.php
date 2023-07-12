<? /** @var $block array */?>
<?
global $arHandBook;
if($block['events']['iblock_id']) {
    $arItem = [];
    $arTags = [];
    $sort = ["ACTIVE_FROM" => "ASC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE","PROPERTY_logo","PROPERTY_tags","PROPERTY_type"];
    $arFilter = ["IBLOCK_ID" => $block['events']['iblock_id']];
    if($block['events']['element_ids']){
        $arFilter['ID'] = $block['events']['element_ids'];
        $sort = ["ID" => $block['events']['element_ids']];
    }else{
        $arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize"=>10], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[$arFields['ID']] = $arFields;
        if($arFields['PROPERTY_TAGS_VALUE']) {
            $arTags[$arFields['ID']][] = $arFields['PROPERTY_TAGS_VALUE'];
        }
    }
}
?>
<div class="indexSection4">
    <div class="container">
        <?if($block['name_block']['value']){?>
            <<?=$block['name_block']['type']?> class="index__heading"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
        <?}?>
        <div class="heading__columns">
            <div class="heading__columns-title"><?=$block['title']['value']?></div>
            <div class="heading__columns-subtitle">
                <?if($block['link']['value']){?>
                    <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?=strip_tags($block['text_botton']['value']);?>"><?=$block['text_botton']['value']?></a>
                <?}?>
            </div>
        </div>
        <div class="indexSection4__wrap">
            <?$i = 0;?>
            <?foreach ($arItem as $item){?>
                <?
                if($i > 2){break;}
                $i++;
                ?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="indexSection4__item">
                    <div class="indexSection4__item-media">
                        <div class="indexSection4__item_media-photo">
                            <?if($item['PREVIEW_PICTURE']){?>
                                <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                            <?}?>
                        </div>
                        <div class="indexSection4__item_media-content">
                            <div class="indexSection4__item_media-top">
                                <?if($item['PROPERTY_TYPE_VALUE']){?>
                                    <div class="indexSection4__item_media-type"><?=$item['PROPERTY_TYPE_VALUE']?></div>
                                <?}?>
                                <div class="indexSection4__item_media-title"><?=$item['NAME']?></div>
                            </div>
                            <div class="indexSection4__item_media-bottom">
                                <div class="indexSection4__item_media-logo">
                                    <?if($item['PROPERTY_LOGO_VALUE']){?>
                                        <img src="<?=CFile::GetPath($item['PROPERTY_LOGO_VALUE'])?>" alt="">
                                    <?}?>
                                </div>
                                <?if($arTags[$item['ID']]){?>
                                    <div class="indexSection4__item_media-tags">
                                        <?foreach ($arTags[$item['ID']] as $tag){?>
                                            <div class="indexSection4__item_media_tags-item"><?=$tag?></div>
                                        <?}?>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
                    <div class="indexSection4__item-content">
                        <div class="indexSection4__item-date">
                            <?if($item['DATE_ACTIVE_FROM']){?>
                                <?
                                if($_COOKIE['mi_lang'] == 's2') {
									echo FormatDate('d F Y',strtotime($item['DATE_ACTIVE_FROM']));
                                }else{
									echo str_replace(RU_LONG_MONTH, EN_LONG_MONTH, FormatDate('d F Y', strtotime($item['DATE_ACTIVE_FROM'])));
                                }
                                ?>
                            <?}?>
                        </div>
						<div class="indexSection4__item-more hoverMe" data-attr="<?=strip_tags($arHandBook['LEARN_MORE']['UF_VALUE']);?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
</div>
