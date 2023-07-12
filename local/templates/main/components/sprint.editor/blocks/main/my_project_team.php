<? /** @var $block array */?>
<?
if($block['speakers']['iblock_id']) {
    $arItem = [];
    $sort = ["ID" => "DESC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "PREVIEW_PICTURE","DETAIL_TEXT","PROPERTY_post","PROPERTY_city","PROPERTY_IT_PHOTO","PROPERTY_IT_PHOTO_BIG"];
    $arFilter = ["IBLOCK_ID" => $block['speakers']['iblock_id'], "ACTIVE" => "Y"];
    if ($block['speakers']['element_ids']) {
        $arFilter['ID'] = $block['speakers']['element_ids'];
        $sort = ["ID" => $block['speakers']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, [], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[] = $arFields;
    }
}
?>
<div class="itteam">
    <div class="container">
        <div class="itteam__wrap">
            <div class="itteam__content">
                <p class="index__heading __multiply"><?=$block['htag']['value']?></p>
                <div class="heading__columns-title"><?=$block['text']['value']?></div>
                <div class="itteam__text"><?=$block['desc']['value']?></div>
            </div>
            <div class="itteam__mask">
                <?=$block['mask']['value']?>
            </div>
        </div>
        <div class="itteam__list">
            <div class="itteam__list-scroll">
                <?foreach ($arItem as $item){?>
                    <div class="itteam__item">
                        <div class="itteam__item-card active">
                            <div class="itteam__item-card__wrap">
                                <div class="itteam__item-card__info">
                                    <div class="itteam__item-card__name"><?=$item['NAME']?></div>
                                    <div class="itteam__item-card__post"><?=$item['PROPERTY_POST_VALUE']?></div>
                                    <div class="itteam__item-card__place"><?=$item['PROPERTY_CITY_VALUE']?></div>
                                </div>
                                <div class="itteam__item-card__photo">
                                    <?if($item['PROPERTY_IT_PHOTO_VALUE']){?>
                                        <img src="<?=CFile::GetPath($item['PROPERTY_IT_PHOTO_VALUE'])?>" alt="">
                                    <?}?>
                                </div>
                            </div>
                        </div>
                        <div class="itteam__item-full">
                            <div class="itteam__info">
                                <div class="itteam__info-overlay"></div>
                                <div class="itteam__info-wrap">
                                    <div class="itteam__info-inner">
                                        <button class="itteam__info-close">✕</button>
                                        <div class="itteam__info-left">
                                            <div class="itteam__info-photo">
                                                <?if($item['PROPERTY_IT_PHOTO_BIG_VALUE']){?>
                                                    <img src="<?=CFile::GetPath($item['PROPERTY_IT_PHOTO_BIG_VALUE'])?>" alt="">
                                                <?}?>
                                            </div>
                                        </div>
                                        <div class="itteam__info-right">
                                            <div class="itteam__info-name"><?=$item['NAME']?></div>
                                            <div class="itteam__info-post"><?=$item['PROPERTY_POST_VALUE']?><span><?=$item['PROPERTY_CITY_VALUE']?></span></div>
                                            <div class="itteam__info-text">
                                                <p><?=$item['DETAIL_TEXT']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?}?>
            </div>
            <div class="itteam__list-scrollbar">
                <div class="itteam__list-scrollbar-thumb"></div>
            </div>
        </div>
    </div>
</div>
