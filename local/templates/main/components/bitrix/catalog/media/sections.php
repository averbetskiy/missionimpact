<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Entity;
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
global $arHandBook;
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");

$sectionListParams = array(
	"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"CACHE_TYPE" => $arParams["CACHE_TYPE"],
	"CACHE_TIME" => $arParams["CACHE_TIME"],
	"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
	"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
	"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
	"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
	"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
	"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
	"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
);
$sectionListParams = array_merge($sectionListParams,$arParams);
if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
{
	$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
	if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
	{
		$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
	}
}?>
<div class="pv__main">
    <h1 class="pv__title"><?=$arHandBook['PAGE_MEDIA_TITLE']['UF_VALUE'];?></h1>
	
	<?php
		$iIblockID = $arParams["IBLOCK_ID"];
		$arOrder = [
			'ID' => 'ASC'
		];
		$arFilter = [
			'IBLOCK_ID'        => $iIblockID,
			'PROPERTY_check_fixed_VALUE' => 'Y'
		];
		$resElements = \CIBlockElement::GetList($arOrder, $arFilter, false, false,['*','PROPERTY_check_fixed','PROPERTY_video','PROPERTY_video_link']);
        while( $arElement = $resElements->fetch() ){
            $fixedElement = $arElement;
            break;
        }
        $arSection = \Bitrix\Iblock\SectionTable::getRow(['filter' => ['ID' => $fixedElement['IBLOCK_SECTION_ID']]]);
	?>
	
	<?if(count($fixedElement) > 0){?>
		<div class="pv__main-wrap">
			<!-- делаем проверку если видео вставлено, показываем в следующем блоке data-cursor и отображаем div с классом pv__main-video, если нет - отображаем div с классом pv__main-poster -->
			<?if($arSection['CODE'] == 'video'){?>
                <div class="pv__main-media" data-cursor="swipe">
                    <div class="pv__main-poster">
                        <img src="<?=CFile::GetPath($fixedElement['PREVIEW_PICTURE']);?>" alt="">
                    </div>
                    <?if($fixedElement['PROPERTY_VIDEO_LINK_VALUE']){?>
                        <div class="pv__main-video">
                            <iframe width="100%" height="100%" src="<?=$fixedElement['PROPERTY_VIDEO_LINK_VALUE']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                        </div>
                    <?}elseif($fixedElement['PROPERTY_VIDEO_VALUE']){?>
                        <video width="100%" height="100%" controls>
                            <source src="<?=$fixedElement['PROPERTY_VIDEO_VALUE']?>" type="video/mp4">
                        </video>
                    <?}?>
                </div>
            <?}else{?>
                <div class="pv__main-media">
                    <div class="pv__main-poster">
                        <img src="<?=CFile::GetPath($fixedElement['PREVIEW_PICTURE']);?>" alt="">
                    </div>
                </div>
            <?}?>
			<div class="pv__main-content">
				<?php if ($fixedElement['DATE_ACTIVE_FROM'] != null): ?>
					<div class="pv__main-content__date"><?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH2,date('d M Y',strtotime($fixedElement['DATE_ACTIVE_FROM'])));?></div>
				<?php endif; ?>
				<div class="pv__main-content__title"><?=$fixedElement['NAME'];?></div>
			</div>
		</div>
	<?}?>
</div>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list",
	"",
	$sectionListParams,
	$component,
	($arParams["SHOW_TOP_ELEMENTS"] !== "N" ? array("HIDE_ICONS" => "Y") : array())
);
unset($sectionListParams);