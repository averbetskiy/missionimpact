<? /** @var $block array */?>
<div class="aboutLeaders__wrap">
    <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
    <div class="heading__columns">
        <div class="heading__columns-title"><?=$block['title']['value']?></div>
        <div class="heading__columns-subtitle"><?=$block['sub_title']['value']?></div>
    </div>
    <?if($block['link']['value']){?>
        <a href="<?=$block['link']['value']?>" class="button hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
    <?}?>
</div>
