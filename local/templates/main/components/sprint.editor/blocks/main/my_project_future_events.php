<? /** @var $block array */?>
<?
global $arHandBook;
if($block['blog']['iblock_id']) {
    $arItem = [];
    $sort = ["ACTIVE_FROM" => "ASC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_PAGE_URL","DATE_ACTIVE_FROM"];
    $arFilter = ["IBLOCK_ID" => $block['blog']['iblock_id'], "ACTIVE" => "Y"];
    if ($block['blog']['element_ids']) {
        $arFilter['ID'] = $block['blog']['element_ids'];
        $sort = ["ID" => $block['blog']['element_ids']];
    }
    $arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize" => 2], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[] = $arFields;
    }
}
$large = true;
if($block['checkbox']['value'] == true){
    $large = false;
}
?>
<?if($arItem){?>
    <div class="itfuture">
        <div class="container">
            <div class="heading__columns">
                <div class="heading__columns-title"><p><?=$block['text']['value']?></p></div>
                <div class="heading__columns-subtitle">
                    <?if($block['link']['value']){?>
                        <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?=strip_tags($block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
                    <?}?>
                </div>
            </div>
            <div class="itfuture__list">
                <?$i = 1;?>
                <?foreach ($arItem as $item){?>
                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="itfuture__item <?if($large == true && $i == 1){?>__large<?}?> <?if($large == false && $i == 2){?>__large<?}?> indexSection4__item">
                        <div class="itfuture__item-photo">
                            <div class="itfuture__item-photo__poster">
                                <?if($item['PREVIEW_PICTURE']){?>
                                    <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                <?}?>
                            </div>
                            <div class="itfuture__item-photo__info">
                                <div class="itfuture__item-title"><?=$item['NAME']?></div>
                                <div class="itfuture__item-text"><p><?=$item['PREVIEW_TEXT']?></p></div>
                            </div>
                        </div>
                        <div class="itfuture__item-date">
                            <?
                            if($_COOKIE['mi_lang'] == 's2') {
                                echo FormatDate('d F Y',strtotime($item['DATE_ACTIVE_FROM']));
                            }else{
                                echo ucwords(str_replace(RU_SHORT_MONTH,EN_LONG_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']))));
                            }
                            ?>
                        </div>
                        <div class="indexSection4__item-more hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </a>
                    <?$i++;?>
                <?}?>
            </div>
        </div>
    </div>
<?}?>