<? /** @var $block array */?>
<?
$arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME","PREVIEW_PICTURE","PROPERTY_CITY","PROPERTY_POST","PREVIEW_TEXT"];
$arFilter = ["IBLOCK_ID" => $block['speakers']['iblock_id']];
if($block['speakers']['element_ids']){
    $arFilter['ID'] = $block['speakers']['element_ids'];
}
$res = CIblockElement::GetList(["ID" => $block['speakers']['element_ids']], $arFilter, false, [], $arSelect);
while ($ob = $res->GetNextElement()) {
    $arSpeakers[] = $ob->GetFields();
}
?>
<div class="projectSpeakers2">
    <div class="container">
        <?if($block['htag']['value']){?>
            <<?=$block['htag']['type']?> class="index__heading __multiply"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
        <?}?>
        <div class="heading__columns __top">
            <div class="heading__columns-title"><?=$block['text']['value']?></div>
            <div class="heading__columns-subtitle"><?=$block['desc']['value']?></div>
        </div>
		<?php if ($arSpeakers): ?>
			<div class="projectSpeakers2__list">
				<?foreach ($arSpeakers as $speaker){?>
					<div class="projectSpeakers2__item<?if($speaker['PREVIEW_TEXT']){?> projectSpeakers2__item-preview<?}?>">
						<div class="projectSpeakers2__item-photo">
							<img src="<?=CFile::GetPath($speaker['PREVIEW_PICTURE'])?>" alt="<?=$speaker['NAME']?>">
						</div>
						<div class="projectSpeakers2__item-content">
							<div class="projectSpeakers2__item-content__main">
								<div class="projectSpeakers2__item-name"><?=$speaker['NAME']?></div>
								<div class="projectSpeakers2__item-post"><?=$speaker['PROPERTY_POST_VALUE']?></div>
								<div class="projectSpeakers2__item-city"><?=$speaker['PROPERTY_CITY_VALUE']?></div>
							</div>
							<?if($speaker['PREVIEW_TEXT']){?>
								<div class="projectSpeakers2__item-content__hover">
									<?=$speaker['PREVIEW_TEXT']?>
								</div>
							<?}?>
						</div>
					</div>
				<?}?>
			</div>
		<?php endif; ?>
    </div>
</div>