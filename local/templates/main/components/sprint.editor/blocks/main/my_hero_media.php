<? /** @var $block array */?>
<div class="projectHero__media">
    <div class="container">
        <div class="indexSection3__sections">
            <div class="indexSection3__section-wrap">
                <?foreach ($block['images'] as $image){?>
					<?if($image['file']['ORIGIN_SRC']){?>
                        <section class="indexSection3__section projectHero__media-section">
                            <div class="projectHero__media-photo">
                                <img src="<?=$image['file']['ORIGIN_SRC']?>" alt="">
                            </div>
                        </section>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>
