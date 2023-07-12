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
                    <a href="<?=$block['link']['value']?>" class="button hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
                <?}?>
            </div>
        </div>
        <div class="aboutGroup__animation">
            <div class="aboutGroup__animation-wrap">
                <div class="aboutGroup__animation-list" data-type="one">
                    <?if($block['images']['images'][0]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][0]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                    <?if($block['images']['images'][1]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][1]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                    <?if($block['images']['images'][2]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][2]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                </div>
                <div class="aboutGroup__animation-list" data-type="two">
                    <?if($block['images']['images'][3]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][3]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                    <?if($block['images']['images'][4]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][4]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                    <?if($block['images']['images'][5]['file']['ORIGIN_SRC']){?>
                        <div class="aboutGroup__animation-item">
                            <img src="<?=$block['images']['images'][5]['file']['ORIGIN_SRC']?>" alt="">
                        </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>
