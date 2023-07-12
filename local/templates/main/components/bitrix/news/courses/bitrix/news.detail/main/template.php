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
global $arHandBook;
global $arProp;
$arProp = [
    'PICTURE' => $arResult['DETAIL_PICTURE'],
    'PROP' => $arResult['PROPERTIES']
];
?>
<?if($arResult['DUPLICATE']){?>
    <div class="duplicate" data-href="<?=$arResult['DUPLICATE']['DETAIL_PAGE_URL']?>">
    </div>
<?}?>
<div class="container">
    <div class="pageCourse__inner">
		<div class="pageCourse__inner-back"><a href="/personal/courses/#<?=$arResult['CODE'];?>" class="hoverMe" data-attr="<?=$arHandBook['BACK_TO_COURSES']['UF_VALUE']?>"><?=$arHandBook['BACK_TO_COURSES']['UF_VALUE']?></a></div>
        <div class="pageCourse__inner-content">
            <?if($arResult['PROPERTIES']['level']['VALUE']){?>
                <div class="pageCourse__content-level"><span><?=$arHandBook['LEVEL']['UF_VALUE']?> <?=$arResult['PROPERTIES']['level']['VALUE']?></span></div>
            <?}?>
            <div class="pageCourse__content-title"><?=$arResult['NAME']?></div>
            <div class="pageCourse__content-meta">
                <?if($arResult['PROPERTIES']['lang']['VALUE']){?>
                    <div class="pageCourse__meta-lang pageCourse__meta-item"><?=$arHandBook['LANGUAGE']['UF_VALUE']?>: <?=$arResult['PROPERTIES']['lang']['VALUE']?></div>
                <?}?>
                <?if($arResult['PROPERTIES']['time']['VALUE']){?>
                    <div class="pageCourse__meta-duration pageCourse__meta-item"><?=$arHandBook['DURATION']['UF_VALUE']?>: <?=$arResult['PROPERTIES']['time']['VALUE']?></div>
                <?}?>
                <?if($arResult['PROPERTIES']['certificate']['VALUE']){?>
                    <div class="pageCourse__meta-cert pageCourse__meta-item"><?=$arHandBook['CERTIFICATE']['UF_VALUE']?>: <?=$arResult['PROPERTIES']['certificate']['VALUE']?></div>
                <?}?>
            </div>
            <?if($arResult['DETAIL_PICTURE']['SRC']){?>
                <div class="pageCourse__content-photo">
                    <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="">
                </div>
            <?}?>
            <?$author = current($arResult['DISPLAY_PROPERTIES']['author']['LINK_ELEMENT_VALUE']);?>
            <?if($author['NAME']){?>
                <div class="pageCourse__content-by">
                    <?=$arHandBook['BY']['UF_VALUE']?>
                    <?=$author['NAME']?>
                </div>
            <?}?>
            <div class="pageCourse__content-text">
                <p><?=$arResult['DETAIL_TEXT']?></p>
            </div>
        </div>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
    "sprint.editor:blocks",
    "main",
    Array(
        "ELEMENT_ID" => $arResult["ID"],
        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
        "PROPERTY_CODE" => 'content',
        "JSON" => htmlspecialchars_decode($arResult['PROPERTIES']['content']['VALUE'])
    ),
    $component,
    Array(
        "HIDE_ICONS" => "Y"
    )
);?>
<?if ($arResult['MODULE']){?>
    <div class="pageCourse__button-wrap">
        <a class="button hoverMe"
           data-action="get_course"
           data-course="<?=$arResult['ID']?>"
           data-url="<?=$arResult['DETAIL_PAGE_URL']?>module/<?=$arResult['MODULE']['ID']?>/"
           data-attr="<?=$arHandBook['COURSE_DETAIL_START']['UF_VALUE']?>"
        ><?=$arHandBook['COURSE_DETAIL_START']['UF_VALUE']?></a>
    </div>
<?}?>
<?$APPLICATION->ShowViewContent('other_courses');?>