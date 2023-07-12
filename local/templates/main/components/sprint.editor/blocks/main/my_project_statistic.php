<? /** @var $block array */?>
<div class="aboutBenefit">
    <div class="container">
        <div class="aboutBenefit__wrap">
            <div class="aboutBenefit__left">
                <div class="aboutBenefit__left-top">
                    <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
                    <div class="heading__columns-title"><?=$block['title']['value']?></div>
                </div>
                <div class="aboutBenefit__left-bottom"><?=$block['desc']['value']?></div>
            </div>
            <div class="aboutBenefit__right">
                <div class="aboutBenefit__right-item">
                    <div class="aboutBenefit__right-digit"><?=$block['digit1']['value']?></div>
                    <div class="aboutBenefit__right-title"><?=$block['title1']['value']?></div>
                    <div class="aboutBenefit__right-text"><?=$block['text1']['value']?></div>
                </div>
                <div class="aboutBenefit__right-item">
                    <div class="aboutBenefit__right-digit"><?=$block['digit2']['value']?></div>
                    <div class="aboutBenefit__right-title"><?=$block['title2']['value']?></div>
                    <div class="aboutBenefit__right-text"><?=$block['text2']['value']?></div>
                </div>
            </div>
            <div class="aboutBenefit__left-bottom _mobile"><?=$block['desc']['value']?></div>
        </div>
    </div>
</div>
