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
?>
<?if($arResult['DUPLICATE']){?>
    <div class="duplicate" data-href="<?=$arResult['DUPLICATE']['DETAIL_PAGE_URL']?>">
    </div>
<?}?>
<div class="container">
    <div class="diveininner__wrap">
        <?if($arHandBook['BACK_TO_TEST_LINK']['UF_VALUE']){?>
            <a href="<?=$arHandBook['BACK_TO_TEST_LINK']['UF_VALUE']?>" class="divein__back hoverMe" data-attr="<?=$arHandBook['BACK_TO_TEST']['UF_VALUE']?>"><?=$arHandBook['BACK_TO_TEST']['UF_VALUE']?></a>
        <?}?>
        <div class="diveininner__content">
            <p class="index__heading __multiply"><?=$arResult['PROPERTIES']['title']['VALUE']?></p>
            <h1 class="diveintest__intro-title"><?=$arResult['NAME']?></h1>
            <p class="diveintest__intro-subtitle"><?=$arResult['PREVIEW_TEXT']?></p>
        </div>
    </div>
    <div class="diveintest__test">
        <?=$arResult['DETAIL_TEXT']?>
    </div>
</div>