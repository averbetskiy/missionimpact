<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;

$testResEntity = new AelitaTestResult;
$rsTestRes = $testResEntity->GetList([], ['TEST_ID' => $arResult['TEST']['ID'], 'ACTIVE' => 'Y']);
$testRes = $rsTestRes->Fetch();

$questioningEntity = new AelitaTestQuestioning;
$rsQuestioning = $questioningEntity->GetList([], ['ID' => $arResult['QUESTIONING']['ID']], false, false, ['SCORES']);
$questioning = $rsQuestioning->Fetch();


if ($arParams['MODULE_IDS']) {
    $moduleEntity = \Bitrix\Iblock\Iblock::wakeUp(MODULES)->getEntityDataClass();
    $rsModule = $moduleEntity::getList([
        'select' => [
            '*',
            'VIDEO_VALUE' => 'VIDEO.VALUE',
            'NUMBER_VALUE' => 'NUMBER.VALUE',
            'DURATION_VALUE' => 'DURATION.VALUE',
        ],
        'filter' => [
            'ID' => $arParams['MODULE_IDS'],
            'ACTIVE' => 'Y',
        ],
        'order' => ['SORT' => 'ASC']
    ]);

    while ($module = $rsModule->fetch()) {
        if ($module['PREVIEW_PICTURE']) {
            $module['PREVIEW_PICTURE'] = CFile::GetPath($module['PREVIEW_PICTURE']);
        }
        $arResult['MODULES'][$module['ID']] = $module;
    }
}

$userModuleIds = [];
if ($arResult['MODULES']){
    $moduleEntity = ModuleUser::getEntity();
    $rsModuleUser = $moduleEntity::getList([
        'filter' => [
            'UF_USER_ID' => $USER->GetID(),
            'UF_MODULE_ID' => array_keys($arResult['MODULES'])
        ],
        'count_total' => true,
    ]);
    while ($userModule = $rsModuleUser->fetch()){
        $userModuleIds[] = $userModule['UF_MODULE_ID'];
    }

    foreach ($arResult['MODULES'] as $keyModule => $module) {
        if (in_array($module['ID'], $userModuleIds)) {
            $arResult['MODULES'][$keyModule]['COMPLETED'] = 'Y';
        } else {
            $arResult['MODULES'][$keyModule]['COMPLETED'] = 'N';
        }
    }
}

?>
<div class="pageCourse__inner-content">
    <div class="pageCourse__test">
        <div class="pageCourse__test-title">
            <?=$arResult["TEST"]["NAME"]?>
        </div>
        <?if ($testRes){?>
            <div class="pageCourse__test-text">
                <p><?=str_replace(['{MIN_SCORE}','{MAX_SCORE}'], [$testRes['MIN_SCORES'], $testRes['MAX_SCORES']], $arHandBook['TEST_DETAIL_PREVIEW']['UF_VALUE'])?></p>
            </div>
        <?}?>
        <div class="pageCourse__test-error">
            <div class="pageCourse__test-error__text">
                <p><?=$arHandBook['TEST_DETAIL_NOT_PASSED']['UF_VALUE']?></p>
                <p><?=str_replace(['{MIN_SCORE}','{MAX_SCORE}'], [($testRes['MAX_SCORES'] - $questioning['SCORES']), $testRes['MAX_SCORES']], $arHandBook['TEST_DETAIL_NOT_PASSED_MISTAKES']['UF_VALUE'])?></p>
            </div>
            <form action="<?=$APPLICATION->GetCurPageParam("testaction=Y", ["testaction", "s"]);?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="reinitquestioning" value="Y">
                <button class="pageCourse__test-error__repeat hoverMe" name="testsubmit" data-attr="<?=$arHandBook['TEST_DETAIL_REPEAT']['UF_VALUE']?>" type="submit">
                    <?=$arHandBook['TEST_DETAIL_REPEAT']['UF_VALUE']?>
                </button>
            </form>
        </div>
        <div class="pageCourse__test-revice">
            <div class="pageCourse__test-revice__title"><?=$arHandBook['TEST_DETAIL_REPEAT_MODULES']['UF_VALUE']?></div>
            <div class="pageCourse__test-revice__wrap">
                <div class="pageCourse__test-revice__list">
                    <?foreach ($arResult['MODULES'] as $module){?>
                        <a href="<?= \CIBlock::ReplaceDetailUrl($arParams['COURSE']['DETAIL_PAGE_URL'], $arParams['COURSE'], true, 'E') ?>module/<?=$module['ID']?>/" class="pageCourse__module"
                           data-type="video">
                            <div class="pageCourse__module-media">
                                <div class="pageCourse__module-photo">
                                    <?if ($module['PREVIEW_PICTURE']){?>
                                        <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                                    <?}?>
                                </div>
                                <div class="pageCourse__module-content">
                                    <div class="pageCourse__module-name"><?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$module['NUMBER_VALUE']?></div>
                                    <div class="pageCourse__module-title"><?=$module['NAME']?></div>
                                </div>
                            </div>
                            <div class="pageCourse__module-info">
                                <div class="pageCourse__module-type">
                                    <?=$module['VIDEO_VALUE'] ?
                                        $arHandBook['MODULE_TYPE_VIDEO']['UF_VALUE']
                                        : $arHandBook['MODULE_TYPE_TEXT']['UF_VALUE']
                                    ?>
                                </div>
                                <div class="pageCourse__module-time"><?=$module['DURATION_VALUE']?></div>
                            </div>
                            <div class="pageCourse__module-status__wrap">
                                <div class="pageCourse__module-status" style="width:<?=($module['COMPLETED'] == 'Y') ? '100%' : '0%'?>"></div>
                            </div>
                        </a>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>