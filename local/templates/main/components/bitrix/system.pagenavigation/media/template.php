<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';
?>
<div class="search__results-tabs__body-item__pagenav pageBlock" data-num="<?=$arResult['NavNum']?>">
    <?if($arResult['NavPageNomer'] != 1){?>
        <a href="<?=$arResult['sUrlPath']?>?page=<?=$arResult['NavPageNomer']-1?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$arResult['NavPageNomer']-1?>" class="arrow prev pageAjaxMedia" data-attr="←" data-page="<?=$arResult['NavPageNomer']-1?>">
            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.50994 0.737216L8.78835 2.00142L4.34943 6.44034L15.5 6.44034V8.28693L4.34943 8.28693L8.78835 12.7187L7.50994 13.9901L0.883523 7.36364L7.50994 0.737216Z" fill="#1A1A1A"></path>
            </svg>
        </a>
    <?}?>
    <?for ($i=1;$i<=$arResult['NavPageCount'];$i++){?>
        <?if($arResult['NavPageNomer'] == $i){?>
            <span class="current"><?=$i?></span>
        <?}else{?>
            <?if($arResult['NavPageCount'] <= 6){?>
                <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
            <?}else{?>
                <?if($arResult['NavPageNomer'] <= 3){?>
                    <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?if($i == 3){?>
                        <span>...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}?>
                    <?if($i == 4 && $arResult['NavPageNomer'] == 3){?>
                        <span>...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}?>
                <?}?>
                <?if($arResult['NavPageNomer'] == $arResult['NavPageCount'] || $arResult['NavPageNomer'] == $arResult['NavPageCount'] - 1){?>
                    <?if($i == 1){?>
                        <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                        <span>...</span>
                        <?if($arResult['NavPageNomer'] == $arResult['NavPageCount'] - 1){?>
                            <?$i = $arResult['NavPageCount'] - 3;?>
                        <?}else{?>
                            <?$i = $arResult['NavPageCount'] - 2;?>
                        <?}?>
                    <?}else{?>
                        <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?}?>
                <?}?>
                <?if($arResult['NavPageNomer'] >= 4 && $arResult['NavPageNomer'] < $arResult['NavPageCount'] - 1){?>
                    <?if($i == 1){?>
                        <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                        <span>...</span>
                        <?$i = $arResult['NavPageNomer'] - 2;?>
                    <?}elseif($i == ($arResult['NavPageNomer'] + 2) && $i != $arResult['NavPageCount']){?>
                        <span>...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}else{?>
                        <a href="<?=$arResult['sUrlPath']?>?page=<?=$i?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$i?>" class="link pageAjaxMedia" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?}?>
                <?}?>
            <?}?>
        <?}?>
    <?}?>
    <?if($arResult['NavPageNomer'] != $arResult['NavPageCount']){?>
        <a href="<?=$arResult['sUrlPath']?>?page=<?=$arResult['NavPageNomer']+1?>" data-link="<?=$arResult['sUrlPath']?>?page=<?=$arResult['NavPageNomer']+1?>" class="arrow next pageAjaxMedia" data-attr="→" data-page="<?=$arResult['NavPageNomer']+1?>">
            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.49006 13.2628L7.21165 11.9986L11.6506 7.55966H0.5V5.71307H11.6506L7.21165 1.28125L8.49006 0.00994253L15.1165 6.63636L8.49006 13.2628Z" fill="#1A1A1A"></path>
            </svg>
        </a>
    <?}?>
</div>