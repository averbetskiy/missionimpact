<? use Bitrix\Main\Context;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$request = Context::getCurrent()->getRequest();
$type= $request->get('type');
$calendarItems = $request->get('calendarItems');
$arMonthEvents = [];
$arSection = [];
$arSectionCount = [];
$rsSection = \Bitrix\Iblock\SectionTable::getList([
    'filter' => ['IBLOCK_ID' => $arParams['IBLOCK_ID']],
    'select' => ['ID','NAME','CODE']
]);
while($section = $rsSection->fetch()){
    $countSection = \Bitrix\Iblock\ElementTable::getCount(['IBLOCK_ID' => $arParams['IBLOCK_ID'],'IBLOCK_SECTION_ID' => $section['ID']]);
    $section['COUNT'] = $countSection;
    $arSection[$section['ID']] = $section;
}
foreach ($arResult['ITEMS'] as $item){
    if($type == 'calendar'){
        $month = FormatDate('d_m_Y', strtotime($item['ACTIVE_FROM']));
        $arMonthEvents[$month]['ITEMS'][] = $item;
        $arMonthEvents[$month]['MONTH'] = FormatDate('d.m.Y',strtotime($item['ACTIVE_FROM']));
    }else {
        $month = FormatDate('m_Y', strtotime($item['ACTIVE_FROM']));
        $arMonthEvents[$month]['ITEMS'][] = $item;
        if($_COOKIE['mi_lang'] == 's2') {
            $arMonthEvents[$month]['MONTH'] = FormatDate('F Y', strtotime($item['ACTIVE_FROM']));
        }else{
            $arMonthEvents[$month]['MONTH'] = str_replace(RU_LONG_MONTH, EN_LONG_MONTH, FormatDate('F Y', strtotime($item['ACTIVE_FROM'])));
        }
    }
}
$arItemsCalendar = [];
foreach ($arMonthEvents as $month){
    $events = [];
    foreach ($month['ITEMS'] as $item){
        $tags = [];
        foreach ($item['PROPERTIES']['tags']['VALUE'] as $tag){
            $tags[]['title'] = $tag;
        }
        $events[] = [
            'title' => $item['NAME'],
            'photo' => $item['PREVIEW_PICTURE']['SRC'],
            'link' => $item['DETAIL_PAGE_URL'],
            'desc' => $item['PREVIEW_TEXT'],
            'tags' => $tags,
        ];
    }
    $arItemsCalendar[] = [
        'date'  => $month['MONTH'],
        'events' => $events
    ];
}

$arResult['MONTH'] = $arMonthEvents;
$arResult['SECTION'] = $arSection;
if ($request->isAjaxRequest() && $calendarItems == 'Y') {
    $APPLICATION->RestartBuffer();
}
if ($request->isAjaxRequest() && $calendarItems == 'Y') {
    echo json_encode($arItemsCalendar);
}
if ($request->isAjaxRequest() && $calendarItems == 'Y') {
    die();
}