<? /** @var $block array */?>
<?
global $arHandBook;
$arCasesIds = [];
$arCases = [];
$arCompanyes = [];
$arCasesCompany = [];
$arSelectCompany = ["ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_CITY","PREVIEW_PICTURE","PROPERTY_CASES",'PREVIEW_TEXT',"PROPERTY_external_link"];
$arFilterCompany = ['ACTIVE' => 'Y','IBLOCK_ID' => PARTNERS,'PROPERTY_out_partner_VALUE' => 'Y'];
$resCompany = CIblockElement::GetList(["SORT" => "ASC"], $arFilterCompany, false, [], $arSelectCompany);
while ($casesCompany = $resCompany->GetNextElement()) {
    $arFieldsCompany = $casesCompany->GetFields();
    if($arFieldsCompany['PROPERTY_CASES_VALUE']) {
        $arCasesIds[] = (int) $arFieldsCompany['PROPERTY_CASES_VALUE'];
        $arCasesCompany[$arFieldsCompany['ID']][] = (int)$arFieldsCompany['PROPERTY_CASES_VALUE'];
    }
    $arCompanyes[$arFieldsCompany['ID']] = $arFieldsCompany;
}

$arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","PREVIEW_PICTURE","ACTIVE_FROM"];
$arFilter = ["IBLOCK_ID" => CASES, "ID" => $arCasesIds];
$res = CIblockElement::GetList(["ACTIVE_FROM" => "DESC"], $arFilter, false, [], $arSelect);
while ($cases = $res->GetNextElement()) {
    $arFields = $cases->GetFields();
    $arCases[$arFields['ID']] = $arFields;
}
?>
<div class="aboutPartners__wrap">
    <?foreach ($arCompanyes as $company){?>
        <?$arCasesCompanyId = $arCasesCompany[$company['ID']];?>
        <div class="aboutPartners__wrap-item" id="search<?=$company['ID']?>">
            <div class="aboutPartners__wrap-item__meta">
                <div class="aboutPartners__wrap-item__title">
                    <span><?=$company['NAME']?></span>
                    <span><?=$company['PROPERTY_CITY_VALUE']?></span>
                </div>
                <!-- если у партнера есть кейс, показываем следующий блок -->
                <?if($arCasesCompanyId){?>
                    <div class="aboutPartners__wrap-item__case"><?=$arHandBook['NAME_THERE_CASES']['UF_VALUE']?></div>
                <?}?>
            </div>
            <div class="aboutPartners__wrap-item__logo">
                <?if($company['PREVIEW_PICTURE']){?>
                    <?if($company['PROPERTY_EXTERNAL_LINK_VALUE']){?>
                        <a href="<?=$company['PROPERTY_EXTERNAL_LINK_VALUE']?>">
                    <?}?>
                    <img src="<?=CFile::GetPath($company['PREVIEW_PICTURE'])?>" alt="<?=$company['NAME']?>">
                    <?if($company['PROPERTY_EXTERNAL_LINK_VALUE']){?>
                        </a>
                    <?}?>
                <?}?>
            </div>
            <div class="aboutPartners__wrap-item__more hoverMe" data-attr="<?=($arCasesCompanyId)?$arHandBook['LEARN_MORE']['UF_VALUE']:''?>">
                <?if($arCasesCompanyId){?>
                    <span><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></span>
                <?}?>
            </div>

            <?if($arCasesCompanyId){?>
                <div class="aboutPartners__item-full">
                    <div class="aboutPartners__info">
                        <div class="aboutPartners__info-overlay"></div>
                        <div class="aboutPartners__info-wrap">
                            <div class="aboutPartners__info-inner">
                                <button class="aboutPartners__info-close">✕</button>
                                <div class="aboutPartners__info-photo">
                                    <?if($company['PREVIEW_PICTURE']){?>
                                        <img src="<?=CFile::GetPath($company['PREVIEW_PICTURE'])?>" alt="<?=$company['NAME']?>">
                                    <?}?>
                                    <span class="aboutPartners__wrap-item__case"><?=$arHandBook['NAME_THERE_CASES']['UF_VALUE']?></span>
                                </div>
                                <div class="aboutPartners__info-right">
                                    <div class="aboutPartners__info-title"><?=$company['NAME']?></div>
                                    <div class="aboutPartners__info-city"><?=$company['PROPERTY_CITY_VALUE']?></div>
                                    <div class="aboutPartners__info-text">
                                        <?=$company['PREVIEW_TEXT']?>
                                    </div>
                                    <div class="aboutPartners__info-cases">
                                        <div class="aboutPartners__info-cases__title"><?=$arHandBook['NAME_CASES']['UF_VALUE']?></div>
                                        <div class="aboutPartners__info-cases__list">
                                            <?foreach ($arCasesCompanyId as $cases){?>
                                                <?$case = $arCases[$cases];?>
                                                <a href="<?=$case['DETAIL_PAGE_URL']?>" class="aboutPartners__info-cases__item">
                                                    <div class="aboutPartners__info-cases__item-photo">
                                                        <?if($case['PREVIEW_PICTURE']){?>
                                                            <img src="<?=CFile::GetPath($case['PREVIEW_PICTURE'])?>" alt="<?=$case['NAME']?>">
                                                        <?}?>
                                                        <!-- <span>Overall score 8,91</span> -->
                                                    </div>
                                                    <div class="aboutPartners__info-cases__item-content">
                                                        <div class="aboutPartners__info-cases__item-date">
                                                            <?if($case['ACTIVE_FROM']){
                                                                if ($_COOKIE['mi_lang'] == 's2') {
                                                                    echo date('d F Y',$case['ACTIVE_FROM']);
                                                                } else {
                                                                    echo str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,date('d F Y',$case['ACTIVE_FROM']));
                                                                }
                                                            }?>
                                                        </div>
                                                        <div class="aboutPartners__info-cases__item-title"><?=$case['NAME']?></div>
                                                    </div>
                                                </a>
                                            <?}?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    <?}?>
</div>
