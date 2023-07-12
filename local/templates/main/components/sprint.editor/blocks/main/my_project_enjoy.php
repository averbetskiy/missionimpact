<? /** @var $block array */?>
<?
global $arHandBook;
if($block['blog']['iblock_id']) {
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE", "PREVIEW_TEXT", "DATE_ACTIVE_FROM","PROPERTY_LINK"];
    $arFilter = ["IBLOCK_ID" => $block['blog']['iblock_id'], "ACTIVE" => "Y"];
    $sort = ["ACTIVE_FROM" => "DESC"];
    if ($block['blog']['element_ids']) {
        $arFilter['ID'] = $block['blog']['element_ids'];
        $sort = ["ID" => $block['blog']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize" => 3], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arBlog[] = $ob->GetFields();
    }
}
?>
<div class="enjoy">
    <div class="container">
        <div class="heading__columns">
            <?if($block['htag']['value']){?>
                <div class="heading__columns-title"><?=$block['htag']['value']?></div>
            <?}?>
            <?if($block['link']['value']){?>
                <div class="heading__columns-subtitle">
                    <a href="<?=$block['link']['value']?>" target="_blank" class="hoverMe" data-attr="<?=strip_tags($block['text']['value'])?>"><?=$block['text']['value']?></a>
                </div>
            <?}?>
        </div>
        <div class="enjoy__list">
            <?foreach ($arBlog as $item){?>
                <div class="enjoy__item indexSection4__item">
                    <div class="enjoy__item-top">
 						<a href="<?=$item['PROPERTY_LINK_VALUE'];?>" class="enjoy__item-photo" target="_blank">
                            <?if($item['PREVIEW_PICTURE']){?>
                                <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                            <?}?>
                        </a>
                        <div class="enjoy__item-date">
                            <?if($item['DATE_ACTIVE_FROM']){?>
                                <?
                                if($_COOKIE['mi_lang'] == 's2') {
                                    echo FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']));
                                }else{
                                    echo ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']))));
                                }
                                ?>
                            <?}?>
                        </div>
                        <div class="enjoy__item-title"><?=$item['NAME']?></div>
                        <div class="enjoy__item-text__wrap">
							<p class="enjoy__item-text"><?=$item['PREVIEW_TEXT']?></p>
							<?php
								$readMore = "Read More";
								$readLess = "Read Less";
								if ($_COOKIE['mi_lang']=='s2') {
									$readMore = "Читать больше";
									$readLess = "Читать меньше";
								}
							?>
							<div class="slide-read-more-button read-more-button"><?=$readMore;?></div>
							<div class="slide-read-more-button"><?=$readLess;?></div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>
