<? /** @var $block array */?>
<?
global $arHandBook;
if($block['news']['iblock_id']) {
    $arItem = [];
    $arRecent = [];
    $arRecentIds = [];
    $arSectionIds = [];
    $arSection = [];
    $rsSection = \Bitrix\Iblock\SectionTable::getList([
        'filter' => ['IBLOCK_ID' => $block['news']['iblock_id'],'ACTIVE' => 'Y'],
        'select' => ['ID','NAME','CODE']
    ]);
    while($section = $rsSection->fetch()){
        $arSection[$section['ID']] = $section;
        $arSectionIds[] = $section['ID'];
    }
    if($arSection) {
        $count = 0;
        foreach ($arSectionIds as $sectionId) {
            $sort = ["ACTIVE_FROM" => "DESC"];
            $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL", "DATE_ACTIVE_FROM", "PREVIEW_PICTURE", "IBLOCK_SECTION_ID", "PROPERTY_video", "PROPERTY_time", "PROPERTY_link_video"];
            $arFilter = ["IBLOCK_ID" => $block['news']['iblock_id'], "ACTIVE" => "Y", "IBLOCK_SECTION_ID" => $sectionId];
            if ($block['news']['element_ids']) {
                $arFilter['ID'] = $block['news']['element_ids'];
                $sort = ["ID" => $block['news']['element_ids']];
            }
            $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize" => 4], $arSelect);
            while ($ob = $res->GetNextElement()) {
                $arFields = $ob->GetFields();
                $arItem[$arFields['IBLOCK_SECTION_ID']][] = $arFields;
                $count++;
            }
        }
        if($count < 4){
            $countRecent = $count;
        }else{
            $countRecent = 4;
        }
			for ($i = 0; count($arRecent) < $countRecent; $i++) {
				foreach ($arItem as $keyTest => $sectionItem) {
					if ($sectionItem[$i]) {
						$sectionItem[$i]['date'] = strtotime($sectionItem[$i]['DATE_ACTIVE_FROM']);
						$arRecent[] = $sectionItem[$i];
						$arRecentIds[] = $sectionItem[$i]['ID'];
					}
				}
			}
			usort($arRecent, function ($a, $b) {
				return strnatcmp($b['date'], $a['date']);
			});
    }
}
?>
<?if($arSection){?>
    <div class="indexSection5">
        <div class="container">
            <?if($block['name_block']['value']){?>
                <<?=$block['name_block']['type']?> class="index__heading"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
            <?}?>
            <div class="heading__columns">
                <div class="heading__columns-title"><?=$block['title']['value']?></div>
            </div>

            <div class="indexSection5__tabs filtering">
                <div class="indexSection5__tabs-top tabs__top">
                    <div class="indexSection5__tabs-head">
                        <div class="indexSection5__tabs_head-item filtering__button cat-all active"><?=$arHandBook['RECENT']['UF_VALUE']?></div>
                        <?foreach ($arSection as $section){?>
                            <?if($arItem[$section['ID']]){?>
                                <div class="indexSection5__tabs_head-item filtering__button cat-all-not hoverMe" data-cat="<?=$section['CODE']?>" data-attr="<?=strip_tags($section['NAME']);?>"><?=$section['NAME']?></div>
                            <?}?>
                        <?}?>
                    </div>
                    <?if($block['link']['value']){?>
                        <a href="<?=$block['link']['value']?>" class="indexSection5__tabs-all tabs__link hoverMe" data-attr="<?=strip_tags($block['text_botton']['value']);?>"><?=$block['text_botton']['value']?></a>
                    <?}?>
                </div>
                <div class="indexSection5__tabs-body filter-cat-results">
                    <div class="news__list">
                        <?php $i=0; foreach ($arRecent as $item){?>
                            <?
                            $video = '';
                            if($item['PROPERTY_LINK_VIDEO_VALUE']){
                                $video = $item['PROPERTY_LINK_VIDEO_VALUE'];
                            }elseif($item['PROPERTY_VIDEO_VALUE']){
                                $video = $item['PROPERTY_VIDEO_VALUE'];
                            }
                            ?>
                            <?if($video){?>
						<a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__list-item f-cat podcast active<?php if ($i > 3): ?> item-empty<?php endif; ?>" data-cat="<?=$arSection[$item['IBLOCK_SECTION_ID']]['CODE']?>">
                                    <div class="news__list_item-meta">
                                        <?=$arSection[$item['IBLOCK_SECTION_ID']]['NAME']?>
                                        <?if($item['DATE_ACTIVE_FROM']){?>
                                            \
                                            <?
                                            if($_COOKIE['mi_lang'] == 's2') {
                                                echo FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']));
                                            }else{
                                                echo str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM'])));
                                            }
                                            ?>
                                        <?}?>
                                    </div>
                                    <div class="news__list_item-content">
                                        <div class="news__list_item-photo">
                                            <?if($item['PREVIEW_PICTURE']){?>
                                                <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                            <?}?>
                                            <div class="news__list_item-time">
                                                <span><?=$item['PROPERTY_TIME_VALUE']?></span>
                                            </div>
                                        </div>
                                        <div class="news__list_item-title"><?=$item['NAME']?></div>
                                    </div>
                                </a>
                            <?}else{?>
						<a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__list-item f-cat active<?php if ($i > 3): ?> item-empty<?php endif; ?>" data-cat="<?=$arSection[$item['IBLOCK_SECTION_ID']]['CODE']?>">
                                    <div class="news__list_item-meta">
                                        <?=$arSection[$item['IBLOCK_SECTION_ID']]['NAME']?>
                                        <?if($item['DATE_ACTIVE_FROM']){?>
                                            \
                                            <?
                                            if($_COOKIE['mi_lang'] == 's2') {
                                                echo FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']));
                                            }else{
                                                echo str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM'])));
                                            }
                                            ?>
                                        <?}?>
                                    </div>
                                    <div class="news__list_item-content">
                                        <div class="news__list_item-photo">
                                            <?if($item['PREVIEW_PICTURE']){?>
                                                <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                            <?}?>
                                        </div>
                                        <div class="news__list_item-title"><?=$item['NAME']?></div>
                                    </div>
                                </a>
                            <?}?>
						<?php $i++; }?>
                        <?foreach ($arItem as $sectionItem){?>
                            <?foreach ($sectionItem as $item){?>
                                <?
                                if(in_array($item['ID'],$arRecentIds)){
                                    continue;
                                }
                                $video = '';
                                if($item['PROPERTY_LINK_VIDEO_VALUE']){
                                    $video = $item['PROPERTY_LINK_VIDEO_VALUE'];
                                }elseif($item['PROPERTY_VIDEO_VALUE']){
                                    $video = $item['PROPERTY_VIDEO_VALUE'];
                                }
                                ?>
                                <?if($video){?>
                                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__list-item f-cat item-empty podcast" data-cat="<?=$arSection[$item['IBLOCK_SECTION_ID']]['CODE']?>">
                                        <div class="news__list_item-meta">
                                            <?=$arSection[$item['IBLOCK_SECTION_ID']]['NAME']?>
                                            <?if($item['DATE_ACTIVE_FROM']){?>
                                                \
                                                <?
                                                if($_COOKIE['mi_lang'] == 's2') {
                                                    echo FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']));
                                                }else{
                                                    echo str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM'])));
                                                }
                                                ?>
                                            <?}?>
                                        </div>
                                        <div class="news__list_item-content">
                                            <div class="news__list_item-photo">
                                                <?if($item['PREVIEW_PICTURE']){?>
                                                    <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                                <?}?>
                                                <div class="news__list_item-time">
                                                    <span><?=$item['PROPERTY_TIME_VALUE']?></span>
                                                </div>
                                            </div>
                                            <div class="news__list_item-title"><?=$item['NAME']?></div>
                                        </div>
                                    </a>
                                <?}else{?>
                                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="news__list-item f-cat item-empty" data-cat="<?=$arSection[$item['IBLOCK_SECTION_ID']]['CODE']?>">
                                        <div class="news__list_item-meta">
                                            <?=$arSection[$item['IBLOCK_SECTION_ID']]['NAME']?>
                                            <?if($item['DATE_ACTIVE_FROM']){?>
                                                \
                                                <?
                                                if($_COOKIE['mi_lang'] == 's2') {
                                                    echo FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM']));
                                                }else{
                                                    echo str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M Y',strtotime($item['DATE_ACTIVE_FROM'])));
                                                }
                                                ?>
                                            <?}?>
                                        </div>
                                        <div class="news__list_item-content">
                                            <div class="news__list_item-photo">
                                                <?if($item['PREVIEW_PICTURE']){?>
                                                    <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                                <?}?>
                                            </div>
                                            <div class="news__list_item-title"><?=$item['NAME']?></div>
                                        </div>
                                    </a>
                                <?}?>
                            <?}?>
                        <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?}?>