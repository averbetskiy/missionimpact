<? /** @var $block array */?>
<?
if($block['partners']['iblock_id']) {
    $arItem = [];
    $arFilter = [];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME","PREVIEW_PICTURE","PROPERTY_external_link"];
    $arFilter = ["IBLOCK_ID" => $block['partners']['iblock_id']];
    if($block['partners']['element_ids']){
        $arFilter['ID'] = $block['partners']['element_ids'];
    }
    $res = CIblockElement::GetList(["ID" => $block['partners']['element_ids']], $arFilter, false, [], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
        $arItem['PROPERTIES'] = $ob->GetProperties();
    }
}
?>
<div class="indexMission">
    <div class="container">
        <div class="indexMission__wrap">
            <div class="indexMission__top">
                <div class="indexMission__uptitle"><?=$block['name_block']['value']?></div>
                <div class="indexMission__title"><?=$block['title']['value']?></div>
            </div>
            <div class="indexMission__logos">
                <?foreach ($arItem as $item){?>
                    <?if($item['PREVIEW_PICTURE']){?>
                        <div class="indexMission__logos-item">
                            <?if($item['PROPERTY_EXTERNAL_LINK_VALUE']){?>
                                <a href="<?=$item['PROPERTY_EXTERNAL_LINK_VALUE']?>">
                            <?}?>
                            <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                            <?if($item['PROPERTY_EXTERNAL_LINK_VALUE']){?>
                                </a>
                            <?}?>
                        </div>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>