<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_project_text_program'){
        $blockText = $item;
    }else if($item['name'] == 'my_project_item_program'){
        $blockItems[] = $item;
    }
}
?>
<div class="projectProgram">
    <div class="container">
        <div class="projectProgram__wrap">
            <div class="projectProgram__heading">
                <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$blockText['type']['value'])?></p>
				<div class="heading__columns-title"><?=$blockText['title']['value']?></div>
                <div class="heading__columns-subtitle">
                    <?if($blockText['link']['value']){?>
                        <a href="<?=$blockText['link']['value']?>" class="hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$blockText['text_button']['value'])?>"><?=$blockText['text_button']['value']?></a>
                    <?}?>
                </div>
            </div>
            <div class="projectProgram__list">
                <?foreach ($blockItems as $item){?>
                    <div class="projectProgram__item <?if($item['desc_detail']['value']){?>__existText<?}?>">
                        <div class="projectProgram__item-type"><?=$item['type']['value']?></div>
                        <?php if ($item['link']['value'] != ""): ?>
                        	<a href="<?=$item['link']['value'];?>" data-attr="<?=strip_tags($item['title']['value'])?>" class="projectProgram__item-title hoverMe">
								<?=$item['title']['value']?>
							</a>
						<?php else: ?>
							<div class="projectProgram__item-title">
								<?=$item['title']['value']?>
							</div>
						<?php endif; ?>
                        <div class="projectProgram__item-desc"><?=$item['desc']['value']?></div>
                        <div class="projectProgram__item-text">
                            <?=$item['desc_detail']['value']?>
                        </div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
