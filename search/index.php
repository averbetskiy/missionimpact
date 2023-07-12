<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$arIblockFilter = [
    'PARAM2' => [PROJECT,CASES,EVENTS,BLOG,INSIGHTS,PAGE,SPEAKER,PARTNERS,TEST,MEDIA]
];
$arElements = $APPLICATION->IncludeComponent(
    "bitrix:search.page",
    "main",
    Array(
        "USE_SUGGEST" => "Y", //Показывать подсказку с поисковыми фразами
        "RESTART" => "Y", //Искать без учета морфологии (при отсутствии результата поиска)
        "NO_WORD_LOGIC" => "N", //Отключить обработку слов как логических операторов
        "USE_LANGUAGE_GUESS" => "N", //Включить автоопределение раскладки клавиатуры
        "CHECK_DATES" => "N", //Искать только в активных по дате документах
        "USE_TITLE_RANK" => "Y", //При ранжировании результата учитывать заголовки
        "DEFAULT_SORT" => 'rank', //Сортировка по умолчанию
        "FILTER_NAME" => "arIblockFilter",
        "arrFILTER" => [ //Ограничение области поиска
//                                'iblock_70',
////                                'iblock_72',
////                                'iblock_73',
////                                'iblock_69',
////                                'iblock_2',
        ],
        "PAGE_RESULT_COUNT" => "1000",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "NEWS_COUNT" => 10
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>