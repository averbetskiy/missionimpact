<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

global $USER;

//Get modules
$moduleSectionIds = [];
foreach ($arResult['ITEMS'] as $key => $item){
    if ($moduleSectionId = $item['PROPERTIES']['MODULES_SECTION_ID']['VALUE']){
        $moduleSectionIds[] = $moduleSectionId;
    }
}

$modules = [];
$moduleIds = [];
if ($moduleSectionIds) {
    $moduleEntity = \Bitrix\Iblock\Iblock::wakeUp(MODULES)->getEntityDataClass();

    $rsModule = $moduleEntity::getList([
        'select' => [
            '*',
            'VIDEO_VALUE' => 'VIDEO.VALUE',
            'NUMBER_VALUE' => 'NUMBER.VALUE',
            'DURATION_VALUE' => 'DURATION.VALUE',
        ],
        'filter' => [
            'IBLOCK_SECTION_ID' => $moduleSectionIds,
            'ACTIVE' => 'Y',
        ],
        'order' => ['SORT' => 'ASC']
    ]);

    while ($module = $rsModule->fetch()) {
        if ($module['PREVIEW_PICTURE']){
            $module['PREVIEW_PICTURE'] = CFile::GetPath($module['PREVIEW_PICTURE']);
        }
        $modules[$module['IBLOCK_SECTION_ID']][$module['ID']] = $module;
        $moduleIds[] = $module['ID'];
    }
}

if ($modules){
    foreach ($arResult['ITEMS'] as $key => $item){
        $arResult['ITEMS'][$key]['MODULES'] = $modules[$item['PROPERTIES']['MODULES_SECTION_ID']['VALUE']];
    }
}

$userModules = [];
if ($moduleIds){
    $moduleEntity = ModuleUser::getEntity();
    $rsModuleUser = $moduleEntity::getList([
        'filter' => [
            'UF_USER_ID' => $USER->GetID(),
            'UF_MODULE_ID' => $moduleIds
        ],
        'count_total' => true,
    ]);
    while ($userModule = $rsModuleUser->fetch()){
        $userModules[$userModule['UF_MODULE_ID']] = $userModule;
    }
}

//Get test
if (\Bitrix\Main\Loader::includeModule('aelita.test')){

    $tests = [];
    $testIds = [];

    foreach ($arResult['ITEMS'] as $item){
        if ($testId = $item['PROPERTIES']['TEST_ID']['VALUE']){
            $testIds[] = $testId;
        }
    }

    $testIds = array_unique($testIds);

    if ($testIds)
    {
        $testEntity = new AelitaTestTest;
        $rsTest = $testEntity->GetList([], ['ID' => $testIds, 'ACTIVE' => 'Y']);
        while($test = $rsTest->Fetch())
        {
            $tests[$test['ID']] = $test;
        }
    }

    $profileEntity = new AelitaTestProfile;
    $rsProfile = $profileEntity->GetList([], ['USER_ID' => $USER->GetID()], false, false, ['*']);
    $profile = $rsProfile->Fetch();

    if ($profile){
        $questioningEntity = new AelitaTestQuestioning;
        $rsQuestioning = $questioningEntity->GetList(
            [],
            ['TEST_ID' => array_keys($tests), 'PROFILE_ID' => $profile, 'FINAL' => 'Y'],
            ['TEST_ID'],
            false,
            ['*']
        );
        while ($questioning = $rsQuestioning->Fetch()){
            $tests[$questioning['TEST_ID']]['COMPLETED'] = 'Y';
        }
    }



    foreach ($arResult['ITEMS'] as $key => $item){
        if ($test = $tests[$item['PROPERTIES']['TEST_ID']['VALUE']]){
            $arResult['ITEMS'][$key]['TEST'] = $test;
        }
    }
}

foreach ($arResult['ITEMS'] as $key => $item) {
    $moduleCount = 0;
    $userModuleCount = 0;
    $totalModuleProgress = 0;
    foreach ($item['MODULES'] as $keyModule => $module) {
        $moduleCount++;
        if (isset($userModules[$module['ID']]) && $userModules[$module['ID']]['UF_COMPLETED']){
            $userModuleCount++;
            $arResult['ITEMS'][$key]['MODULES'][$keyModule]['COMPLETED'] = 'Y';
            $progress = 100;
        } else{
            $arResult['ITEMS'][$key]['MODULES'][$keyModule]['COMPLETED'] = 'N';
            $progress = $userModules[$module['ID']]['UF_PROGRESS'] ?: 0;
        }
        $totalModuleProgress += $progress;
        $arResult['ITEMS'][$key]['MODULES'][$keyModule]['PROGRESS'] = $progress;
    }
    $courseProgress = round(($totalModuleProgress / $moduleCount), 1);

    if ($item['TEST']) {
        if ($courseProgress < 75) {
            $arResult['ITEMS'][$key]['TEST']['AVAIL'] = 'N';
        } else {
            $arResult['ITEMS'][$key]['TEST']['AVAIL'] = 'Y';
        }
    }

    if ($item['TEST']['COMPLETED'] == 'Y'){
        $arResult['ITEMS'][$key]['PASSED'] = 100;
    } else {
        $arResult['ITEMS'][$key]['PASSED'] = $courseProgress;
    }
}

//Get course result
$courseResults = [];
if ($userId = $USER->GetID()){
    $userCourses = CourseUser::getByUser($userId);
    $courseIds = [];
    foreach ($userCourses as $userCourse){
        $courseResults[$userCourse['UF_COURSE_ID']] = $userCourse;
    }
}

//sort courses
$tmpCourses = [];
foreach ($arResult['ITEMS'] as $item){
    if ($courseResults[$item['ID']]['UF_COMPLETED']){
        $item['PASSED'] = 100;
        $tmpCourses['PASSED'][] = $item;
    } else {
        $tmpCourses['NEW'][] = $item;
    }
}
$arResult['ITEMS'] = $tmpCourses;