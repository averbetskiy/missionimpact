<? /** @var $block array */?>
<?
global $APPLICATION;
global $arHandBook;
?>
<?
$arItem = [];
if($block['cases']['element_ids']) {
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","PROPERTY_logo","PREVIEW_PICTURE"];
    $arFilter = ["IBLOCK_ID" => $block['cases']['iblock_id'], "ID" => $block['cases']['element_ids']];
    $res = CIblockElement::GetList(["ACTIVE_FROM" => "DESC"], $arFilter, false, [], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
    }
}
?>
<div class="aboutCases__wrap">
    <?foreach ($arItem as $item){?>
        <a href="<?=$item['DETAIL_PAGE_URL']?>" class="aboutCases__item">
			<div class="aboutCases__item-media">
				<img src="<?=CFile::GetPath($item['PREVIEW_PICTURE']);?>" alt="<?=$item['NAME']?>">
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