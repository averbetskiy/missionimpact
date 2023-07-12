<? /** @var $block array */?>
<div class="projectHero__media">
    <div class="container">
        <div class="indexSection3__sections">
            <div class="indexSection3__section-wrap">
                <?foreach ($block['blocks'] as $item){?>
                    <?if($item['image']['file']['ORIGIN_SRC'] && ($item['video']['url'] || $item['video_files']['files'][0]['file']['SRC'])){?>
                        <section class="indexSection3__section projectHero__media-section">
                            <div class="projectHero__media-photo" data-cursor="swipe">
                                <img src="<?=$item['image']['file']['ORIGIN_SRC']?>" alt="">
                            </div>
                            <div class="projectHero__media-video">
                                <?if($item['video']['url']){?>
                                    <iframe width="560" height="315" src="<?=$item['video']['url']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <?}else{?>
                                    <video width="480" controls poster="<?=$item['image']['file']['ORIGIN_SRC']?>">
                                        <source src="<?=$item['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
                                        Your browser doesn't support HTML5 video tag.
                                    </video>
                                <?}?>
                            </div>
                        </section>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>
