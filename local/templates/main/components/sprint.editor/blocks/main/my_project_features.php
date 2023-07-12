<? /** @var $block array */?>

<div class="projectFeatures">
    <div class="container">
        <?if($block['htag_result']['value']){?>
            <<?=$block['htag_result']['type']?> class="index__heading __multiply"><?=$block['htag_result']['value']?></<?=$block['htag_result']['type']?>>
        <?}?>
		<?if($block['text_result']['value']){?>
			<div class="heading__columns">
				<div class="heading__columns-title"><?=$block['text_result']['value']?></div>
			</div>
		<?}?>
        <div class="projectFeatures__list">
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$block['digit1']['value']?></div>
                <div class="projectFeatures__item-text"><?=$block['title1']['value']?></div>
            </div>
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$block['digit2']['value']?></div>
                <div class="projectFeatures__item-text"><?=$block['title2']['value']?></div>
            </div>
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$block['digit3']['value']?></div>
                <div class="projectFeatures__item-text"><?=$block['title3']['value']?></div>
            </div>
        </div>
    </div>
</div>