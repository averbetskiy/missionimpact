<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
$arCheckList = [];
$arUser = $arResult['arUser'];
$idCheckList = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_CHECKLIST_PROFILE");
$rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_CHECKLIST_PROFILE", "ID" =>$idCheckList));
while($arEnum = $rsEnum->GetNext()){
    switch ($arEnum['XML_ID']) {
        case 'UF_PHOTO1':
            if(!$arUser['UF_PHOTO']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_PROFILE_UPLOAD_PHOTO']['UF_VALUE'],
                    'ORIGINAL' => 'PHOTO'
                ];
            }
            break;
        case 'NAME':
            if(!$arUser['NAME']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['SIGN_IN_NAME']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'LAST_NAME':
            if(!$arUser['LAST_NAME']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['SIGN_IN_LAST_NAME']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'UF_GENDER':
            if(!$arUser['UF_GENDER']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_GENDER']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'UF_BIRTHDAY':
            if(!$arUser['UF_BIRTHDAY']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_DATE_BIRTH']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'PERSONAL_STATE':
            if(!$arUser['PERSONAL_STATE']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_COUNTRY']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'PERSONAL_CITY':
            if(!$arUser['PERSONAL_CITY']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_CITY']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'EMAIL':
            if(!$arUser['EMAIL']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['SIGN_IN_EMAIL']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'PERSONAL_PHONE':
            if(!$arUser['PERSONAL_PHONE']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_PHONE']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'PERSONAL_NOTES':
            if(!$arUser['PERSONAL_NOTES']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_SCOPE']['UF_VALUE'],
                    'ORIGINAL' => 'BASE'
                ];
            }
            break;
        case 'WORK_COMPANY':
            if(!$arUser['WORK_COMPANY']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_ORG']['UF_VALUE'],
                    'ORIGINAL' => 'WORK'
                ];
            }
            break;
        case 'WORK_POSITION':
            if(!$arUser['WORK_POSITION']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_POSITION']['UF_VALUE'],
                    'ORIGINAL' => 'WORK'
                ];
            }
            break;
        case 'UF_NUMBER_EMPLOYEES':
            if(!$arUser['UF_NUMBER_EMPLOYEES']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_NUMBER_EMPLOYEES']['UF_VALUE'],
                    'ORIGINAL' => 'WORK'
                ];
            }
            break;
        case 'WORK_PROFILE':
            if(!$arUser['WORK_PROFILE']) {
                $arCheckList[] = [
                    'CODE' => $arEnum['XML_ID'],
                    'NAME' => $arHandBook['PROFILE_ACTIVITY']['UF_VALUE'],
                    'ORIGINAL' => 'WORK'
                ];
            }
            break;
    }
}
$arResult['CHECK_LIST'] = $arCheckList;