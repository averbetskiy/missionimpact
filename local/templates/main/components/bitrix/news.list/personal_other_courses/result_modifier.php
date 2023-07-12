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

$userModuleIds = [];
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
        $userModuleIds[] = $userModule['UF_MODULE_ID'];
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

    if ($testIds)
    {
        $testEntity = new AelitaTestTest;
        $rsTest = $testEntity->GetList([], ['ID' => $testIds]);
        if($test = $rsTest->Fetch())
        {
            $tests[$test['ID']] = $test;
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
    foreach ($item['MODULES'] as $keyModule => $module) {
        $moduleCount++;
        if (in_array($module['ID'], $userModuleIds)) {
            $userModuleCount++;
            $arResult['ITEMS'][$key]['MODULES'][$keyModule]['COMPLETED'] = 'Y';
        } else {
            $arResult['ITEMS'][$key]['MODULES'][$keyModule]['COMPLETED'] = 'N';
        }
    }

    if ($item['TEST']) {
        if (($userModuleCount / $moduleCount) < 0.75) {
            $arResult['ITEMS'][$key]['TEST']['AVAIL'] = 'N';
        } else {
            $arResult['ITEMS'][$key]['TEST']['AVAIL'] = 'Y';
        }
    }
}