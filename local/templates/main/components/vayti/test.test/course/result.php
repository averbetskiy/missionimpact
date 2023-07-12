<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Loader;

global $arHandBook;
global $USER;

$lang = $_COOKIE['mi_lang'];
if(!$lang){
    $lang = 's1';
}
$mistakeGlasses = [];
$mistakeQuestionIds = [];
$mistakeAnswers = [];

$glassEntity = new AelitaTestGlasses;
$rsGlass = $glassEntity->GetList([], ['QUESTIONING_ID' => $arResult['QUESTIONING']['ID']]);
while($glass = $rsGlass->Fetch())
{
    if ($glass['SCORES'] < 1){
        $glass['ANSWER'] = current(unserialize(base64_decode($glass['SERIALIZED_RESULT'])));

        $mistakeGlasses[$glass['ID']] = $glass;
        $mistakeAnswers[$glass['QUESTION_ID']] = $glass['ANSWER'];
        $mistakeQuestionIds[] = $glass['QUESTION_ID'];
    }
}

$questions = [];
if ($mistakeQuestionIds){
    $questionEntity = new AelitaTestQuestion;
    $rsQuestion = $questionEntity->GetList([], ['TEST_ID' => $arResult['TEST']['ID'], 'ID' => $mistakeQuestionIds]);
    while($question = $rsQuestion->Fetch())
    {
        $questions[$question['ID']] = $question;
    }
    $answerEntity = new AelitaTestAnswer;
    $rsAnswer = $answerEntity->GetList([], ['QUESTION_ID' => $mistakeQuestionIds]);
    while($answer = $rsAnswer->Fetch())
    {
        if ($answer['NAME'] == $mistakeAnswers[$answer['QUESTION_ID']]){
            $answer['IS_ERROR'] = true;
        } else {
            $answer['IS_ERROR'] = false;
        }
        $questions[$answer['QUESTION_ID']]['ANSWERS'][] = $answer;
    }
}

$successQuestionCount = $arResult['RESULT']['MAX_SCORES'] - count($questions);

$userCourse = CourseUser::getOne($USER->GetID(), $arParams['COURSE']['ID']);
if (!$userCourse['UF_COMPLETED']){
    $courseUserEntity = CourseUser::getEntity();
    $courseUserEntity::update($userCourse['ID'], ['UF_COMPLETED' => true, 'UF_DATE_COMPLETE' => new \Bitrix\Main\Type\DateTime()]);
    if ($arParams['COURSE']['DUPLICATE_ELEMENT_VALUE']){
        $userCourseDuplicate = CourseUser::getOne($USER->GetID(), $arParams['COURSE']['DUPLICATE_ELEMENT_VALUE']);
        $courseUserEntity::update($userCourseDuplicate['ID'], ['UF_COMPLETED' => true, 'UF_DATE_COMPLETE' => new \Bitrix\Main\Type\DateTime()]);
    }
    if (Loader::includeModule("highloadblock")) {
        $resultTextNotification = [];
        $hlblock = HL\HighloadBlockTable::getById(HL_HANDBOOK)->fetch();

        $entity = HL\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $rsData = $entity_data_class::getList(array(
            "select" => ['*'],
            "filter" => [
                'UF_CODE' => ['PROFILE_NOTIFICATION_CERT_NAME','PROFILE_NOTIFICATION_CERT_DESC']
            ]
        ));
        while($arText = $rsData->fetch()){
            $resultTextNotification[$arText['UF_CODE']] = $arText;
        }
        $arDublicate = \Bitrix\Iblock\ElementTable::getRow([
            'select' => ['NAME'],
            'filter' => ['ID' => $arParams['COURSE']['DUPLICATE_ELEMENT_VALUE']]
        ]);
        if($lang == 's2'){
            $nameRu = $arParams['COURSE']['NAME'];
            $name = $arDublicate['NAME'];
        }else{
            $name = $arParams['COURSE']['NAME'];
            $nameRu = $arDublicate['NAME'];
        }
        $notificationsParams = [
            'UF_DATE' => new \Bitrix\Main\Type\DateTime(),
            'UF_LINK' => '/personal/profile/#certs_user',
            'UF_USERS' => [(int)$USER->GetID()],
            'UF_NAME' => $resultTextNotification['PROFILE_NOTIFICATION_CERT_NAME']['UF_TEXT_EN'],
            'UF_NAME_RU' => $resultTextNotification['PROFILE_NOTIFICATION_CERT_NAME']['UF_TEXT_RU'],
            'UF_PREVIEW' => str_replace(['#NAME#','#PERCENT#'],[$name,100],$resultTextNotification['PROFILE_NOTIFICATION_CERT_DESC']['UF_TEXT_EN']),
            'UF_PREVIEW_RU' => str_replace(['#NAME#','#PERCENT#'],[$nameRu,100],$resultTextNotification['PROFILE_NOTIFICATION_CERT_DESC']['UF_TEXT_RU']),
            'UF_TYPE' => 'Courses',
            'UF_TYPE_RU' => 'Курсы'
        ];
        NotificationsUser::add($notificationsParams);
    }
}
?>
<div class="pageCourse__inner-content">
    <div class="pageCourse__test">
        <div class="pageCourse__test-title">
            <?=$arResult["TEST"]["NAME"]?>
        </div>
        <?foreach ($questions as $question){?>
            <div class="pageCourse__test-result">
                <div class="pageCourse__test-result__uptitle"><?=$arHandBook['TEST_DETAIL_WHERE_WRONG']['UF_VALUE']?></div>
                <div class="pageCourse__test-result__title"><?=$question['NAME']?></div>
                <div class="pageCourse__test-result__list">
                    <?foreach ($question['ANSWERS'] as $answer){?>
                        <div class="pageCourse__test-result__item"
                        <?=($answer['CORRECT'] == 'Y') ? 'data-type="yes"' : ''?>
                            <?=($answer['IS_ERROR']) ? 'data-type="no"' : ''?>
                        ><?=$answer['NAME']?></div>
                    <?}?>
                </div>
            </div>
        <?}?>
        <div class="pageCourse__test-passed">

            <div class="pageCourse__test-passed__image">
                <div class="cert__thumb" data-type="<?=$arParams['COURSE']['CERT_TEMPLATE_VALUE'] ?: 'orange'?>">
                    <div class="cert__thumb-inner">Ce</div>
                </div>
            </div>
            <div class="pageCourse__test-passed__content">
                <div class="pageCourse__test-passed__title"><?=$arHandBook['TEST_DETAIL_PASSED']['UF_VALUE']?></div>
                <div class="pageCourse__test-passed__text">
                    <?=str_replace(['{MIN_SCORE}','{MAX_SCORE}'], [$successQuestionCount, $arResult['RESULT']['MAX_SCORES']], $arHandBook['TEST_DETAIL_PASSED_PREVIEW']['UF_VALUE'])?>
                </div>
            </div>
        </div>
    </div>
</div>
