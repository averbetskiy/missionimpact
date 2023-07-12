<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
global $USER;
global $arHandBook;
if (!$USER->IsAuthorized()){
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}

$courseEntity = \Bitrix\Iblock\Iblock::wakeUp(COURSES)->getEntityDataClass();
$course = $courseEntity::getRow([
    'select' => [
        '*',
        'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL',
        'MODULES_SECTION_ID_VALUE' => 'MODULES_SECTION_ID.VALUE',
        'TEST_ID_VALUE' => 'TEST_ID.VALUE',
        'DUPLICATE_ELEMENT_VALUE' => 'DUPLICATE_ELEMENT.VALUE'
    ],
    'filter' => [
        'IBLOCK_ID' => COURSES,
        'CODE' => $_GET['course'],
        'ACTIVE' => 'Y'
    ],
]);

if (!($testId = $course['TEST_ID_VALUE'])){
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}

//Get modules count
$moduleIds = [];
$moduleSectionId = $course['MODULES_SECTION_ID_VALUE'];
if ($moduleSectionId) {
    $moduleEntity = \Bitrix\Iblock\Iblock::wakeUp(MODULES)->getEntityDataClass();

    $rsModule = $moduleEntity::getList([
        'select' => [
            'ID',
        ],
        'filter' => [
            'IBLOCK_SECTION_ID' => $moduleSectionId,
            'ACTIVE' => 'Y',
        ]
    ]);
    while ($module = $rsModule->fetch()){
        $moduleIds[] = $module['ID'];
    }
}

$userModules = [];
if ($moduleIds){
    $moduleEntity = ModuleUser::getEntity();
    $rsModuleUser = $moduleEntity::getList([
        'filter' => [
                'UF_USER_ID' => $USER->GetID(),
            'UF_MODULE_ID' => $moduleIds
        ]
    ]);
    while ($userModule = $rsModuleUser->fetch()){
        $userModules[] = $userModule;
    }
}

if ((count($userModules) / count($moduleIds)) < 0.75){
    Bitrix\Iblock\Component\Tools::process404(
        '', //Сообщение
        true, // Нужно ли определять 404-ю константу
        true, // Устанавливать ли статус
        true, // Показывать ли 404-ю страницу
        false // Ссылка на отличную от стандартной 404-ю
    );
}
?>
	<div class="pageCourse pageCourse__noBottom">
		<div class="container">
			<div class="pageCourse__inner">
				<div class="pageCourse__inner-back">
					<a href="/personal/courses/#<?=$_GET['course']?>" class="hoverMe" data-attr="← <?=$arHandBook['BACK_TO_COURSES_DETAIL']['UF_VALUE']?>">← <?=$arHandBook['BACK_TO_COURSES_DETAIL']['UF_VALUE']?></a>
				</div>
				<?$APPLICATION->IncludeComponent(
					"aelita:test.test",
					"course",
					Array(
						"ADD_GROUP_CHAIN" => "N",	// Добавлять группу в цепочку навигации
						"ADD_TEST_CHAIN" => "N",	// Добавлять тест в цепочку навигации
						"AJAX_MODE" => "N",	// Включить режим AJAX
						"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
						"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
						"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
						"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
						"DETAIL_URL" => "",	// Адрес теста
						"LIST_PAGE_URL" => "",	// Адрес группы
						"PROFILE_DETAIL_URL" => "",	// Ссылка на результат в профиле
						"SET_TITLE_GROUP" => "N",	// Устанавливать заголовок из имени группы
						"SET_TITLE_TEST" => "N",	// Устанавливать заголовок из имени теста
						"TEST_GROUP" => "",	// Группа теста
						"TEST_ID" => $testId,	// ID теста
                        "MODULE_IDS" => $moduleIds,
                        "COURSE" => $course
					),
					false
				);?>

			</div>
		</div>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>