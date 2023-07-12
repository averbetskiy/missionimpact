<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'profile');
?>

<?
global $USER;
if(!$USER->IsAuthorized()){
    LocalRedirect('/');
}

global $courseFilter;
global $courseOtherFilter;
if ($userId = $USER->GetID()){
    $userCourses = CourseUser::getByUser($userId);
    $courseIds = [];
    foreach ($userCourses as $userCourse){
        if ($userCourse['UF_COURSE_ID']){
            $courseIds[] = $userCourse['UF_COURSE_ID'];
        }
    }

    $courseFilter['ID'] = $courseIds;
    $courseOtherFilter['!ID'] = $courseIds;
}
if (!$courseFilter['ID']){
    $courseFilter['ID'] = 0;
}


$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "personal_courses",
    array(
        "IBLOCK_TYPE" => "",
        "IBLOCK_ID" => COURSES,
        "NEWS_COUNT" => "0",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "",
        "SORT_ORDER2" => "",
        "FIELD_CODE" => array(
            0 => "DATE_CREATE",
            1 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "photos",
            2 => "",
        ),
        "SECTION_URL" => '',
        "IBLOCK_URL" => '',
        "DISPLAY_PANEL" => '',
        "SET_TITLE" => "N",
        "SET_LAST_MODIFIED" => "N",
        "MESSAGE_404" => "",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "FILE_404" => '',
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "CACHE_TYPE" => "N",
        "CACHE_TIME" => "36000",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "PAGER_TITLE" => "",
        "PAGER_TEMPLATE" => "search",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_BASE_LINK" => '',
        "PAGER_PARAMS_NAME" => '',
        "DISPLAY_DATE" => '',
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => '',
        "DISPLAY_PREVIEW_TEXT" => '',
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "d F Y",
        "USE_PERMISSIONS" => '',
        "GROUP_PERMISSIONS" => '',
        "FILTER_NAME" => "courseFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "CHECK_DATES" => "N",
        "COMPONENT_TEMPLATE" => "personal_courses",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "STRICT_SECTION_CHECK" => "N",
        "DETAIL_URL" => ""
    ),
    false
);?>


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
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "personal",
		"COMPONENT_TEMPLATE" => "profile",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_ITEMS_ELEMENT" => "4",
		"ROOT_MENU_TYPE" => "personal",
		"USE_EXT" => "N"
	)
);?>
			<div class="profile__main">
				<div class="profile__main-left">
                    <?$APPLICATION->ShowViewContent('personal_courses_tabs');?>
				</div>
				<div class="profile__main-center">
                    <?$APPLICATION->ShowViewContent('personal_courses');?>
				</div>
				<div class="profile__main-right">
				</div>
			</div>
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
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>