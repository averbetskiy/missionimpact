<? /** @var $block array */?>
<?$bgImg = $block['image']['file']['ORIGIN_SRC'];?>
<div class="aboutHero">
    <div class="aboutHero__media">
        <?if($bgImg){?>
            <img src="<?=$bgImg?>" alt="">
        <?}?>
    </div>
    <div class="aboutHero__content">
        <?=$block['text']['value']?>
    </div>
</div>
