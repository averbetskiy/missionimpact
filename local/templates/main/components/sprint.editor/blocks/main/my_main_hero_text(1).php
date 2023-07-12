<? /** @var $block array */?>
<?
global $arHandBook;
$arHandBook = Highload::getList(HL_HANDBOOK);
if($block['event']['iblock_id']) {
    $arItem = [];
    $arFilter = [];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","DATE_ACTIVE_FROM"];
    $arFilter = ["IBLOCK_ID" => $block['event']['iblock_id']];
    if($block['event']['element_ids']){
        $arFilter['ID'] = $block['event']['element_ids'];
    }else{
        $arFilter['>DATE_ACTIVE_FROM'] = [false, ConvertTimeStamp(false, "FULL")];
    }
    $res = CIblockElement::GetList(["ACTIVE_FROM" => "ASC"], $arFilter, false, ["nPageSize"=>3], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
    }
}
?>

<div class="hero">
    <div class="container">
        <div class="hero__text hero__text-multi">
            <?=$block['text']['value']?>
        </div>
        <div class="hero__text hero__text-mob">
            <?=$block['text_mob']['value']?>
        </div>
        <div class="hero__media" <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'])?'data-cursor="swipe"':''?>>
            <div class="hero__media-iframe hero__media-video <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'])?'main_video_block':''?>">
                <?if($block['image']['file']['ORIGIN_SRC']){?>
                    <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                <?}?>
                <?if($block['video']['url']){?>
                    <div class="projectHero__media-video">
                        <iframe width="560" height="315" src="<?=$block['video']['url']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                <?}elseif ($block['video_files']['files'][0]['file']['SRC']){?>
                    <div class="projectHero__media-video">
                        <video width="480" controls poster="<?=$block['image']['file']['ORIGIN_SRC']?>">
                            <source src="<?=$block['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
                            Your browser doesn't support HTML5 video tag.
                        </video>
                    </div>
                <?}?>
            </div>
            <div class="hero__media-content">
                <div class="hero__media-list">
                    <?$i = 0;?>
                    <?foreach ($arItem as $item){?>
                        <div class="hero__media-item">
							<div class="hero__media_item-type">
								<?php //=($i == 0)?$arHandBook['TEXT_UPCOMING_EVENT']['UF_VALUE']:$arHandBook['TEXT_NEXT_EVENT']['UF_VALUE'];?>
								<?php
									if($_COOKIE['mi_lang'] == 's1') {
										echo $arHandBook['INDEX_HERO_DATE']['UF_TEXT_EN'];
									} else {
										echo $arHandBook['INDEX_HERO_DATE']['UF_TEXT_RU'];
									}
								?>
							</div>
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" data-cursor="noType" class="hero__media_item-title hoverMe" data-attr="<?=$item['NAME']?>">
                                <?=$item['NAME']?>
                            </a>
                            <div class="hero__media_item-date">
                                <?
                                if($_COOKIE['mi_lang'] == 's2') {
                                    $date = FormatDate('d M', strtotime($item['ACTIVE_FROM']));
                                }else{
                                    $date = str_replace(RU_SHORT_MONTH, EN_SHORT_MONTH, FormatDate('d M', strtotime($item['ACTIVE_FROM'])));
                                }
                                ?>
                                <a href="<?=$item['DETAIL_PAGE_URL']?>" data-cursor="noType" class="hoverMe" data-attr="\ <?php echo $date?> →">\ <?php echo $date?> →</a>
                            </div>
                        </div>
                        <?$i++;?>
                    <?}?>
                </div>

            </div>

        </div>
        <div class="hero__media-list_mob">
            <?$i = 0;?>
            <?foreach ($arItem as $item){?>
                <div class="hero__media-item">
                    <div class="hero__media_item-type"><?=($i == 0)?$arHandBook['TEXT_UPCOMING_EVENT']['UF_VALUE']:$arHandBook['TEXT_NEXT_EVENT']['UF_VALUE']?></div>
                    <div class="hero__media_item-title">
                        <a href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
                    </div>
                    <div class="hero__media_item-date">
                        <?
                        if($_COOKIE['mi_lang'] == 's2') {
                            $date = FormatDate('d M', strtotime($item['ACTIVE_FROM']));
                        }else{
                            $date = str_replace(RU_SHORT_MONTH, EN_SHORT_MONTH, FormatDate('d M', strtotime($item['ACTIVE_FROM'])));
                        }
                        ?>
                        <a href="<?=$item['DETAIL_PAGE_URL']?>">\ <?=$date?> →</a>
                    </div>
                </div>
                <?$i++;?>
            <?}?>
        </div>
    </div>
</div>
