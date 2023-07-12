<? /** @var $block array */?>
<div class="indexSection1">
    <div class="container">
        <div class="indexSection1__wrap">
            <div class="indexSection1__left">
                <div class="indexSection1__content">
                    <?if($block['name_block']['value']){?>
                        <<?=$block['name_block']['type']?> class="index__heading"><?=$block['name_block']['value']?></<?=$block['name_block']['type']?>>
                    <?}?>
                    <?if($block['title']['value']){?>
                        <<?=$block['title']['type']?> class="indexSection1__title">
                            <?=$block['title']['value']?>
                        </<?=$block['title']['type']?>>
                    <?}?>
                    <?if($block['link']['value']){?>
                        <a href="<?=$block['link']['value']?>" data-attr="<?=strip_tags($block['text_button']['value']);?>" class="button hoverMe"><?=$block['text_button']['value']?></a>
                    <?}?>
                </div>
                <div class="indexSection1__team">
                    <div class="indexSection1__team-title"><?=$block['title_bottom']['value']?></div>
                    <div class="indexSection1__team-list">
                        <div class="indexSection1__team-item">
                            <div class="indexSection1__team_item-title"><?=$block['title1']['value']?></div>
                            <div class="indexSection1__team_item-type"><?=$block['type1']['value']?></div>
                        </div>
                        <div class="indexSection1__team-item">
                            <div class="indexSection1__team_item-title"><?=$block['title2']['value']?></div>
                            <div class="indexSection1__team_item-type"><?=$block['type2']['value']?></div>
                        </div>
                        <div class="indexSection1__team-item">
                            <div class="indexSection1__team_item-title"><?=$block['title3']['value']?></div>
                            <div class="indexSection1__team_item-type"><?=$block['type4']['value']?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="indexSection1__right">
                <div class="indexSection1__right-media">
                    <?if($block['image']['file']['ORIGIN_SRC']){?>
                        <?if($block['image']['file']['ORIGIN_SRC']){?>
                            <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                        <?}?>
                    <?}?>
                </div>
                <div class="indexSection1__right-content">
                    <?=$block['image_text']['value']?>
                </div>
            </div>
        </div>
    </div>
</div>
