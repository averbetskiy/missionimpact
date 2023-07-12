<? /** @var $block array */?>
<div class="divein__hero">
    <div class="divein__hero-media">
        <?if($block['image']['file']['ORIGIN_SRC']){?>
            <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
        <?}?>
    </div>
    <div class="divein__hero-content">
        <div class="divein__hero-content__top">
            <div class="divein__hero-content__title"><?=$block['title']['value']?></div>
            <div class="divein__hero-content__time"><?=$block['subtitle']['value']?></div>
        </div>
        <div class="divein__hero-content__bottom">
            <?if($block['link']['value']){?>
                <a href="<?=$block['link']['value']?>" class="divein__hero-content__button hoverMe" data-attr="<?=$block['text_link']['value']?>"><?=$block['text_link']['value']?></a>
            <?}?>
        </div>
    </div>
</div>
