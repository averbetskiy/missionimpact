<? /** @var $block array */?>
<?
global $arHandBook;
if($block['insights']['iblock_id']) {
    $arItem = [];
    $arTags = [];
    $sort = ["ACTIVE_FROM" => "ASC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE","PREVIEW_TEXT"];
    $arFilter = ["IBLOCK_ID" => $block['insights']['iblock_id']];
    if($block['insights']['element_ids']){
        $arFilter['ID'] = $block['insights']['element_ids'];
        $sort = ["ID" => $block['insights']['element_ids']];
    }else{
        $arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize"=>3], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[$arFields['ID']] = $arFields;
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
            	<a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe" data-attr="<?=$block['text_botton']['value']?>"><?=$block['text_botton']['value']?></a>
			</div>
		<?}?>
    </div>
    <div class="diveinPage__right">
        <div class="diveinPage__insights">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="diveinPage__insights-item">
                    <div class="diveinPage__insights-item__media">
                        <?if($item['PREVIEW_PICTURE']){?>
                            <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                        <?}?>
                    </div>
                    <div class="diveinPage__insights-item__content">
                        <div class="diveinPage__insights-item__date">
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
                        <div class="diveinPage__insights-item__title"><?=$item['NAME']?></div>
                        <div class="diveinPage__insights-item__desc"><?=$item['PREVIEW_TEXT']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
    <?if($block['link']['value']){?>
        <a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe _mobile" data-attr="<?=$block['text_botton']['value']?>"><?=$block['text_botton']['value']?></a>
    <?}?>
</div>
