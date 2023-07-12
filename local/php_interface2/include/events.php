<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("iblock", "OnAfterIBlockElementAdd", array("ElementEvent", "OnAfterIBlockElementAddHandler"));

$eventManager->addEventHandler("iblock", "OnAfterIBlockElementUpdate", array("ElementEvent", "OnAfterIBlockElementUpdateHandler"));


class ElementEvent
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        //Дублирование контента
        if (IBLOCK_CONTST[$arFields["IBLOCK_ID"]]) { //Если есть дубликат инфоблока в другой версии сайта
            ElementSynchronization::ElementSync($arFields);
        }
    }

    function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        //Дублирование контента
        if (IBLOCK_CONTST[$arFields["IBLOCK_ID"]]) { //Если есть дубликат инфоблока в другой версии сайта
            ElementSynchronization::ElementSync($arFields);
        }
    }
}

$eventManager->addEventHandler("iblock", "OnAfterIBlockSectionAdd", array("SectionEvent", "OnAfterIBlockSectionAddHandler"));

$eventManager->addEventHandler("iblock", "OnAfterIBlockSectionUpdate", array("SectionEvent", "OnAfterIBlockSectionUpdateHandler"));

class SectionEvent
{
    function OnAfterIBlockSectionAddHandler(&$arFields)
    {
        //Дублирование контента
        if (IBLOCK_CONTST[$arFields["IBLOCK_ID"]]) { //Если есть дубликат инфоблока в другой версии сайта
            SectionSynchronization::SectionSync($arFields);
        }
    }

    function OnAfterIBlockSectionUpdateHandler(&$arFields)
    {
        //Дублирование контента
        if (IBLOCK_CONTST[$arFields["IBLOCK_ID"]]) { //Если есть дубликат инфоблока в другой версии сайта
            SectionSynchronization::SectionSync($arFields);
        }
    }
}

$eventManager->addEventHandler("main", "OnAdminContextMenuShow", array("AdminEvent", "OnAdminContextMenuShowHandler"));


class AdminEvent
{
    function OnAdminContextMenuShowHandler(&$items)
    {
        //Редактирование элемента
        if ($_SERVER['REQUEST_METHOD'] == 'GET'
            && $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_element_edit.php'
            && $_REQUEST['ID'] > 0
        ) {
            if (IBLOCK_CONTST[$_REQUEST['IBLOCK_ID']]){
                $elementId = $_REQUEST['ID'];
                $iBlockId = $_REQUEST['IBLOCK_ID'];
                $arIBlocks = IBLOCK_IDS[IBLOCK_CONTST[$_REQUEST['IBLOCK_ID']]];
                $duplicateSiteId = 's1';
                $duplicateIBlockTypeId = '';
                $duplicateIBlockId = 0;
                foreach ($arIBlocks as $key => $arIBlockId){
                    if ($arIBlockId != $iBlockId) {
                        $duplicateIBlockId = $arIBlockId;
                        $duplicateSiteId = $key;
                    }
                }

                if ($duplicateIBlockId > 0){
                    $rsIBlock = CIBlock::GetByID($duplicateIBlockId);
                    if($arIBlock = $rsIBlock->Fetch())
                        $duplicateIBlockTypeId = $arIBlock['IBLOCK_TYPE_ID'];

                    $rsProp = CIBlockElement::GetProperty($iBlockId, $elementId, [], Array("CODE"=>"DUPLICATE_ELEMENT"));
                    if($arProp = $rsProp->Fetch()){
                        if ($arProp['VALUE']){
                            foreach ($items as $key => $item) {
                                if ($key == 3) {
                                    if ($duplicateSiteId == 's2')
                                        $text = 'Изменить для RU версии';
                                    else
                                        $text = 'Изменить для EN версии';
                                    $items[$key]['MENU'][] = [
                                        'TEXT' => $text,
                                        'LINK' => "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=$duplicateIBlockId&type=$duplicateIBlockTypeId&find_section_section=-1&ID={$arProp['VALUE']}&lang=" . SITE_ID,
                                    ];
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET'
            && $GLOBALS['APPLICATION']->GetCurPage() == '/bitrix/admin/iblock_section_edit.php'
            && $_REQUEST['ID'] > 0
        ) {
            if (IBLOCK_CONTST[$_REQUEST['IBLOCK_ID']]){
                $sectionId = $_REQUEST['ID'];
                $iBlockId = $_REQUEST['IBLOCK_ID'];
                $arIBlocks = IBLOCK_IDS[IBLOCK_CONTST[$_REQUEST['IBLOCK_ID']]];
                $duplicateSiteId = 's1';
                $duplicateIBlockTypeId = '';
                $duplicateIBlockId = 0;
                foreach ($arIBlocks as $key => $arIBlockId){
                    if ($arIBlockId != $iBlockId) {
                        $duplicateIBlockId = $arIBlockId;
                        $duplicateSiteId = $key;
                    }
                }

                if ($duplicateIBlockId > 0){
                    $rsIBlock = CIBlock::GetByID($duplicateIBlockId);
                    if($arIBlock = $rsIBlock->Fetch())
                        $duplicateIBlockTypeId = $arIBlock['IBLOCK_TYPE_ID'];
                    $arFilter = ['IBLOCK_ID'=>$iBlockId, 'ID' => $sectionId];
                    $arSelect = ['ID', 'UF_DUPLICATE_SECTION'];
                    $rsSection = CIBlockSection::GetList([], $arFilter, false, $arSelect);
                    if($arSection = $rsSection->Fetch())
                    {
                        if ($arSection['UF_DUPLICATE_SECTION']){
                            if ($duplicateSiteId == 's2')
                                $text = 'Изменить для RU версии';
                            else
                                $text = 'Изменить для EN версии';
                            $items[] = [
                                'TEXT' => $text,
                                'LINK' => "/bitrix/admin/iblock_section_edit.php?IBLOCK_ID=$duplicateIBlockId&type=$duplicateIBlockTypeId&find_section_section=0&ID={$arSection['UF_DUPLICATE_SECTION']}&lang=" . SITE_ID,
                            ];
                        }
                    }
                }
            }
        }
    }
}

$eventManager->AddEventHandler('sprint.editor', 'OnGetSearchIndex', ["IndexEvent", "SprintIndex"]);

class IndexEvent
{
    function SprintIndex($value, $search){
        $arKey = [
            'text',
            'desc',
            'htag',
            'text1',
            'text2',
            'text3',
            'text4',
            'text5',
            'text6',
            'name_block',
            'title',
            'sub_title',
            'info',
            'title1',
            'title2',
            'title3',
            'title4',
            'htag_result',
            'text_result',
            'text_link',
            'subtitle',
            'text_col1',
            'text_col2',
            'type',
            'link_text',
            'type1',
            'type2',
            'type3',
            'type4',
            'name_list',
            'value1',
            'value2',
            'value3',
            'value4',
            'desc_detail',
            'text_report',
        ];
        foreach ($value['blocks'] as $key => $val) {
            $indexBlocks = ['my_title', 'my_text', 'htag', 'my_blockquote'];
            if (in_array($val['name'], $indexBlocks)) {
                $search .= ' ' . $val['value'];
            }
            if ($val['name'] == 'table') {
                foreach ($val['rows'] as $row) {
                    foreach ($row as $td) {
                        $search .= ' ' . $td['text'];
                    }
                }
            }
            foreach ($arKey as $key) {
                if ($val[$key]['value']) {
                    $search .= ' ' . $val[$key]['value'];
                }
            }
            foreach($val['blocks'] as $subVal){
                foreach ($arKey as $key) {
                    if ($subVal[$key]['value']) {
                        $search .= ' ' . $subVal[$key]['value'];
                    }
                }
            }
        }
        return $search;

    }
}