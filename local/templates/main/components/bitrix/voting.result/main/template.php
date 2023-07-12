<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
?>
<div class="vote">
    <div class="container">
        <p class="index__heading __multiply"><?=$arHandBook['VOTE']['UF_VALUE']?></p>
            <?foreach ($arResult["QUESTIONS"] as $arQuestion){?>
                <?
                $image = '';
                if($arQuestion['IMAGE_ID']){
                    $image = CFile::GetPath($arQuestion['IMAGE_ID']);
                }
                ?>
                <div class="heading__columns-title"><p><?=$arQuestion["QUESTION"]?></p></div>
                <!-- если есть картинка - ставим класс __hasImage, если показываем результаты - ставим класс __results -->
                <div class="vote__wrap __results">
                    <div class="vote__list">
                        <?foreach ($arQuestion["ANSWERS"] as $arAnswer){?>
                            <?if ($arAnswer["FIELD_TYPE"] == 0){?>
                                <?
                                $value=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) &&
                                    $_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]) ? 'checked="checked"' : '';
                                ?>
                                <div class="vote__item vote__item__result">
                                    <div class="vote__item-checkbox">
                                        <div class="vote__item-percent"><?=$arAnswer['BAR_PERCENT']?>%</div>
                                        <label class="vote__item-text" for="v1_1">
                                            <p><?=$arAnswer["MESSAGE"]?></p>
                                        </label>
                                    </div>
                                    <div class="vote__item-line-wrap">
                                        <div class="vote__item-line" style="width:<?=$arAnswer['BAR_PERCENT']?>%"></div>
                                    </div>
                                </div>
                            <?}?>
                        <?}?>
                    </div>
                    <div class="vote__image">
                        <?if($image){?>
                            <img src="<?=$image?>" alt="">
                        <?}?>
                    </div>
                </div>
            <?}?>
    </div>
</div>
