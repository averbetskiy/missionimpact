<? /** @var $block array */?>
<?
//var_dump($block['cases']);
//["cases"]=>array(2) {["iblock_id"]=>int(11)["element_ids"]=>array(3) {[0]=>int(10269)[1]=>int(40)[2]=>int(39)}

//get cases
$casesIDs = array();
$casesIBlock = $block['cases']['iblock_id'];
foreach($block['cases']['element_ids'] as $case) {
	$casesIDs[] = $case;
}

global $arHandBook;
$arSolutions = [];
$arSolutionsType = [];
$arSolutionsTypeAll = [];
$arSelect = ["ID", "NAME", "DATE_ACTIVE_FROM",'DETAIL_PICTURE','PREVIEW_PICTURE','PREVIEW_TEXT','DETAIL_TEXT','DETAIL_PAGE_URL','PROPERTY_logo','PROPERTY_type', 'PROPERTY_logotype', 'PROPERTY_LOGO_VALUE', 'PROPERTY_LOGOTYPE_VALUE'];
$arFilter = ["IBLOCK_ID" => PROJECT , "ACTIVE"=>"Y"];
$res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, [], $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arSolutionsType[$arFields['PROPERTY_TYPE_ENUM_ID']] = $arFields['PROPERTY_TYPE_VALUE'];
    $arSolutions[] = $arFields;
}
$propertyEnums = CIBlockPropertyEnum::GetList(['SORT' => 'ASC'], Array("IBLOCK_ID"=>PROJECT, "CODE"=>"TYPE"));
while($enumFields = $propertyEnums->GetNext())
{
    $arSolutionsTypeAll[$enumFields['ID']] = $enumFields['XML_ID'];
}
?>

<div class="solutions__tabs filtering">
    <div class="tabs__head">
        <a href="#" class="tabs__head-item filtering__button cat-all active hoverMe" data-attr="<?=$arHandBook['ALL_SOLUTIONS']['UF_VALUE']?>"><?=$arHandBook['ALL_SOLUTIONS']['UF_VALUE']?></a>
        <?foreach ($arSolutionsType as $key => $type){?>
            <a href="#" class="tabs__head-item filtering__button hoverMe" data-attr="<?=$type?>" data-cat="<?=$arSolutionsTypeAll[$key]?>"><?=$type?></a>
        <?}?>
    </div>
    <div class="tabs__body">
        <div class="indexSection2__cards solutions__cards filter-cat-results">
            <a href="<?=($block['link']['value'])?$block['link']['value']:'javascript:void(0)'?>" class="solutions__cards-book">
                <div class="solutions__book-content">
                    <div class="solutions__book-title"><?=$block['title']['value']?></div>
                    <div class="solutions__book-more"><span><?=$block['text_button']['value']?></span></div>
                </div>
                <div class="solutions__book-stock">

					<?php
						foreach($casesIDs as $case){
								$arSelectCase = ["ID", "NAME",'PREVIEW_PICTURE'];
								$arFilterCase = Array("IBLOCK_ID"=>$casesIBlock, "ID"=>$case);
								$resCase = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilterCase, false, [], $arSelectCase); // с помощью метода CIBlockElement::GetList вытаскиваем все значения из нужного элемента
								if ($obCase = $resCase->GetNextElement()){
									$case = $obCase->GetFields();
									if($case['PREVIEW_PICTURE']){
										?>
										<div class="solutions__book_stock-item">
											<div class="solutions__book_stock-media">
												<img src="<?=CFile::GetPath($case['PREVIEW_PICTURE'])?>" alt="">
											</div>
											<div class="solutions__book_stock-content"><?=$case['NAME']?></div>
										</div>
									<?}
								}
						}
					?>
                </div>
            </a>
            <?foreach ($arSolutions as $solution){?>
                <a href="<?=$solution['DETAIL_PAGE_URL']?>" class="indexSection2__cards-item f-cat" data-cat="<?=$arSolutionsTypeAll[$solution['PROPERTY_TYPE_ENUM_ID']]?>">
                    <div class="indexSections2__cards_item-media">
                        <?if($solution['PREVIEW_PICTURE']){?>
                            <img src="<?=CFile::GetPath($solution['PREVIEW_PICTURE'])?>" alt="">
                        <?}?>
                    </div>
                    <div class="indexSections2__cards_item-content">
                        <div class="indexSections2__cards_item-top">
							<?if($solution['PROPERTY_LOGO_VALUE']){?>
                            	<div class="indexSections2__cards_item-logo">
									<img src="<?=CFile::GetPath($solution['PROPERTY_LOGO_VALUE'])?>" alt="">
								</div>
							<?}?>
                            <div class="indexSections2__cards_item-title"><?=$solution['NAME']?></div>
                        </div>
                        <div class="indexSections2__cards_item-more hoverMe" data-attr="<?=$arHandBook['LEARN_MORE']['UF_VALUE']?>"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                    </div>
                </a>
            <?}?>
        </div>
    </div>
</div>
