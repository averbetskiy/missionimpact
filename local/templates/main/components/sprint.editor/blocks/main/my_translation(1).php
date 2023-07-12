<? /** @var $block array */?>
<div class="projectHero__media-wrap">
    <div class="container">
        <div class="projectHero__media">
            <div class="projectHero__media-video" data-cursor="swipe">
                <div class="projectHero__media_video-photo">
                    <?if($block['image']['file']['ORIGIN_SRC']){?>
                        <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                    <?}?>
                </div>
                <div class="projectHero__media_video-content">
                    <div class="projectHero__media_video-content__title"><?=$block['text']['value']?></div>
                    <div class="projectHero__media_video-content__subtitle"><?=$block['desc']['value']?></div>
                </div>
            </div>
        </div>
    </div>
</div>
