<? /** @var $block array */?>
<?
$arPartners = [];
$arSelectPartners = ['ID','NAME','DETAIL_PICTURE'];
$arFilterPartners = ['IBLOCK_ID' => $block['iblock_id'],'ID' => $block['element_ids']];
$resPartners = CIblockElement::GetList(["ID" => $block['element_ids']], $arFilterPartners, false, [], $arSelectPartners);
while ($obPartners = $resPartners->GetNextElement()) {
    $arPartners[] = $obPartners->GetFields();
}
?>
<div class="projectLogos" style="display:none">
    <div class="projectLogos__wrap" data-count="<?php echo count($arPartners); ?>">
        <?foreach ($arPartners as $partner){?>
            <?if($partner['DETAIL_PICTURE']){?>
                <div class="projectLogos__item">
                    <img src="<?=CFile::GetPath($partner['DETAIL_PICTURE'])?>" alt="<?=$partner['NAME']?>">
                </div>
            <?}?>
        <?}?>
    </div>
</div>

<div class="brand-sliders">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?foreach ($arPartners as $partner){?>
				 <?if($partner['DETAIL_PICTURE']){?>
					<div class="brand-slider swiper-slide">
						<div class="brand-slider__img">
							<img src="<?=CFile::GetPath($partner['DETAIL_PICTURE'])?>" alt="<?=$partner['NAME']?>">
						</div>
					</div>
				<?}?>
			<?}?>
		</div>
	</div>
</div>
