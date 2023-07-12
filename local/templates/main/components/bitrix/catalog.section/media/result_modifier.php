<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
foreach ($arResult['ITEMS'] as &$item){
    $db_propsP = CIBlockElement::GetProperty($item['IBLOCK_ID'], $item['ID'], array("sort" => "asc"), Array("CODE"=>"photos"));
    $db_propsVL = CIBlockElement::GetProperty($item['IBLOCK_ID'], $item['ID'], array("sort" => "asc"), Array("CODE"=>"video_link"));
    while($photo = $db_propsP->Fetch()){
        if($photo['VALUE']) {
            if (CModule::IncludeModule("millcom.phpthumb")) {
                if(CFile::GetPath($photo['VALUE'])) {
                    $item['PROPERTIES']['photos']['VALUE'][] = CMillcomPhpThumb::generateImg($photo['VALUE'], 2);
                }
            }
        }
    }
    if($video = $db_propsVL->Fetch()){
        $item['PROPERTIES']['video']['VALUE'] = $video['VALUE'];
    }else{
        $db_propsV = CIBlockElement::GetProperty($item['IBLOCK_ID'], $item['ID'], array("sort" => "asc"), Array("CODE"=>"video"));
        $video = $db_propsV->Fetch();
        $item['PROPERTIES']['video']['VALUE'] = CFile::GetPath($video['VALUE']);
    }
    if (CModule::IncludeModule("millcom.phpthumb"))
        $item["PREVIEW_PICTURE"]["SRC"] = CMillcomPhpThumb::generateImg($item["PREVIEW_PICTURE"]["SRC"], 1);
}