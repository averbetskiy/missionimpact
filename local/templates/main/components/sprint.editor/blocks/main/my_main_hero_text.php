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
		<?php
			$attrDataCursor = "";
			if ($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'] || $block['text_external']["value"] || $block['iframeVideo']["value"]):
				$attrDataCursor = ' data-cursor="swipe"';
			elseif ($block['text_internal']['value']):
				$attrDataCursor = ' data-cursor="more"';
			else:
				$attrDataCursor = '';
			endif;
		?>
		<div class="hero__media"<?=$attrDataCursor;?>>
			<?php if ($block['text_external']["value"] || $block['text_internal']["value"]) { ?>
				<?php
					if ($block['text_external']["value"]):
						$hrefAttr = $block['text_external']["value"];
						$external = true;
					else:
						$hrefAttr = $block['text_internal']["value"];
						$external = false;
					endif;
				?>
				<a href="<?=$hrefAttr;?>" <?php if ($external): ?>target="_blank"<?php endif; ?> class="hero__media-iframe hero__media-video <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'] || $block['iframeVideo']['value'])?'main_video_block':''?>">
					<?if($block['image']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-desktop">
					<?}?>
					<?if($block['imageMobile']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['imageMobile']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-mobile">
					<?}?>
					<?if($block['video']['url']){?>
						<div class="projectHero__media-video">
							<?php $videoLink = str_replace('watch?v=', 'embed/', $block['video']['url']); ?>
							<iframe width="560" height="315" src="<?=$videoLink;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					<?}elseif ($block['video_files']['files'][0]['file']['SRC']){?>
						<div class="projectHero__media-video">
							<video width="480" controls poster="<?=$block['image']['file']['ORIGIN_SRC']?>">
								<source src="<?=$block['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
								Your browser doesn't support HTML5 video tag.
							</video>
						</div>
					<?}elseif ($block['iframeVideo']['value']){?>
						<div class="projectHero__media-video">
							<?=$block['iframeVideo']['value'];?>
						</div>
					<?}?>
				</a>
			<?php } else { ?>
				<div class="hero__media-iframe hero__media-video <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'] || $block['iframeVideo']["value"])?'main_video_block':''?>">
					<?if($block['image']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-desktop">
					<?}?>
					<?if($block['imageMobile']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['imageMobile']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-mobile">
					<?}?>
					<?if($block['video']['url']){?>
						<div class="projectHero__media-video">
							<?php $videoLink = str_replace('watch?v=', 'embed/', $block['video']['url']); ?>
							<iframe width="560" height="315" src="<?=$videoLink;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					<?}elseif ($block['video_files']['files'][0]['file']['SRC']){?>
						<div class="projectHero__media-video">
							<video width="480" controls poster="<?=$block['image']['file']['ORIGIN_SRC']?>">
								<source src="<?=$block['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
								Your browser doesn't support HTML5 video tag.
							</video>
						</div>
					<?}elseif ($block['iframeVideo']['value']){?>
						<div class="projectHero__media-video">
							<?=$block['iframeVideo']['value'];?>
						</div>
					<?}?>
				</div>
			<?php } ?>
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
