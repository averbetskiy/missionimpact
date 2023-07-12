<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
?>
<div class="vote">
    <div class="container">
        <p class="index__heading __multiply"><?=$arHandBook['VOTE']['UF_VALUE']?></p>
        <form action="<?=POST_FORM_ACTION_URI?>" method="post" class="vote-form vote__form">
            <input type="hidden" name="vote" value="Y">
            <input type="hidden" name="PUBLIC_VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
            <input type="hidden" name="VOTE_ID" value="<?=$arResult["VOTE"]["ID"]?>">
            <?=bitrix_sessid_post()?>
            <?foreach ($arResult["QUESTIONS"] as $arQuestion){?>
                <?
                $image = '';
                if($arQuestion['IMAGE_ID']){
                    $image = CFile::GetPath($arQuestion['IMAGE_ID']);
                }
                ?>
                <div class="heading__columns-title"><p><?=$arQuestion["QUESTION"]?></p></div>
                <!-- если есть картинка - ставим класс __hasImage, если показываем результаты - ставим класс __results -->
                <div class="vote__wrap <?if($image){?>__hasImage"<?}?>>
                    <div class="vote__list">
                        <?$i=0;?>
                        <?foreach ($arQuestion["ANSWERS"] as $arAnswer){?>
                            <?if ($arAnswer["FIELD_TYPE"] == 0){?>
                                <?
                                $value=(isset($_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]]) &&
                                    $_REQUEST['vote_radio_'.$arAnswer["QUESTION_ID"]] == $arAnswer["ID"]) ? 'checked="checked"' : '';
                                ?>
                                <div class="vote__item <?if($i==0){?>checked<?}?>">
                                        <div class="vote__item-checkbox">
                                            <div class="vote__item-percent">10%</div>
                                            <label class="vote__item-text" for="v1_1">

                                                <input type="radio" <?=$value?> name="vote_radio_<?=$arAnswer["QUESTION_ID"]?>"
                                                       id="vote_radio_<?=$arAnswer["QUESTION_ID"]?>_<?=$arAnswer["ID"]?>"
                                                       value="<?=$arAnswer["ID"]?>" <?=$arAnswer["~FIELD_PARAM"]?>
                                                >
                                                <p><?=$arAnswer["MESSAGE"]?></p>
                                            </label>
                                        </div>
                                        <div class="vote__item-line-wrap">
                                            <div class="vote__item-line" style="width:10%"></div>
                                        </div>
                                </div>
                            <?}?>
                            <?$i++;?>
                        <?}?>
                    </div>
                    <div class="vote__image">
                        <?if($image){?>
                            <img src="<?=$image?>" alt="">
                        <?}?>
                    </div>
                </div>
            <?}?>
            <button class="vote__do button hoverMe" data-attr="<?=$arHandBook['LETS_VOTE']['UF_VALUE']?>"><?=$arHandBook['LETS_VOTE']['UF_VALUE']?></button>
        </form>
    </div>
</div>
