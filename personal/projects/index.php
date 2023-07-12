<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'profile');
global $USER;
if(!$USER->IsAuthorized()){
    LocalRedirect('/');
}
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "cover",
    Array(
        "CHECK_RIGHTS" => "N",
        "SEND_INFO" => "N",
        "SET_TITLE" => "Y",
        "USER_PROPERTY" => array(),
        "USER_PROPERTY_NAME" => ""
    )
);?>

    <div class="profile">
        <div class="container">
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.profile",
                "header",
                Array(
                    "CHECK_RIGHTS" => "N",
                    "SEND_INFO" => "N",
                    "SET_TITLE" => "Y",
                    "USER_PROPERTY" => array(),
                    "USER_PROPERTY_NAME" => ""
                )
            );?>
            <div class="profile__inner">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "personal",
                    array(
                        "ROOT_MENU_TYPE" => "personal",
                        "MAX_LEVEL" => "1",
                        "CHILD_MENU_TYPE" => "personal",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MENU_ITEMS_ELEMENT" => "4",
                        "COMPONENT_TEMPLATE" => "profile"
                    ),
                    false
                );?>
                <?
                global $arFilterProjects;
                $arFilterProjects = [
                    'PROPERTY_view_personal_VALUE' => 'Y'
                ];
                ?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "personal_projects",
                    array(
                        "COMPONENT_TEMPLATE" => "project",
                        "IBLOCK_ID" => PROJECT,
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "PROPERTY_sort_personal",
                        "SORT_ORDER1" => "DESC",
                        "SORT_BY2" => "SORT",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "arFilterProjects",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "content",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d M Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "STRICT_SECTION_CHECK" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "PAGER_TITLE" => "News",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "Y",
                        "SHOW_404" => "Y",
                        "MESSAGE_404" => "",
                        "IBLOCK_TYPE" => "info",
                        "USE_SEARCH" => "N",
                        "USE_RSS" => "N",
                        "USE_RATING" => "N",
                        "USE_CATEGORIES" => "N",
                        "USE_REVIEW" => "N",
                        "USE_FILTER" => "N",
                        "SEF_MODE" => "Y",
                        "SEF_FOLDER" => "/solutions/",
                        "ADD_ELEMENT_CHAIN" => "N",
                        "USE_PERMISSIONS" => "N",
                        "LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "LIST_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "LIST_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "META_KEYWORDS" => "-",
                        "META_DESCRIPTION" => "-",
                        "BROWSER_TITLE" => "-",
                        "DETAIL_SET_CANONICAL_URL" => "N",
                        "DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "DETAIL_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "DETAIL_PROPERTY_CODE" => array(
                            0 => "content",
                            1 => "",
                        ),
                        "DETAIL_DISPLAY_TOP_PAGER" => "N",
                        "DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
                        "DETAIL_PAGER_TITLE" => "Страница",
                        "DETAIL_PAGER_TEMPLATE" => "",
                        "DETAIL_PAGER_SHOW_ALL" => "Y",
                        "SEF_URL_TEMPLATES" => array(
                            "news" => "",
                            "section" => "",
                            "detail" => "#ELEMENT_CODE#/",
                        )
                    ),
                    false
                );?>
            </div>
        </div>
    </div>
<?$APPLICATION->ShowViewContent('notifications');?>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "settings",
    Array(
        "CHECK_RIGHTS" => "N",
        "SEND_INFO" => "N",
        "SET_TITLE" => "Y",
        "USER_PROPERTY" => array(),
        "USER_PROPERTY_NAME" => ""
    )
);?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>