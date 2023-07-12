<? /** @var $block array */?>
<div class="aboutCreate__wrap">
    <div class="aboutCreate__left">
        <div class="aboutCreate__left-top">
            <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
            <div class="heading__columns-title"><?=$block['title']['value']?></div>
        </div>
        <div class="aboutCreate__left-bottom">
            <div class="heading__columns-subtitle">
                <?if($block['link']['value']){?>
                    <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
                <?}?>
            </div>
        </div>
    </div>
    <div class="aboutCreate__right">
        <div class="aboutCreate__right-wrap">
            <div class="aboutCreate__right-digit"><?=$block['digit']['value']?></div>
            <div class="aboutCreate__right-info"><?=$block['info']['value']?></div>
        </div>
    </div>
</div>
