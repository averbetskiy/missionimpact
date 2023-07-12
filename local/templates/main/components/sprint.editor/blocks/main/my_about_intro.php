<? /** @var $block array */?>
<div class="aboutIntro">
    <p class="index__heading"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
    <div class="heading__columns">
        <?if($block['htag']['value']){?>
            <<?=$block['htag']['type']?> class="heading__columns-title"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
        <?}?>
        <div class="heading__columns-subtitle">
            <?=$block['desc']['value']?>
        </div>
    </div>
</div>
