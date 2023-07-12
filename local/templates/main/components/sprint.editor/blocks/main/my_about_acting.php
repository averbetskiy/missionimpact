<? /** @var $block array */?>
<div class="aboutActing">
    <div class="heading__columns-title"><?=$block['text']['value']?></div>
    <div class="aboutActing__list">
        <?if($block['image1']['file']['ORIGIN_SRC']){?>
            <div class="aboutActing__item">
                <div class="aboutActing__item-media">
                    <img src="<?=$block['image1']['file']['ORIGIN_SRC']?>" alt="">
                </div>
                <div class="aboutActing__item-content">
                    <?=$block['text1']['value']?>
                </div>
            </div>
        <?}?>
        <?if($block['image2']['file']['ORIGIN_SRC']){?>
            <div class="aboutActing__item">
                <div class="aboutActing__item-media">
                    <img src="<?=$block['image2']['file']['ORIGIN_SRC']?>" alt="">
                </div>
                <div class="aboutActing__item-content">
                    <?=$block['text2']['value']?>
                </div>
            </div>
        <?}?>
        <?if($block['image3']['file']['ORIGIN_SRC']){?>
            <div class="aboutActing__item">
                <div class="aboutActing__item-media">
                    <img src="<?=$block['image3']['file']['ORIGIN_SRC']?>" alt="">
                </div>
                <div class="aboutActing__item-content">
                    <?=$block['text3']['value']?>
                </div>
            </div>
        <?}?>
    </div>
</div>
