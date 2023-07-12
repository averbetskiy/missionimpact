<? /** @var $block array */?>
<?
global $arHandBook;
$arSpeakers = [];
$arSpeakersType = [];
$arSpeakersTypeAll = [];
$companyIds = [];
$arCompany = [];
$arSelect = ["ID", "NAME", "DATE_ACTIVE_FROM",'PROPERTY_type','PROPERTY_post','PROPERTY_city','PROPERTY_company','DETAIL_PICTURE','PREVIEW_PICTURE','PREVIEW_TEXT','DETAIL_TEXT'];
$arFilter = ["IBLOCK_ID" => SPEAKER , "ACTIVE"=>"Y","PROPERTY_contributors_VALUE" => 'Y'];
$res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, [], $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arSpeakersType[$arFields['PROPERTY_TYPE_ENUM_ID']] = $arFields['PROPERTY_TYPE_VALUE'];
    $companyIds[] = $arFields['PROPERTY_COMPANY_VALUE'];
    $arSpeakers[] = $arFields;
}
$propertyEnums = CIBlockPropertyEnum::GetList(['SORT' => 'ASC'], Array("IBLOCK_ID"=>SPEAKER, "CODE"=>"TYPE"));
while($enumFields = $propertyEnums->GetNext())
{
    $arSpeakersTypeAll[$enumFields['ID']] = $enumFields['XML_ID'];
}
$rsCompany = \Bitrix\Iblock\ElementTable::getList([
    'select' => ['ID','NAME'],
    'filter' => ['IBLOCK_ID' => COMPANY]
]);
while($company = $rsCompany->fetch()){
    $arCompany[$company['ID']] = $company;
}
?>
<div class="contributors__tabs filtering">
    <div class="tabs__head">
        <a href="#" class="tabs__head-item filtering__button cat-all active hoverMe" data-attr="<?=$arHandBook['ALL_CONTRIBUTORS']['UF_VALUE']?>"><?=$arHandBook['ALL_CONTRIBUTORS']['UF_VALUE']?></a>
        <?foreach ($arSpeakersType as $key => $type){?>
            <a href="#" class="tabs__head-item filtering__button hoverMe" data-attr="<?=$type?>" data-cat="<?=$arSpeakersTypeAll[$key]?>"><?=$type?></a>
        <?}?>
    </div>
    <div class="contributors__list filter-cat-results">
        <?foreach ($arSpeakers as $speaker){?>
            <div class="contributors__item f-cat" id="search<?=$speaker['ID']?>" data-cat="<?=$arSpeakersTypeAll[$speaker['PROPERTY_TYPE_ENUM_ID']]?>">
                <div class="contributors__item-card">
                    <div class="contributors__card-media">
                        <img src="<?=CFile::GetPath(($speaker['DETAIL_PICTURE'])?$speaker['DETAIL_PICTURE']:$speaker['PREVIEW_PICTURE'])?>" alt="">
                    </div>
                    <div class="contributors__card-content">
                        <div class="contributors__card-name"><?=$speaker['NAME']?></div>
                        <div class="contributors__card-post"><?=$speaker['PROPERTY_POST_VALUE']?></div>
                        <div class="contributors__card-city"><?=$speaker['PROPERTY_CITY_VALUE']?></div>
                    </div>
                </div>
                <div class="contributors__item-full">
                    <div class="contributors__info">
                        <div class="contributors__info-overlay"></div>
                        <div class="contributors__info-wrap">
                            <div class="contributors__info-inner">
                                <button class="contributors__info-close">✕</button>
                                <div class="contributors__info-left">
                                    <div class="contributors__info-photo">
                                        <?if($speaker['DETAIL_PICTURE'] || $speaker['PREVIEW_PICTURE']){?>
                                            <img src="<?=CFile::GetPath(($speaker['DETAIL_PICTURE'])?$speaker['DETAIL_PICTURE']:$speaker['PREVIEW_PICTURE'])?>" alt="">
                                        <?}?>
                                    </div>
                                    <div class="contributors__info-company"><?=$arCompany[$speaker['PROPERTY_COMPANY_VALUE']]['NAME']?></div>
                                    <div class="contributors__info-category"><?=$speaker['PROPERTY_TYPE_VALUE']?></div>
                                </div>
                                <div class="contributors__info-right">
                                    <div class="contributors__info-name"><?=$speaker['NAME']?></div>
                                    <div class="contributors__info-post"><?=$speaker['PROPERTY_POST_VALUE']?></div>
                                    <div class="contributors__info-about">
                                        <?=$speaker['PREVIEW_TEXT']?>
                                    </div>
                                    <div class="contributors__info-text">
                                        <?=$speaker['DETAIL_TEXT']?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?}?>
    </div>
</div>