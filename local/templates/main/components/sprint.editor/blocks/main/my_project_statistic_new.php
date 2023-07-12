<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_about_text_statistic'){
        $blockText = $item;
    }else if($item['name'] == 'my_about_item_statistic'){
        $blockItems[] = $item;
    }
}
?>
<div class="aboutBenefit">
    <div class="container">
        <div class="aboutBenefit__wrap">
            <div class="aboutBenefit__left">
                <div class="aboutBenefit__left-top">
                    <p class="index__heading __multiply"><?=$blockText['name_block']['value']?></p>
                    <div class="heading__columns-title"><?=$blockText['title']['value']?></div>
                </div>
                <div class="aboutBenefit__left-bottom"><?=$blockText['text_bottom']['value']?></div>
            </div>
            <div class="aboutBenefit__right">
                <?foreach ($blockItems as $item){?>
                    <div class="aboutBenefit__right-item">
                        <div class="aboutBenefit__right-digit"><?=$item['digit']['value']?></div>
                        <div class="aboutBenefit__right-title"><?=$item['title']['value']?></div>
                        <div class="aboutBenefit__right-text"><?=$item['text']['value']?></div>
                    </div>
                <?}?>
            </div>
            <div class="aboutBenefit__left-bottom _mobile"><?=$blockText['text_bottom']['value']?></div>
        </div>
    </div>
</div>
