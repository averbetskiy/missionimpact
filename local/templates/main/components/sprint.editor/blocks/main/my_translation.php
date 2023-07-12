<? /** @var $block array */?>
<?php
	$idBlock = "";
	if ($block['anchor']['value']):
		$idBlock = "id='anchor_".$block['anchor']['value']."'";
	endif;
?>
<div class="projectHero__media-wrap"<?=$idBlock;?>>
    <div class="container">
        <div class="hero__media" <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'] || $block['text_external']["value"] || $block['iframeVideo']['value'])?'data-cursor="swipe"':''?>>
			<?php if ($block['text_external']["value"]) { ?>
				<a href="<?=$block['text_external']["value"];?>" target="_blank" class="hero__media-iframe hero__media-video <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'])?'main_video_block':''?>">
					<?if($block['image']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-desktop">
					<?}?>
					<?if($block['imageMobile']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['imageMobile']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-mobile">
					<?}?>
				</a>
			<?php } else { ?>
				<div class="hero__media-iframe hero__media-video <?=($block['video']['url'] || $block['video_files']['files'][0]['file']['SRC'] || $block['iframeVideo']['value'])?'main_video_block':''?>">
					<?if($block['image']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-desktop">
					<?}?>
					<?if($block['imageMobile']['file']['ORIGIN_SRC']){?>
						<img src="<?=$block['imageMobile']['file']['ORIGIN_SRC']?>" alt="" class="hero__media-photo-mobile">
					<?}?>
					<?if($block['video']['url']){?>
						<?php $videoLink = str_replace('watch?v=', 'embed/', $block['video']['url']); ?>
						<div class="projectHero__media-video">
							<iframe width="560" height="315" src="<?=$videoLink;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
					<?}elseif ($block['video_files']['files'][0]['file']['SRC']){?>
						<div class="projectHero__media-video">
							<video width="480" controls poster="<?=$block['image']['file']['ORIGIN_SRC']?>">
								<source src="<?=$block['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
								Your browser doesn't support HTML5 video tag.
							</video>
						</div>
					<?}elseif ($block['iframeVideo']['value']) {?>
						<div class="projectHero__media-video">
							<?=$block['iframeVideo']['value'];?>
						</div>
					<?}?>
				</div>
			<?php } ?>
		</div>
    </div>
</div>
