<? /** @var $block array */?>
<?
global $arHandBook;
if($block['media']['iblock_id']) {
    $arItem = [];
    $arSectionIds = [];
    $sort = ["ID" => "DESC"];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM","PREVIEW_PICTURE","IBLOCK_SECTION_ID","PROPERTY_video","PROPERTY_time","PROPERTY_link_video"];
    $arFilter = ["IBLOCK_ID" => $block['media']['iblock_id']];
    if($block['media']['element_ids']){
        $arFilter['ID'] = $block['media']['element_ids'];
        $sort = ["ID" => $block['media']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, ["nPageSize"=>2], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        $arItem[] = $arFields;
        $arSectionIds[] = $arFields['IBLOCK_SECTION_ID'];
    }
    $arSection = [];
    $rsSection = \Bitrix\Iblock\SectionTable::getList([
        'filter' => ['IBLOCK_ID' => $block['media']['iblock_id'],'ID' => $arSectionIds],
        'select' => ['ID','NAME','CODE']
    ]);
    while($section = $rsSection->fetch()){
        $arSection[$section['ID']] = $section;
    }
}
?>
<div class="diveinPage__wrap">
    <div class="diveinPage__left">
        <div class="diveinPage__wrap-top">
            <?if($block['name_block']['value']){?>
                <<?=$block['name_block']['type']?> class="diveinPage__left-title"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
            <?}?>
            <div class="diveinPage__left-desc">
                <?=$block['desc']['value']?>
            </div>
        </div>
        <?if($block['link']['value']){?>
			<div>
				<a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe" data-attr="<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>">
					<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>
				</a>
			</div>
        <?}?>
    </div>
    <div class="diveinPage__right">
        <div class="diveinPage__blog">
            <?foreach ($arItem as $item){?>
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="diveinPage__blog-item" data-type="<?=$arSection[$item['IBLOCK_SECTION_ID']]['CODE']?>">
                    <div class="diveinPage__blog-item__top">
                        <div class="diveinPage__blog-item__meta">
                            <?
                            if($_COOKIE['mi_lang'] == 's2') {
                                echo ucwords(str_replace(RU_SHORT_MONTH,RU_SHORT_MONTH2,FormatDate('d M',strtotime($item['DATE_ACTIVE_FROM']))));
                            }else{
                                echo ucwords(str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH,FormatDate('d M',strtotime($item['DATE_ACTIVE_FROM']))));
                            }
                            ?>
                        </div>
                        <div class="diveinPage__blog-item__media">
                            <div class="diveinPage__blog-item__photo">
                                <?if($item['PREVIEW_PICTURE']){?>
                                    <img src="<?=CFile::GetPath($item['PREVIEW_PICTURE'])?>" alt="">
                                <?}?>
                            </div>
                            <?
                            $video = '';
                            if($item['PROPERTY_LINK_VIDEO_VALUE']){
                                $video = $item['PROPERTY_LINK_VIDEO_VALUE'];
                            }elseif($item['PROPERTY_VIDEO_VALUE']){
                                $video = $item['PROPERTY_VIDEO_VALUE'];
                            }
                            ?>
                            <?if($video){?>
                                <div class="diveinPage__blog-item__content">
                                    <div class="diveinPage__blog-item__content-icon">
                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.697443 15.4545V0.90909L13.1861 8.18182L0.697443 15.4545Z" fill="white"/>
                                        </svg>
                                    </div>
                                    <div class="diveinPage__blog-item__content-time"><?=$item['PROPERTY_TIME_VALUE']?></div>
                                </div>
                            <?}?>
                        </div>
                        <div class="diveinPage__blog-item__title"><?=$item['NAME']?></div>
                    </div>
                    <div class="diveinPage__blog-item__more hoverMe" data-attr="<?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?>"><?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?></div>
                </a>
            <?}?>
        </div>
    </div>
    <?if($block['link']['value']){?>
		<div>
			<a href="<?=$block['link']['value']?>" class="button diveinPage__wrap-button hoverMe _mobile" data-attr="<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>">
				<?=str_replace(["<p>","</p>"],"",$block['text_botton']['value'])?>
			</a>
		</div>
    <?}?>
</div>
