<? /** @var $block array */?>
<?
$arSpeakers = [];
$arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME","PREVIEW_PICTURE","PROPERTY_CITY","PROPERTY_POST"];
$arFilter = ["IBLOCK_ID" => $block['speakers']['iblock_id']];
if($block['speakers']['element_ids']){
    $arFilter['ID'] = $block['speakers']['element_ids'];
    $res = CIblockElement::GetList(["ID" => $block['speakers']['element_ids']], $arFilter, false, [], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arSpeakers[] = $ob->GetFields();
    }
}
?>
<div class="projectSpeakers1">
    <div class="container">
        <div class="projectSpeakers1__wrap">
            <?if($arSpeakers){?>
                <div class="projectSpeakers1__list" data-count="<?php echo count($arSpeakers); ?>">
                    <?foreach ($arSpeakers as $speaker){?>
                        <div class="projectSpeakers1__item">
                            <div class="projectSpeakers1__item-photo">
                                <img src="<?=CFile::GetPath($speaker['PREVIEW_PICTURE'])?>" alt="<?=$speaker['NAME']?>">
                            </div>
                            <div class="projectSpeakers1__item-content">
                                <div class="projectSpeakers1__item-name"><?=$speaker['NAME']?></div>
                                <div class="projectSpeakers1__item-post"><?=$speaker['PROPERTY_POST_VALUE']?></div>
                                <div class="projectSpeakers1__item-city"><?=$speaker['PROPERTY_CITY_VALUE']?></div>
                            </div>
                        </div>
                    <?}?>
                </div>
            <?}?>
            <div class="projectSpeakers1__content">
                <?if($block['htag']['value']){?>
                    <<?=$block['htag']['type']?> class="index__heading"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
                <?}?>
                <div class="heading__columns-title"><?=$block['text']['value']?></div>
                <div class="heading__columns-subtitle"><?=$block['desc']['value']?></div>
            </div>
        </div>
    </div>
</div>