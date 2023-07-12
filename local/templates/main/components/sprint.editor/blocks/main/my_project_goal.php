<? /** @var $block array */?>
<div class="projectGoal">
    <div class="container">
        <?if($block['htag']['value']){?>
            <<?=$block['htag']['type']?> class="index__heading __multiply"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
        <?}?>
        <div class="heading__columns __top">
            <div class="heading__columns-title"><?=$block['text']['value']?></div>
            <div class="heading__columns-subtitle"><?=$block['desc']['value']?></div>
        </div>
    </div>
    <?if($block['images']['images']){?>
        <div class="projectGoal__list-wrap">
            <div class="projectGoal__list">
                <?foreach ($block['images']['images'] as $image){?>
					<?php
						$originImage = $image['file'];
						$resize_image = CFile::ResizeImageGet($originImage['ID'],
						Array("width" => 802, 'height' => 802),
						BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false);
						?> 
                    <a href="<?=$originImage['ORIGIN_SRC'];?>" class="projectsGoal__item" data-fancybox="loop"><img src="<?=$resize_image['src'];?>"/></a>
                <?}?>
				<?php if (count($block['images']['images']) < 4): ?>
					<?foreach ($block['images']['images'] as $image){?>
					<?php
						$originImage = $image['file'];
						$resize_image = CFile::ResizeImageGet($originImage['ID'],
						Array("width" => 802, "height" => 480),
						BX_RESIZE_IMAGE_EXACT, false);
						?> 
						<a href="<?=$originImage;?>" class="projectsGoal__item"><img src="<?=$resize_image['src'];?>"/></a>
					<?}?>
				<?php endif; ?>
            </div>
        </div>
    <?}?>
</div>