<? use Bitrix\Main\DB\SqlExpression;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
global $USER, $arHandBook;
$userId = $USER->GetID();
$moduleId = $arResult['ID'];
$duplicateLink = "";

if (!$USER->IsAuthorized()){
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}

$moduleSectionId = $arResult['IBLOCK_SECTION_ID'];

//Get course
if ($moduleSectionId) {
    $courseEntity = \Bitrix\Iblock\Iblock::wakeUp(COURSES)->getEntityDataClass();
    $rsCourse = $courseEntity::getList([
        'select' => [
            '*',
            'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
            'MODULES_SECTION_ID_VALUE' => 'MODULES_SECTION_ID.VALUE',
            'TEST_ID_VALUE' => 'TEST_ID.VALUE'
        ],
        'filter' => [
            'MODULES_SECTION_ID.VALUE' => $moduleSectionId,
            'ACTIVE' => 'Y'
        ],
        'order' => ['SORT' => 'ASC']
    ]);

    while ($course = $rsCourse->fetch()) {
        $course['DETAIL_PAGE_URL'] = \CIBlock::ReplaceDetailUrl($course['DETAIL_PAGE_URL'], $course, true, 'E');
		$duplicateLink = $course['DETAIL_PAGE_URL'];
        $arResult['COURSE'] = $course;
    }
}

if (!$arResult['COURSE'] || $arResult['COURSE']['CODE'] !== $arParams['COURSE_CODE']) {
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}

if (!CourseUser::getOne($userId, $arResult['COURSE']['ID'])){
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}

//Get modules
if ($moduleSectionId) {
    $moduleEntity = \Bitrix\Iblock\Iblock::wakeUp($arResult['IBLOCK_ID'])->getEntityDataClass();

    $rsModule = $moduleEntity::getList([
        'select' => [
            '*',
            'VIDEO_VALUE' => 'VIDEO.VALUE',
            'NUMBER_VALUE' => 'NUMBER.VALUE',
            'DURATION_VALUE' => 'DURATION.VALUE',
            ],
        'filter' => [
            'IBLOCK_SECTION_ID' => $moduleSectionId,
            'ACTIVE' => 'Y',
        ],
        'order' => ['SORT' => 'ASC']
    ]);

    while ($module = $rsModule->fetch()) {
        if ($module['PREVIEW_PICTURE']){
            $module['PREVIEW_PICTURE'] = CFile::GetPath($module['PREVIEW_PICTURE']);
        }
        $arResult['MODULES'][$module['ID']] = $module;
    }
}

//Add module to user
if (!ModuleUser::getOne($userId, $moduleId)){
    ModuleUser::add([
        'UF_USER_ID' => $userId,
        'UF_MODULE_ID' => $moduleId
    ]);
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

//Get test
if (\Bitrix\Main\Loader::includeModule('aelita.test')){
    $testId = $arResult['COURSE']['TEST_ID_VALUE'];
    if ($testId)
    {
        $testEntity = new AelitaTestTest;
        $rsTest = $testEntity->GetList([], ['ID' => $testId]);
        if($test = $rsTest->Fetch())
        {
            if ((count($userModuleIds) / count($arResult['MODULES'])) < 0.75){
                $test['AVAIL'] = 'N';
            } else {
                $test['AVAIL'] = 'Y';
            }
            $arResult['TEST'] = $test;
        }
    }
}

//Get percent
$arResult['COURSEPERCENT'] = round(count($userModuleIds) / count($arResult['MODULES'])) * 100;
if ($arResult['COURSEPERCENT'] > 100)
	$arResult['COURSEPERCENT'] = 100;
$arResult['STRINGFIOLET'] = str_replace(array("%COURSENAME%","%COURSEPERCENT%"), array(trim($arResult['COURSE']['NAME']),$arResult['COURSEPERCENT']), $arHandBook['COURSE_CARD_FIOLET']['UF_VALUE']);

//Duplicate
if ($arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE']) {
	$duplicateID = $arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE'];
	$arResult['DUPLICATE']['DETAIL_PAGE_URL'] = $duplicateLink . "module/".$duplicateID."/";
}

unset($arResult['MODULES'][$arResult['ID']]);