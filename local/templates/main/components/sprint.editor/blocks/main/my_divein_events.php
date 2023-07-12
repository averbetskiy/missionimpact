<? /** @var $block array */?>
<?
global $arHandBook;
if($block['events']['iblock_id']) {
    $arItem = [];
    $arTags = [];
    $sort = ["ACTIVE_FROM" => "ASC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE","PROPERTY_logo","PROPERTY_tags","PROPERTY_type","PREVIEW_TEXT"];
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
<div class="diveinPage__wrap">
    <div class="diveinPage__left">
        <div class="diveinPage__wrap-top">
            <?if($block['name_block']['value']){?>
                <<?=$block['name_block']['type']?> class="diveinPage__left-title"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
            <?}?>
            <div class="diveinPage__left-desc">
                <?=$block['desc']['value']?>
            </div>
        </div>
        <?if($block['link']['value']){?>
			<div>
				<a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe" data-attr="<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>">
					<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>
				</a>
			</div>
        <?}?>
    </div>
    <div class="diveinPage__right">
        <div class="diveinPage__events">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="diveinPage__events-item">
                    <div class="diveinPage__events-item__media">
                        <div class="diveinPage__events-item__media-photo">
                            <?if($item['PREVIEW_PICTURE']){?>
                                <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                            <?}?>
                        </div>
                        <?if($arTags[$item['ID']]){?>
                            <div class="diveinPage__events-item__media-tags">
                                <?foreach ($arTags[$item['ID']] as $tag){?>
                                    <div class="diveinPage__events-item__media-tags__item"><?=$tag?></div>
                                <?}?>
                            </div>
                        <?}?>

                    </div>
                    <div class="diveinPage__events-item__content">
                        <div class="diveinPage__events-item__content-date">
                            <?if($item['DATE_ACTIVE_FROM']){?>
                                <?
                                if($_COOKIE['mi_lang'] == 's2') {
                                    echo ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']))));
                                }else{
                                    echo ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']))));
                                }
                                ?>
                            <?}?>
                        </div>
                        <div class="diveinPage__events-item__content-title"><?=$item['NAME']?></div>
                        <div class="diveinPage__events-item__content-text">
                            <?=$item['PREVIEW_TEXT']?>
                        </div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
    <?if($block['link']['value']){?>
        <a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe _mobile" data-attr="<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>">
            <?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>
        </a>
    <?}?>
</div>
