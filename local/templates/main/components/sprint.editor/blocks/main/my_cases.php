<? /** @var $block array */?>
<?
global $arHandBook;
$arCases = [];
$arCasesType = [];
$arCasesTypeAll = [];
$arSelect = ["ID", "NAME", "DATE_ACTIVE_FROM",'DETAIL_PICTURE','PREVIEW_PICTURE','PREVIEW_TEXT','DETAIL_TEXT','DETAIL_PAGE_URL','PROPERTY_logo','PROPERTY_type'];
$arFilter = ["IBLOCK_ID" => CASES , "ACTIVE"=>"Y"];
$res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, [], $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arCasesType[$arFields['PROPERTY_TYPE_ENUM_ID']] = $arFields['PROPERTY_TYPE_VALUE'];
    $arCases[] = $arFields;
}
$propertyEnums = CIBlockPropertyEnum::GetList(['SORT' => 'ASC'], Array("IBLOCK_ID"=>CASES, "CODE"=>"TYPE"));
while($enumFields = $propertyEnums->GetNext())
{
    $arCasesTypeAll[$enumFields['ID']] = $enumFields['XML_ID'];
}
?>
<div class="solutions__tabs filtering">
    <div class="tabs__head">
        <a href="#" class="tabs__head-item filtering__button cat-all active hoverMe" data-attr="<?=$arHandBook['ALL_CASES']['UF_VALUE']?>"><?=$arHandBook['ALL_CASES']['UF_VALUE']?></a>
        <?foreach ($arCasesType as $key => $type){?>
            <a href="#" class="tabs__head-item filtering__button hoverMe" data-cat="<?=$arCasesTypeAll[$key]?>" data-attr="<?=$type?>"><?=$type?></a>
        <?}?>
    </div>
    <div class="tabs__body">
        <div class="indexSection2__cards solutions__cards cases__cards filter-cat-results">
            <?foreach ($arCases as $cases){?>
                <a href="<?=$cases['DETAIL_PAGE_URL']?>" class="indexSection2__cards-item f-cat" data-cat="<?=$arCasesTypeAll[$cases['PROPERTY_TYPE_ENUM_ID']]?>">
                    <div class="indexSections2__cards_item-media">
                        <?if($cases['PREVIEW_PICTURE']){?>
                            <img src="<?=CFile::GetPath($cases['PREVIEW_PICTURE'])?>" alt="">
                        <?}?>
                    </div>
                    <div class="indexSections2__cards_item-content">
                        <div class="indexSections2__cards_item-top">
							<?if($cases['PROPERTY_LOGO_VALUE']){?>
                            	<div class="indexSections2__cards_item-logo">
                                    <img src="<?=CFile::GetPath($cases['PROPERTY_LOGO_VALUE'])?>" alt="">
								</div>
							<?}?>
                            <div class="indexSections2__cards_item-title"><?=$cases['NAME']?></div>
                        </div>
                        <div class="indexSections2__cards_item-more hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
</div>
