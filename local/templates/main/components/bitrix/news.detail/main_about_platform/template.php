<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<div class="indexSection1">
    <div class="container">
        <div class="indexSection1__wrap">
            <div class="indexSection1__left">
                <div class="indexSection1__content">
                    <h3 class="index__heading"><?=$arResult['NAME']?></h3>
                    <h4 class="indexSection1__title">
                        <?=$arResult['PREVIEW_TEXT']?>
                    </h4>
                    <?if($arResult['PROPERTIES']['link']['VALUE']){?>
                        <a href="<?=$arResult['PROPERTIES']['link']['VALUE']?>" class="button"><?=$arHandBook['LEARN_MORE_2']['UF_VALUE']?></a>
                    <?}?>
                </div>
                <div class="indexSection1__team">
                    <div class="indexSection1__team-title"><?=$arResult['PROPERTIES']['main_title']['VALUE']?></div>
                    <div class="indexSection1__team-list">
                        <?foreach ($arResult['PROPERTIES']['second_title']['VALUE'] as $title){?>
                            <?
                            $arTitle = explode(';',htmlspecialchars_decode($title));
                            ?>
                            <div class="indexSection1__team-item">
                                <?if($arTitle[0]){?>
                                    <div class="indexSection1__team_item-title"><?=$arTitle[0]?></div>
                                <?}?>
                                <?if($arTitle[1]){?>
                                    <div class="indexSection1__team_item-type"><?=$arTitle[1]?></div>
                                <?}?>
                            </div>
                        <?}?>
                    </div>
                </div>
            </div>
            <?if($arResult['DETAIL_PICTURE']['SRC']){?>
                <div class="indexSection1__right">
                    <div class="indexSection1__right-media">
                        <img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=$arResult['NAME']?>">
                    </div>
                    <div class="indexSection1__right-content">
                        <?=$arResult['DETAIL_TEXT']?>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>
