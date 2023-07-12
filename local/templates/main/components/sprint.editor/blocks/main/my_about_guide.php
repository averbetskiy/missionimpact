<? /** @var $block array */?>
<div class="aboutGuide">
    <div class="aboutGuide__wrap">
        <div class="aboutGuide__content">
            <div class="aboutGuide__top">
                <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
                <div class="heading__columns-title"><?=$block['title']['value']?></div>
            </div>
            <div class="aboutGuide__bottom">
                <div class="aboutGuide__bottom-logo">
                    <?if($block['image']['file']['ORIGIN_SRC']){?>
                        <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                    <?}?>
                </div>
                <div class="aboutGuide__bottom-title">
                    <?=$block['text']['value']?>
                </div>
                <div class="aboutGuide__bottom-info">
                    <?=$block['info']['value']?>
                </div>
            </div>
        </div>
        <div class="aboutGuide__timeline">
            <div class="aboutGuide__timeline-circle01"></div>
            <div class="aboutGuide__timeline-circle02"></div>
            <div class="aboutGuide__timeline-circle03"></div>
            <div class="aboutGuide__timeline-circle04"></div>
            <div class="aboutGuide__timeline-circle05"></div>
            <div class="aboutGuide__timeline-circle06"></div>
            <div class="aboutGuide__timeline-text01"><?=$block['text1']['value']?></div>
            <div class="aboutGuide__timeline-text02"><?=$block['text2']['value']?> </div>
            <div class="aboutGuide__timeline-text03"><?=$block['text3']['value']?></div>
            <div class="aboutGuide__timeline-text04"><?=$block['text4']['value']?></div>
            <div class="aboutGuide__timeline-text05"><?=$block['text5']['value']?></div>
            <div class="aboutGuide__timeline-text06"><?=$block['text6']['value']?></div>
            <div class="aboutGuide__timeline-hr"></div>
        </div>
    </div>
</div>