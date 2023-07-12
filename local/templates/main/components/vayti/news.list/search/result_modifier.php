<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
$iblockSectionMedia = [];
$replace = ['<span class="searchHighlight">','</span>'];
foreach ($arResult['ITEMS'] as &$item){
    if (CModule::IncludeModule("millcom.phpthumb"))
        $item["PREVIEW_PICTURE"]["SRC"] = CMillcomPhpThumb::generateImg($item["PREVIEW_PICTURE"]["SRC"], 1);

    $title = $arParams['FORMATED'][$item['ID']]['TITLE'];
    $body = $arParams['FORMATED'][$item['ID']]['BODY'];
    if($title){
        $item['NAME'] = str_replace(['<b>','</b>'],$replace,$title);
    }
    if($body){
        $item['PREVIEW_TEXT'] = str_replace(['<b>','</b>'],$replace,$body);
    }
    if($item['PROPERTIES']['video_link']['VALUE']){
        $video = $item['PROPERTIES']['video_link']['VALUE'];
    }else{
        $video = CFile::GetPath($item['PROPERTIES']['video']['VALUE']);
    }
    $item['PROPERTIES']['video']['VALUE'] = $video;
    if($item['IBLOCK_ID'] == MEDIA){
        $arPhoto = [];
        foreach ($item['PROPERTIES']['photos']['VALUE'] as $photo){
            if (CModule::IncludeModule("millcom.phpthumb")) {
                if(CFile::GetPath($photo)) {
                    $arPhoto[] = CMillcomPhpThumb::generateImg($photo, 2);
                }
            }
        }
        $item['PROPERTIES']['photos']['VALUE'] = $arPhoto;
    }
}
$rsSectionMedia = \Bitrix\Iblock\SectionTable::getList(['filter' => ['IBLOCK_ID' => MEDIA]]);
while($arSectionMedia = $rsSectionMedia->fetch()){
    $iblockSectionMedia[$arSectionMedia['ID']] = $arSectionMedia;
}
$arResult['SECTION_MEDIA'] = $iblockSectionMedia;