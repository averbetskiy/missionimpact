<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;

$testResEntity = new AelitaTestResult;
$rsTestRes = $testResEntity->GetList([], ['TEST_ID' => $arResult['TEST']['ID'], 'ACTIVE' => 'Y']);
$testRes = $rsTestRes->Fetch();
?>

<div class="pageCourse__inner-content">
    <div class="pageCourse__test">
        <div class="pageCourse__test-title">
            <?=$arResult['TEST']['NAME']?>
        </div>
        <div class="pageCourse__test-text">
            <p>
                <?=str_replace(['{MIN_SCORE}','{MAX_SCORE}'], [$testRes['MIN_SCORES'], $testRes['MAX_SCORES']], $arHandBook['TEST_DETAIL_PREVIEW']['UF_VALUE'])?>
            </p>
            <?if (count($arResult["ERROR"])):?>
            <br/>
                <p>
                    <?=ShowError(implode("<br />", $arResult["ERROR"]))?>
                </p>
            <?endif?>
        </div>

        <div class="pageCourse__test-inner">



            <form action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data" class="pageCourse__test-list">
                <input type="hidden" name="testaction" value="Y">
                <?foreach($arResult["QUESTION"] as $key=>$Question){?>

                <fieldset class="pageCourse__test-item">
                    <legend><?=$Question["NAME"]?></legend>
                    <?foreach($arResult["ANSWER"][$Question["ID"]] as $Answer){?>
                        <div>
                            <input id="<?=$Question["ID"]?>_<?=$Answer["ID"]?>" type="radio" <?if($Answer["CHECKED"]=="Y"){?>checked="checked"<?}?> name="answer[<?=$Question["ID"]?>]" value="<?=$Answer["ID"]?>">
                            <label for="<?=$Question["ID"]?>_<?=$Answer["ID"]?>"><?=$Answer["NAME"]?></label>
                        </div>
                    <?}?>
                    <input type="hidden" name="stepquestioning" value="Y">
                    <input type="hidden" name="questionid[]" value="<?=$Question["ID"]?>">
                </fieldset>
                <?}?>
                <button name="testsubmit" class="pageCourse__test-button hoverMe" data-attr="<?=$arHandBook['TEST_DETAIL_CHECK_RESULT']['UF_VALUE']?>" type="submit" value="Y">
                    <?=$arHandBook['TEST_DETAIL_CHECK_RESULT']['UF_VALUE']?>
                </button>
            </form>
        </div>
    </div>
</div>

