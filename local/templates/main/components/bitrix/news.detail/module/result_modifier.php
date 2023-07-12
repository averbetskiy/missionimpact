<? use Bitrix\Main\DB\SqlExpression;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
global $USER;
$userId = $USER->GetID();
$moduleId = $arResult['ID'];

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
    $data = [
        'UF_USER_ID' => $userId,
        'UF_MODULE_ID' => $moduleId,
        'UF_DATE_START' => new \Bitrix\Main\Type\DateTime(),
        'UF_PROGRESS' => 0
    ];
    if (!$arResult['PROPERTIES']['VIDEO']['VALUE']){
        $data['UF_PROGRESS'] = 100;
        $data['UF_COMPLETED'] = true;
    }


    $result = ModuleUser::add($data);
    if ($result->isSuccess()){
        if ($dupId = $arResult['PROPERTIES']['DUPLICATE_ELEMENT']['VALUE']){
            if (!ModuleUser::getOne($userId, $dupId)){
                $data['UF_MODULE_ID'] = $dupId;
                ModuleUser::add($data);
            }
        }
    }
}

$courseProgress = 0;
$userModulesCount = 0;
$userModules = [];
if ($arResult['MODULES']){
    $totalModuleProgress = 0;

    $moduleEntity = ModuleUser::getEntity();
    $rsModuleUser = $moduleEntity::getList([
        'filter' => [
            'UF_USER_ID' => $USER->GetID(),
            'UF_MODULE_ID' => array_keys($arResult['MODULES'])
        ],
        'count_total' => true,
    ]);
    while ($userModule = $rsModuleUser->fetch()){
        $userModules[$userModule['UF_MODULE_ID']] = $userModule;
    }

    foreach ($arResult['MODULES'] as $keyModule => $module) {
        if (isset($userModules[$module['ID']]) && $userModules[$module['ID']]['UF_COMPLETED']){
            $userModulesCount++;
            $arResult['MODULES'][$keyModule]['COMPLETED'] = 'Y';
            $progress = 100;
        } else {
            $arResult['MODULES'][$keyModule]['COMPLETED'] = 'N';
            $progress = $userModules[$module['ID']]['UF_PROGRESS'] ?: 0;
        }
        $totalModuleProgress += $progress;
        $arResult['MODULES'][$keyModule]['PROGRESS'] = $progress;
    }
    $courseProgress = round(($totalModuleProgress / count($arResult['MODULES'])), 1);
}

//Get test
if (\Bitrix\Main\Loader::includeModule('aelita.test')){
    $testId = $arResult['COURSE']['TEST_ID_VALUE'];
    if ($testId)
    {
        $testEntity = new AelitaTestTest;
        $rsTest = $testEntity->GetList([], ['ID' => $testId, 'ACTIVE' => 'Y']);
        if($test = $rsTest->Fetch())
        {
            if ($courseProgress < 75){
                $test['AVAIL'] = 'N';
            } else {
                $test['AVAIL'] = 'Y';
            }
            $arResult['TEST'] = $test;
        }
    }
}

unset($arResult['MODULES'][$arResult['ID']]);