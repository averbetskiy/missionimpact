<? /** @var $block array */?>
<div class="aboutGroup">
    <div class="aboutGroup__wrap">
        <div class="aboutGroup__content">
            <div class="aboutGroup__top">
                <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
                <div class="heading__columns-title"><?=$block['title']['value']?></div>
                <div class="aboutGroup__text"><?=$block['text']['value']?></div>
            </div>
            <div class="aboutGroup__bottom">
                <?if($block['link']['value']){?>
                    <a href="<?=$block['link']['value']?>" class="button"><?=$block['text_button']['value']?></a>
                <?}?>
            </div>
        </div>
        <div class="aboutGroup__animation">
            <div class="aboutGroup__animation-wrap">
                <div class="aboutGroup__animation-list" data-type="one">
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/1.png" alt="">
                    </div>
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/2.png" alt="">
                    </div>
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/3.png" alt="">
                    </div>
                </div>
                <div class="aboutGroup__animation-list" data-type="two">
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/5.png" alt="">
                    </div>
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/4.png" alt="">
                    </div>
                    <div class="aboutGroup__animation-item">
                        <img src="img/about/peoples/2.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
