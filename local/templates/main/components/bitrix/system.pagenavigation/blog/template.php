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
<div class="diveinblog__pages" data-num="<?=$arResult['NavNum']?>">
    <?if($arResult['NavPageNomer'] != 1){?>
        <a href="/blog/?page=<?=$arResult['NavPageNomer']-1?>" data-link="/blog/?page=<?=$arResult['NavPageNomer']-1?>" class="diveinblog__pages-prev hoverMe pageAjax" data-attr="←" data-page="<?=$arResult['NavPageNomer']-1?>">←</a>
    <?}?>
    <?for ($i=1;$i<=$arResult['NavPageCount'];$i++){?>
        <?if($arResult['NavPageNomer'] == $i){?>
            <span class="diveinblog__pages-current"><?=$i?></span>
        <?}else{?>
            <?if($arResult['NavPageCount'] <= 6){?>
                <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
            <?}else{?>
                <?if($arResult['NavPageNomer'] <= 3){?>
                    <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?if($i == 3){?>
                        <span class="diveinblog__pages-more">...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}?>
                    <?if($i == 4 && $arResult['NavPageNomer'] == 3){?>
                        <span class="diveinblog__pages-more">...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}?>
                <?}?>
                <?if($arResult['NavPageNomer'] == $arResult['NavPageCount'] || $arResult['NavPageNomer'] == $arResult['NavPageCount'] - 1){?>
                    <?if($i == 1){?>
                        <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                        <span class="diveinblog__pages-more">...</span>
                        <?if($arResult['NavPageNomer'] == $arResult['NavPageCount'] - 1){?>
                            <?$i = $arResult['NavPageCount'] - 3;?>
                        <?}else{?>
                            <?$i = $arResult['NavPageCount'] - 2;?>
                        <?}?>
                    <?}else{?>
                        <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?}?>
                <?}?>
                <?if($arResult['NavPageNomer'] >= 4 && $arResult['NavPageNomer'] < $arResult['NavPageCount'] - 1){?>
                    <?if($i == 1){?>
                        <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                        <span class="diveinblog__pages-more">...</span>
                        <?$i = $arResult['NavPageNomer'] - 2;?>
                    <?}elseif($i == ($arResult['NavPageNomer'] + 2) && $i != $arResult['NavPageCount']){?>
                        <span class="diveinblog__pages-more">...</span>
                        <?$i = $arResult['NavPageCount'] - 1;?>
                    <?}else{?>
                        <a href="/blog/?page=<?=$i?>" data-link="/blog/?page=<?=$i?>" class="diveinblog__pages-link hoverMe pageAjax" data-page="<?=$i?>" data-attr="<?=$i?>"><?=$i?></a>
                    <?}?>
                <?}?>
            <?}?>
        <?}?>
    <?}?>
    <?if($arResult['NavPageNomer'] != $arResult['NavPageCount']){?>
        <a href="/blog/?page=<?=$arResult['NavPageNomer']+1?>" data-link="/blog/?page=<?=$arResult['NavPageNomer']+1?>" class="diveinblog__pages-next hoverMe pageAjax" data-attr="→" data-page="<?=$arResult['NavPageNomer']+1?>">→</a>
    <?}?>
</div>