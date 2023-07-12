<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook,$statusCustomer;
$arFieldCustomer = [];
$idCheckList = [];
$arUser = $arResult['arUser'];
$idCheckList = \Bitrix\Main\Config\Option::get( "askaron.settings", "UF_CHECKLIST_PROFILE");
$rsEnum = CUserFieldEnum::GetList(array(), array("USER_FIELD_NAME"=>"UF_CHECKLIST_PROFILE", "ID" =>$idCheckList));
while($arEnum = $rsEnum->GetNext()){
    if($arEnum['XML_ID'] == 'UF_PHOTO1'){
        $arFieldCustomer[] = $arUser['UF_PHOTO'];
    }else{
        $arFieldCustomer[] = $arUser[$arEnum['XML_ID']];
    }
}
$arFieldCustomer = array_diff($arFieldCustomer,['']);
$percent = count($arFieldCustomer)*100/count($idCheckList);
if($percent <= 33.3){
    $customer = $arHandBook['UF_CUSTOMER_BEGGINER']['UF_VALUE'];
}elseif ($percent <= 66.6){
    $customer = $arHandBook['UF_CUSTOMER_COMPETENT']['UF_VALUE'];
}elseif ($percent <= 100){
    $customer = $arHandBook['UF_CUSTOMER_PROFICIENT']['UF_VALUE'];
}
$statusCustomer = $customer;

$notifications = NotificationsUser::getByUser($arUser['ID']);
$arResult['NOTIFICATIONS'] = $notifications;

$arResult['PERCENT'] = $percent;
$arResult['CUSTOMER'] = $customer;

// result
$cp = $this->__component; // объект компонента

if (is_object($cp))
{
    // добавим в arResult компонента поля
    $cp->arResult['CUSTOMER'] = $arResult['CUSTOMER'];
}
?>