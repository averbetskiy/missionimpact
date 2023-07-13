<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $USER,$APPLICATION;
if($USER->IsAuthorized() && $_POST['USER_LOGIN'] && $_POST['USER_PASSWORD']){
    $arUser = \Bitrix\Main\UserTable::getRow([
        'select' => ['ID','UF_LANG'],
        'filter' => ['ID' => $USER->GetID()]
    ]);
    if($arUser){
//        if($arUser['UF_LANG'] == 'RU'){
//            setcookie('mi_lang', 's2');
//        }else{
//            setcookie('mi_lang', 's1');
//        }
        LocalRedirect("/personal/profile");
    }
}