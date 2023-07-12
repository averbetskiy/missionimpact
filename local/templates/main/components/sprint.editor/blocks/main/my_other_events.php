<? /** @var $block array */?>
<?
global $APPLICATION;
global $arHandBook;
?>
<?
$arItem = [];
if($block['events']['iblock_id']) {
    $sort = ['ID' => 'DESC'];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","PREVIEW_PICTURE","PROPERTY_logo"];
    $arFilter = ["IBLOCK_ID" => $block['events']['iblock_id']];
    if($block['events']['element_ids']){
        $arFilter['ID'] = $block['events']['element_ids'];
        $sort = ["ID" => $block['events']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize" => 3], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
    }
}
?>
<div class="projectOthers">
    <div class="container">
        <div class="heading__columns">
            <div class="heading__columns-title"><?=$block['title']['value']?></div>
            <div class="heading__columns-subtitle">
                <?if($block['link']['value']){?>
                    <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
                <?}?>
            </div>
        </div>
        <div class="aboutCases__wrap">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="aboutCases__item">
                    <div class="aboutCases__item-media">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="<?=$item['NAME']?>">
                        <?}?>
                    </div>
                    <div class="aboutCases__item-content">
                        <div class="aboutCases__item-top">
							<?if($item['PROPERTY_LOGO_VALUE']){?>
                            	<div class="aboutCases__item-logo">
                                    <img src="<?=CFile::GetPath($item['PROPERTY_LOGO_VALUE'])?>" alt="">
                            	</div>
							<?}?>
                            <div class="aboutCases__item-title"><?=$item['NAME']?></div>
                        </div>
                        <div class="aboutCases__item-bottom hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
</div>