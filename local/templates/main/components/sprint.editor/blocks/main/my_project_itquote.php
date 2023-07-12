<? /** @var $block array */?>
<?
if($block['speaker']['iblock_id']) {
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE","PREVIEW_TEXT","DETAIL_TEXT","PROPERTY_post","PROPERTY_city","PROPERTY_IT_PHOTO",];
    $arFilter = ["IBLOCK_ID" => $block['speaker']['iblock_id'], "ACTIVE" => "Y"];
    $sort = ["ACTIVE_FROM" => "DESC"];
    if ($block['speaker']['element_ids']) {
        $arFilter['ID'] = $block['speaker']['element_ids'];
        $sort = ["ID" => $block['speaker']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize" => 1], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arSpeaker = $ob->GetFields();
    }
}
?>
<div class="itquote">
    <div class="container">
        <div class="itquote__wrap">
            <div class="itquote__content">
                <div class="itquote__text"><?=$block['text']['value']?></div>
                <div class="itquote__meta">
                    <div class="itquote__meta-name"><?=$arSpeaker['NAME']?></div>
                    <?if($arSpeaker['PROPERTY_POST_VALUE']){?>
                        <div class="itquote__meta-post"><?=$arSpeaker['PROPERTY_POST_VALUE']?></div>
                    <?}?>
                    <div class="itquote__meta-info"><?=$arSpeaker['PREVIEW_TEXT']?></div>
                </div>
            </div>
            <div class="itquote__photo">
                <?if($arSpeaker['PROPERTY_IT_PHOTO_VALUE']){?>
                    <img src="<?=CFile::GetPath($arSpeaker['PROPERTY_IT_PHOTO_VALUE'])?>" alt="">
                <?}?>
            </div>
        </div>
    </div>
</div>
