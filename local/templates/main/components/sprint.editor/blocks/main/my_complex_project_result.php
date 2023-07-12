<? /** @var $block array */?>


<div class="projectResult">
    <div class="container">
        <?if($block['htag_result']['value']){?>
            <<?=$block['htag_result']['type']?> class="index__heading __multiply"><?=$block['htag_result']['value']?></<?=$block['htag_result']['type']?>>
        <?}?>
        <div class="heading__columns">
            <div class="heading__columns-title"><?=$block['text_result']['value']?></div>
        </div>
        <div class="projectResult__list">
            <div class="projectResult__item">
                <div class="projectResult__item-wrap">
                    <div class="projectResult__item-digit"><?=$block['digit1']['value']?></div>
                    <div class="projectResult__item-title"><?=$block['title1']['value']?></div>
                </div>
            </div>
            <div class="projectResult__item">
                <div class="projectResult__item-wrap">
                    <div class="projectResult__item-digit"><?=$block['digit2']['value']?></div>
                    <div class="projectResult__item-title"><?=$block['title2']['value']?></div>
                </div>
            </div>
            <div class="projectResult__item">
                <div class="projectResult__item-wrap">
                    <div class="projectResult__item-digit"><?=$block['digit3']['value']?></div>
                    <div class="projectResult__item-title"><?=$block['title3']['value']?></div>
                </div>
            </div>
        </div>
    </div>
</div>