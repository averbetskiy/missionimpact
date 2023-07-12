<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */
global $arHandBook;
global $notificationsNew;

if ($arResult['User']) {
    $notificationsNew = NotificationsUser::countNew($arResult['User']['ID']);
    $arUser = $arResult['arUser'];
    $idCheckList = (array)\Bitrix\Main\Config\Option::get("askaron.settings", "UF_CHECKLIST_PROFILE");
    $rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME" => "UF_CHECKLIST_PROFILE", "ID" => $idCheckList));
    while ($arEnum = $rsEnum->GetNext()) {
        if ($arEnum['XML_ID'] == 'UF_PHOTO1') {
            $arFieldCustomer[] = $arUser['UF_PHOTO'];
        } else {
            $arFieldCustomer[] = $arUser[$arEnum['XML_ID']];
        }
    }

    $arFieldCustomer = array_diff($arFieldCustomer, ['']);
    $percent = count($arFieldCustomer) * 100 / count($idCheckList);
    if ($percent <= 33.3) {
        $customer = $arHandBook['UF_CUSTOMER_BEGGINER']['UF_VALUE'];
    } elseif ($percent <= 66.6) {
        $customer = $arHandBook['UF_CUSTOMER_COMPETENT']['UF_VALUE'];
    } elseif ($percent <= 100) {
        $customer = $arHandBook['UF_CUSTOMER_PROFICIENT']['UF_VALUE'];
    }

    $arResult['CUSTOMER'] = $customer;
    $arResult['NOTIFICATIONS'] = $notificationsNew;
}