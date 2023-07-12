<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$author = [];
$univer = [];
if($arResult['PROPERTIES']['author']['VALUE']){
    $author = \Bitrix\Iblock\Elements\ElementSpeakerTable::getRow([
        'select' => ['ID','NAME','POST_' => 'POST'],
        'filter' => ['=ACTIVE' => 'Y','ID' => $arResult['PROPERTIES']['author']['VALUE']],
    ]);
}
if($arResult['PROPERTIES']['univer']['VALUE']){
    $univer = \Bitrix\Iblock\Elements\ElementCompanyTable::getRow([
        'select' => ['ID','NAME','PREVIEW_PICTURE', 'CITY_' => 'CITY'],
        'filter' => ['=ACTIVE' => 'Y','ID' => $arResult['PROPERTIES']['univer']['VALUE']],
    ]);
}
$arResult['UNIVER'] = $univer;
$arResult['AUTHOR'] = $author;