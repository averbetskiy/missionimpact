<? /** @var $block array */?>
<?
$bgImg = $block['image']['file']['ORIGIN_SRC'];
?>
<div class="projectHero <?if(!$bgImg){?>noBg<?}?>">
    <?if($bgImg){?>
        <div class="projectHero__image">
            <img src="<?=$bgImg?>" alt="">
        </div>
    <?}?>
    <div class="projectHero__wrap">
        <div class="projectHero__top">
            <div class="container">
                <div class="projectHero__header">
                    <div class="projectHero__heading">
                        <h1 class="projectHero__heading-title"><?=$block['text']['value']?></h1>
                        <div class="projectHero__heading-desc">
                            <p><?=$block['desc']['value']?></p>
                        </div>
                    </div>
                    <?if($block['logo']['file']['ORIGIN_SRC']){?>
                        <div class="projectHero__logo">
                            <img src="<?=$block['logo']['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
		<?php if ($block['text_col1']['value'] != "" || $block['text_col2']['value'] != ""): ?>
			<div class="container">
				<div class="projectHero__cols">
					<div class="projectHero__cols-list">
						<div class="projectHero__cols-item"><?=htmlspecialchars_decode($block['text_col1']['value'])?></div>
						<div class="projectHero__cols-item"><?=htmlspecialchars_decode($block['text_col2']['value'])?></div>
					</div>
					<?if($block['link']['value']){?>
						<a href="<?=$block['link']['value']?>" class="projectHero__cols-link hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['name_button']['value'])?>"><?=$block['name_button']['value']?></a>
					<?}?>
				</div>
			</div>
		<?php endif; ?>
    </div>
</div>