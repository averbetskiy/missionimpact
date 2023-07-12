<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

global $USER;

$arProjectsUserId = [];
$arProjectsUser = ProjectsUser::getByUser($USER->GetID());
foreach ($arProjectsUser as $project){
    $arProjectsUserId[] = $project['UF_PROJECT_ID'];
}
$arResult['PROJECTS_USER'] = $arProjectsUserId;