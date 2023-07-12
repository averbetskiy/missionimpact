<? /** @var $block array */?>
<?
global $arHandBook;
if($block['program']['iblock_id']) {
    $arItem = [];
    $sort = ["ID" => "DESC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE"];
    $arFilter = ["IBLOCK_ID" => $block['program']['iblock_id']];
    if($block['program']['element_ids']){
        $arFilter['ID'] = $block['program']['element_ids'];
        $sort = ["ID" => $block['program']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize"=>2], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[] = $arFields;
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
        <div class="diveinPage__courses">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="diveinPage__courses-item">
                    <div class="diveinPage__courses-item__media">
                        <?if($item['PREVIEW_PICTURE']){?>
                            <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                        <?}?>
                    </div>
                    <div class="diveinPage__courses-item__content">
                        <div class="diveinPage__courses-item__title"><?=$item['NAME']?></div>
                        <div class="diveinPage__courses-item__more hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
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