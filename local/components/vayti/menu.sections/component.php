<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["ID"] = intval(($arParams["ID"] ?? 0));
$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);

$arParams["DEPTH_LEVEL"] = intval($arParams["DEPTH_LEVEL"]);
if($arParams["DEPTH_LEVEL"]<=0)
	$arParams["DEPTH_LEVEL"]=1;

$arResult["SECTIONS"] = array();
$arResult["ELEMENT_LINKS"] = array();

if($this->StartResultCache())
{
	if(!CModule::IncludeModule("iblock"))
	{
		$this->AbortResultCache();
	}
	else
	{
		$arFilter = array(
			"IBLOCK_ID"=>$arParams["IBLOCK_ID"],
			"GLOBAL_ACTIVE"=>"Y",
			"IBLOCK_ACTIVE"=>"Y",
			"<="."DEPTH_LEVEL" => $arParams["DEPTH_LEVEL"],
		);
		$arOrder = array(
			"sort"=>"asc",
		);

		$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, array(
			"ID",
			"DEPTH_LEVEL",
			"NAME",
			"CODE",
			"SECTION_PAGE_URL",
			"IBLOCK_SECTION_ID",
			"DESCRIPTION",
			"UF_LINK",
			"UF_LINK_TITLE",
			"UF_LINK_TEXT",
			"UF_IBLOCK",
			"UF_COUNT_ELEMENT",
			"UF_TYPE",
			"UF_LINK_BOTTOM",
			"UF_LINK_BOTTOM_TEXT",
		));
		if($arParams["IS_SEF"] !== "Y")
			$rsSections->SetUrlTemplates("", $arParams["SECTION_URL"]);
		else
			$rsSections->SetUrlTemplates("", $arParams["SEF_BASE_URL"].$arParams["SECTION_PAGE_URL"]);
		while($arSection = $rsSections->GetNext())
		{
			$arPropType = "";
			if($arSection['UF_TYPE']) {
				$rsEnum = CUserFieldEnum::GetList(array(), array("ID" => $arSection['UF_TYPE']));
				$arEnum = $rsEnum->GetNext();
				$arPropType = $arEnum["XML_ID"];
			}
			if($arSection['DEPTH_LEVEL'] == 2){
				$arResult["SECTIONS"][$arSection["IBLOCK_SECTION_ID"]]['SUB_SECTIONS'][] = array(
					"ID" => $arSection["ID"],
					"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
					"~NAME" => $arSection["~NAME"],
					"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
					"UF_LINK" => $arSection['UF_LINK'],
					"UF_LINK_TITLE" => $arSection['UF_LINK_TITLE'],
					"UF_LINK_TEXT" => $arSection['UF_LINK_TEXT'],
					"UF_IBLOCK" => $arSection['UF_IBLOCK'],
					"UF_COUNT_ELEMENT" => $arSection['UF_COUNT_ELEMENT'],
					"DESCRIPTION" => $arSection['DESCRIPTION'],
					"CODE" => $arSection['CODE'],
					"UF_TYPE" => $arPropType,
				);
			}else {
				$arResult["SECTIONS"][$arSection["ID"]] = array(
					"ID" => $arSection["ID"],
					"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
					"~NAME" => $arSection["~NAME"],
					"~SECTION_PAGE_URL" => $arSection["~SECTION_PAGE_URL"],
					"UF_LINK" => $arSection['UF_LINK'],
					"UF_LINK_TITLE" => $arSection['UF_LINK_TITLE'],
					"UF_LINK_TEXT" => $arSection['UF_LINK_TEXT'],
					"UF_LINK_BOTTOM_TEXT" => $arSection['UF_LINK_BOTTOM_TEXT'],
					"UF_LINK_BOTTOM" => $arSection['UF_LINK_BOTTOM'],
					"UF_IBLOCK" => $arSection['UF_IBLOCK'],
					"UF_COUNT_ELEMENT" => $arSection['UF_COUNT_ELEMENT'],
					"DESCRIPTION" => $arSection['DESCRIPTION'],
					"CODE" => $arSection['CODE'],
					"UF_TYPE" => $arPropType,
				);
			}
			$arResult["ELEMENT_LINKS"][$arSection["ID"]] = array();
		}
		$this->EndResultCache();
	}
}

//In "SEF" mode we'll try to parse URL and get ELEMENT_ID from it
if($arParams["IS_SEF"] === "Y")
{
	$engine = new CComponentEngine($this);
	if (CModule::IncludeModule('iblock'))
	{
		$engine->addGreedyPart("#SECTION_CODE_PATH#");
		$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
	}
	$componentPage = $engine->guessComponentPath(
		$arParams["SEF_BASE_URL"],
		array(
			"section" => $arParams["SECTION_PAGE_URL"],
			"detail" => $arParams["DETAIL_PAGE_URL"],
		),
		$arVariables
	);
	if($componentPage === "detail")
	{
		CComponentEngine::InitComponentVariables(
			$componentPage,
			array("SECTION_ID", "ELEMENT_ID"),
			array(
				"section" => array("SECTION_ID" => "SECTION_ID"),
				"detail" => array("SECTION_ID" => "SECTION_ID", "ELEMENT_ID" => "ELEMENT_ID"),
			),
			$arVariables
		);
		$arParams["ID"] = intval($arVariables["ELEMENT_ID"]);
	}
}

if(($arParams["ID"] > 0) && (intval($arVariables["SECTION_ID"]) <= 0) && CModule::IncludeModule("iblock"))
{
	$arSelect = array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID","UF_LINK");
	$arFilter = array(
		"ID" => $arParams["ID"],
		"ACTIVE" => "Y",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	);
	$rsElements = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
	if(($arParams["IS_SEF"] === "Y") && ($arParams["DETAIL_PAGE_URL"] <> ''))
		$rsElements->SetUrlTemplates($arParams["SEF_BASE_URL"].$arParams["DETAIL_PAGE_URL"]);
	while($arElement = $rsElements->GetNext())
	{
		$arResult["ELEMENT_LINKS"][$arElement["IBLOCK_SECTION_ID"]][] = $arElement["~DETAIL_PAGE_URL"];
	}
}

$aMenuLinksNew = array();
$menuIndex = 0;
$previousDepthLevel = 1;
foreach($arResult["SECTIONS"] as $arSection)
{
	if ($menuIndex > 0)
		$aMenuLinksNew[$menuIndex - 1][3]["IS_PARENT"] = $arSection["DEPTH_LEVEL"] > $previousDepthLevel;
	$previousDepthLevel = $arSection["DEPTH_LEVEL"];
	$link = $arSection["~SECTION_PAGE_URL"];
	if($arSection['UF_LINK']){
		$link = $arSection['UF_LINK'];
	}
	$arResult["ELEMENT_LINKS"][$arSection["ID"]][] = urldecode($arSection["~SECTION_PAGE_URL"]);
	$arSolutions = [];
	$arSolutionsType = [];
	$arSolutionsTypeAll = [];
	if($arSection["UF_IBLOCK"]) {
		$arSelect = ["ID", "NAME", 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL','DATE_ACTIVE_FROM'];
		$arFilter = ["IBLOCK_ID" => $arSection["UF_IBLOCK"], "ACTIVE" => "Y"];
		if($arSection['UF_TYPE'] == 'about') {
			$arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
		}
		$res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, ['nPageSize' => $arSection['UF_COUNT_ELEMENT']], $arSelect);
		while ($ob = $res->GetNextElement()) {
			$arFields = $ob->GetFields();
			$arFields['PREVIEW_PICTURE'] = CFile::GetPath($arFields['PREVIEW_PICTURE']);
			$arSolutions[] = $arFields;
		}
	}
	foreach ($arSection['SUB_SECTIONS'] as &$subSection){
		if($subSection["UF_IBLOCK"]) {
			$arSolutionsSection = [];
			$arAuthor = [];
			$arSectionElement = [];
			$arSelectSection = ["ID", "NAME", 'PREVIEW_PICTURE', 'DETAIL_PAGE_URL','DATE_ACTIVE_FROM','PREVIEW_TEXT'];
			$arFilterSection = ["IBLOCK_ID" => $subSection["UF_IBLOCK"], "ACTIVE" => "Y"];
			$sort = ['SORT' => 'ASC'];
			if($subSection['UF_IBLOCK'] == EVENTS) {
				$arSelectSection[] = "PROPERTY_type";
				$sort = ['ACTIVE_FROM' => 'DESC'];
			}elseif ($subSection['UF_IBLOCK'] == COURSES){
				$arSelectSection[] = "PROPERTY_author";
				$sort = ['ID' => 'DESC'];
			}elseif ($subSection['UF_IBLOCK'] == BLOG){
				$arSelectSection[] = "IBLOCK_SECTION_ID";
				$arSelectSection[] = "PROPERTY_time";
				$sort = ['ACTIVE_FROM' => 'DESC'];
			}
			elseif ($subSection['UF_IBLOCK'] == INSIGHTS){
				$arSelectSection[] = "PROPERTY_number";
				$sort = ['ID' => 'DESC'];
			}
			$resSection = CIBlockElement::GetList($sort, $arFilterSection, false, ['nPageSize' => $subSection['UF_COUNT_ELEMENT']], $arSelectSection);
			while ($obSection = $resSection->GetNextElement()) {
				$arFieldsSection = $obSection->GetFields();
				if($arFieldsSection['PREVIEW_PICTURE']) {
					$arFieldsSection['PREVIEW_PICTURE'] = CFile::GetPath($arFieldsSection['PREVIEW_PICTURE']);
				}
				if($arFieldsSection['PROPERTY_AUTHOR_VALUE']){
					$arAuthor[] = $arFieldsSection['PROPERTY_AUTHOR_VALUE'];
				}
				if($arFieldsSection['IBLOCK_SECTION_ID']){
					$arSectionElement[] = $arFieldsSection['IBLOCK_SECTION_ID'];
				}
				$arSolutionsSection[] = $arFieldsSection;
			}
			if($arAuthor) {
				$rsAuthor = \Bitrix\Iblock\ElementTable::getList([
					'filter' => ['ID' => $arAuthor, 'IBLOCK_ID' => SPEAKER],
					'select' => ['ID', 'NAME']
				]);
				while ($author = $rsAuthor->fetch()) {
					$arAuthor[$author['ID']] = $author;
				}
			}
			if($arSectionElement) {
				$rsSectionElement = \Bitrix\Iblock\SectionTable::getList([
					'filter' => ['ID' => $arSectionElement, 'IBLOCK_ID' => $subSection['UF_IBLOCK']],
					'select' => ['ID', 'NAME','CODE']
				]);
				while ($sectionElement = $rsSectionElement->fetch()) {
					$arSectionElement[$sectionElement['ID']] = $sectionElement;
				}
			}
			$subSection['AUTHOR'] = $arAuthor;
			$subSection['SECTION_ELEMENT'] = $arSectionElement;
			$subSection['ITEMS'] = $arSolutionsSection;
		}
	}
	$aMenuLinksNew[$menuIndex++] = array(
		htmlspecialcharsbx($arSection["~NAME"]),
		$link,
		$arResult["ELEMENT_LINKS"][$arSection["ID"]],
		array(
			"FROM_IBLOCK" => true,
			"IS_PARENT" => false,
			"DEPTH_LEVEL" => $arSection["DEPTH_LEVEL"],
			"DESCRIPTION" => $arSection["DESCRIPTION"],
			"UF_IBLOCK" => $arSection["UF_IBLOCK"],
			"UF_LINK_TITLE" => $arSection["UF_LINK_TITLE"],
			"UF_LINK_TEXT" => $arSection["UF_LINK_TEXT"],
			"UF_LINK_BOTTOM_TEXT" => $arSection["UF_LINK_BOTTOM_TEXT"],
			"UF_LINK_BOTTOM" => $arSection["UF_LINK_BOTTOM"],
			"UF_TYPE" => $arSection["UF_TYPE"],
			"ITEMS" => $arSolutions,
			"SUB_SECTIONS" => $arSection['SUB_SECTIONS'],
			"CODE" => $arSection['CODE'],
		),

	);
}
return $aMenuLinksNew;
?>
