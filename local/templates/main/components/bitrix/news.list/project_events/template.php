<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?if($arResult['ITEMS']){?>
    <div class="aboutCases__wrap">
        <?foreach ($arResult['ITEMS'] as $item){?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="aboutCases__item">
                <div class="aboutCases__item-media">
                    <?if($item['PREVIEW_PICTURE']['SRC']){?>
                        <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>">
                    <?}?>
                </div>
                <div class="aboutCases__item-content">
                    <div class="aboutCases__item-top">
                        <div class="aboutCases__item-logo">
                            <?if($item['PROPERTIES']['logo']['VALUE']){?>
                                <img src="<?=CFile::GetPath($item['PROPERTIES']['logo']['VALUE'])?>" alt="">
                            <?}?>
                        </div>
                        <div class="aboutCases__item-title"><?=$item['NAME']?></div>
                    </div>
                    <div class="aboutCases__item-bottom"><?=$arHandBook['LEARN_MORE']['UF_VALUE']?></div>
                </div>
            </a>
        <?}?>
    </div>
<?}?>