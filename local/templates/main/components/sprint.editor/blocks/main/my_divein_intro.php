<? /** @var $block array */?>
<div class="divein__intro">
    <?if($block['name_block']['value']){?>
        <<?=$block['name_block']['type']?> class="index__heading __multiply"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
    <?}?>
    <div class="heading__columns">
        <?if($block['htag']['value']){?>
            <<?=$block['htag']['type']?> class="heading__columns-title"><?=$block['htag']['value']?></<?=$block['htag']['type']?>>
        <?}?>
        <div class="heading__columns-subtitle">
            <?=$block['desc']['value']?>
        </div>
    </div>
</div>
