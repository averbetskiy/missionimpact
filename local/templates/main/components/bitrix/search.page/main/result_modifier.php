<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */

global $arHandBook;
$arNameTab = [
    PROJECT => $arHandBook['SEARCH_SOLUTIONS']['UF_VALUE'],
    CASES => $arHandBook['SEARCH_CASES']['UF_VALUE'],
    BLOG => $arHandBook['SEARCH_BLOG']['UF_VALUE'],
    EVENTS => $arHandBook['SEARCH_EVENTS']['UF_VALUE'],
    INSIGHTS => $arHandBook['SEARCH_INSIGHTS']['UF_VALUE'],
    TEST => $arHandBook['SEARCH_TEST']['UF_VALUE'],
    SPEAKER => $arHandBook['SEARCH_SPEAKER']['UF_VALUE'],
    PARTNERS => $arHandBook['SEARCH_PARTNER']['UF_VALUE'],
    MEDIA => $arHandBook['SEARCH_MEDIA']['UF_VALUE'],
];
$arTab = [
    'all' => $arHandBook['SEARCH_ALL']['UF_VALUE'],
];
if($arResult['SEARCH']){
    $arIblockIds = [];
    $arItems = [];
    $arFormated = [];
    foreach ($arResult['SEARCH'] as $search){
        $arIblockIds[] = $search['PARAM2'];
        $arItems['all'][] = $search['ITEM_ID'];
        $arItems[$search['PARAM2']][] = $search['ITEM_ID'];
        $arFormated[$search['ITEM_ID']]['TITLE'] = $search['TITLE_FORMATED'];
        $arFormated[$search['ITEM_ID']]['BODY'] = $search['BODY_FORMATED'];
    }
    $arIblockIds = array_unique($arIblockIds);
    foreach ($arIblockIds as $iblockId){
        $arTab[$iblockId] = $arNameTab[$iblockId];
    }
}

$arResult['TAB'] = $arTab;
$arResult['ITEMS'] = $arItems;
$arResult['FORMATED'] = $arFormated;