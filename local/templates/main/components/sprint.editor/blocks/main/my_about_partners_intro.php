<? /** @var $block array */?>
<div class="aboutPartners__intro">
    <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
    <div class="heading__columns">
        <?if($block['htag']['value']){?>
            <<?=$block['htag']['type']?> class="heading__columns-title"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
        <?}?>
        <div class="heading__columns-subtitle">
            <?=$block['sub_title']['value']?>
        </div>
    </div>
</div>
