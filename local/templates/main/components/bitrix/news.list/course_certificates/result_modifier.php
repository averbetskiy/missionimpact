<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */

global $USER;
//Get course result
$courseResults = [];
if ($userId = $USER->GetID()){
    $userCourses = CourseUser::getByUser($userId);
    $courseIds = [];
    foreach ($userCourses as $userCourse){
        $courseResults[$userCourse['UF_COURSE_ID']] = $userCourse;
    }
}

foreach ($arResult['ITEMS'] as $key => $item){
    $arResult['ITEMS'][$key]['RESULT'] = $courseResults[$item['ID']];
}