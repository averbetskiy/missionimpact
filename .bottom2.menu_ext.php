<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $aMenuLinks */
global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "vayti:menu.sections",
    "",
    Array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "DEPTH_LEVEL" => "4",
        "DETAIL_PAGE_URL" => "#SECTION_CODE#/",
        "IBLOCK_ID" => BOTTOM2_MENU,
        "IS_SEF" => "Y",
        "SECTION_PAGE_URL" => "#SECTION_CODE#/",
        "SECTION_URL" => "",
        "SEF_BASE_URL" => '/',
        'USE_ELEMENTS' => 'Y',
    )
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
