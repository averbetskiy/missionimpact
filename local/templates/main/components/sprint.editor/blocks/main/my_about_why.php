<? /** @var $block array */?>
<div class="aboutWhy">
    <div class="aboutWhy__wrap">
        <div class="aboutWhy__media">
            <?if($block['image']['file']['ORIGIN_SRC']){?>
                <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
            <?}?>
        </div>
        <div class="aboutWhy__content">
            <div class="aboutWhy__content-top">
                <?=$block['title']['value']?>
            </div>
            <div class="aboutWhy__content-bottom">
                <div class="aboutWhy__content-wrap">
                    <div class="aboutWhy__content-item">
                        <div class="aboutWhy__content-title"><?=$block['title1']['value']?></div>
                        <div class="aboutWhy__content-text"><?=$block['text1']['value']?></div>
                    </div>
                    <div class="aboutWhy__content-item">
                        <div class="aboutWhy__content-title"><?=$block['title2']['value']?></div>
                        <div class="aboutWhy__content-text"><?=$block['text2']['value']?></div>
                    </div>
                    <div class="aboutWhy__content-item">
                        <div class="aboutWhy__content-title"><?=$block['title3']['value']?></div>
                        <div class="aboutWhy__content-text"><?=$block['text3']['value']?></div>
                    </div>
                </div>
                <div class="aboutWhy__content-info">
                    <?=$block['text_bottom']['value']?>
                </div>
            </div>
        </div>
        <div class="aboutWhy__content-mobile">
            <div class="aboutWhy__content-wrap">
                <div class="aboutWhy__content-item">
                    <div class="aboutWhy__content-title"><?=$block['title1']['value']?></div>
                    <div class="aboutWhy__content-text"><?=$block['text1']['value']?></div>
                </div>
                <div class="aboutWhy__content-item">
                    <div class="aboutWhy__content-title"><?=$block['title2']['value']?></div>
                    <div class="aboutWhy__content-text"><?=$block['text2']['value']?></div>
                </div>
                <div class="aboutWhy__content-item">
                    <div class="aboutWhy__content-title"><?=$block['title3']['value']?></div>
                    <div class="aboutWhy__content-text"><?=$block['text3']['value']?></div>
                </div>
                <div class="aboutWhy__content-info"><?=$block['text_bottom']['value']?></div>
            </div>

        </div>
    </div>
</div>
