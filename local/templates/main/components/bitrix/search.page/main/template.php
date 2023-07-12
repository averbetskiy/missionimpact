<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
use \Bitrix\Main\Context;

$APPLICATION->SetPageProperty('body_class', 'searchFull');

global $arHandBook,$commonSearchFilter;

$request = Context::getCurrent()->getRequest();
$id = $request->get("id");
$ajax = $request->get("ajax");
$ajaxHeader = $request->get("ajaxHeader");
if($id == 'all' || !$id){
    $arIblockId = [PROJECT,CASES,EVENTS,BLOG,INSIGHTS,SPEAKER,PARTNERS,TEST,MEDIA];
    $commonSearchFilter['ID'] = $arResult['ITEMS']['all'];
}else{
    $arIblockId = $id;
    $commonSearchFilter['ID'] = $arResult['ITEMS'][$id];
}
?>
<div class="search__results-wrap searchPageAjax" style="z-index: 9">
    <?if ($request->isAjaxRequest() && $ajaxHeader == 'Y') {
        $APPLICATION->RestartBuffer();
    } ?>
    <div class="search__results-tabs">
        <?if($arResult['SEARCH']){?>
            <div class="search__results-tabs__head">
				<div class="search__results-tabs__head-wrap container">
					<a href="javascript:void(0)" data-cat="all" data-id="all" class="current hoverMe" data-attr="<?=$arResult['TAB']['all']?> [<?=count($arResult['SEARCH'])?>]"><?=$arResult['TAB']['all']?> [<?=count($arResult['SEARCH'])?>]</a>
					<?foreach($arIblockId as $iblockId){?>
						<?$tab = $arResult['TAB'][$iblockId];?>
						<?if($tab){?>
							<a href="javascript:void(0)" data-cat="tab<?=$iblockId?>" data-id="<?=$iblockId?>" class="hoverMe" data-attr="<?=$tab?> [<?=count($arResult['ITEMS'][$iblockId])?>]"><?=$tab?> [<?=count($arResult['ITEMS'][$iblockId])?>]</a>
						<?}?>
					<?}?>
				</div>
            </div>
            <div class="search__results-tabs__body">
                <?if ($request->isAjaxRequest() && $ajax == 'Y') {
                    $APPLICATION->RestartBuffer();
                } ?>
                <?$APPLICATION->IncludeComponent(
                    "vayti:news.list",
                    "search",
                    array(
                        "IBLOCK_TYPE" => "",
                        "IBLOCK_ID" => $arIblockId,
                        "NEWS_COUNT" => 8,
                        "SORT_BY1" => 'ACTIVE_FROM',
                        "SORT_ORDER1" => 'DESC',
                        "SORT_BY2" => "",
                        "SORT_ORDER2" => "",
                        "FIELD_CODE" => array(
                            0 => "DATE_CREATE",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "photos",
                        ),
                        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                        "IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
                        "DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
                        "SET_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "FILE_404" => $arParams["FILE_404"],
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "",
                        "PAGER_TEMPLATE" => "search",
                        "PAGER_SHOW_ALWAYS" => "Y",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
                        "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d F Y",
                        "USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
                        "GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
                        "FILTER_NAME" => "commonSearchFilter",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "CHECK_DATES" => "N",
                        "COMPONENT_TEMPLATE" => ".default",
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
                        "TAB" => "tab1",
                        "FORMATED" => $arResult['FORMATED']
                    ),
                    $component
                );?>
                <?if ($request->isAjaxRequest() && $ajax == 'Y') {
                    die();
                } ?>
                <div class="search__results-tabs__body-item" data-cat="documents">
                    <div class="search__results-tabs__body-item__list" data-type="docs">
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                        <a href="#" class="search__results-body__item">
                            <div class="search__results-body__item-wrap container">
                                <div class="search__results-body__item-docs__title">Performance consequences framework.doc</div>
                            </div>
                        </a>
                    </div>
                    <div class="container">
                        <div class="search__results-tabs__body-item__more">
                            <a href="#" class="hoverMe" data-attr="View all Results →">View all Results →</a>
                        </div>
                        <div class="search__results-tabs__body-item__pagenav">
                            <a href="#" class="arrow prev">
                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.50994 0.737216L8.78835 2.00142L4.34943 6.44034L15.5 6.44034V8.28693L4.34943 8.28693L8.78835 12.7187L7.50994 13.9901L0.883523 7.36364L7.50994 0.737216Z" fill="#1A1A1A"/>
                                </svg>
                            </a>
                            <span class="current">1</span>
                            <a href="#" class="link">2</a>
                            <a href="#" class="link">3</a>
                            <span>...</span>
                            <a href="#" class="link">10</a>
                            <a href="#" class="arrow next">
                                <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.49006 13.2628L7.21165 11.9986L11.6506 7.55966H0.5V5.71307H11.6506L7.21165 1.28125L8.49006 0.00994253L15.1165 6.63636L8.49006 13.2628Z" fill="#1A1A1A"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="load_ajax"></div>
        <?}else{?>
            <div class="search__results-empty">
				<div class="search__results-empty__title"><?=$arHandBook['SEARCH_RESULT_EMPTY_TITLE']['UF_VALUE']?></div>
				<div class="search__results-empty__text"><?=$arHandBook['SEARCH_RESULT_EMPTY_TEXT']['UF_VALUE']?></div>
			</div>
        <?}?>
    </div>
    <?if ($request->isAjaxRequest() && $ajaxHeader == 'Y') {
        die();
    } ?>
</div>