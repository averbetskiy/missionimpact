<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_project_features_text'){
        $blockText = $item;
    }else if($item['name'] == 'my_poject_features_item'){
        $blockItems[] = $item;
    }
}
?>
<div class="projectFeatures">
    <div class="container">
        <?if($blockText['htag_result']['value']){?>
            <<?=$blockText['htag_result']['type']?> class="index__heading __multiply"><?=$blockText['htag_result']['value']?></<?=$blockText['htag_result']['type']?>>
        <?}?>
		<?if($blockText['text_result']['value']){?>
			<div class="heading__columns">
				<div class="heading__columns-title"><?=$blockText['text_result']['value']?></div>
			</div>
		<?}?>
    <?foreach ($blockItems as $item){?>
        <div class="projectFeatures__list">
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$item['digit1']['value']?></div>
                <div class="projectFeatures__item-text"><?=$item['title1']['value']?></div>
            </div>
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$item['digit2']['value']?></div>
                <div class="projectFeatures__item-text"><?=$item['title2']['value']?></div>
            </div>
            <div class="projectFeatures__item">
                <div class="projectFeatures__item-digit"><?=$item['digit3']['value']?></div>
                <div class="projectFeatures__item-text"><?=$item['title3']['value']?></div>
            </div>
        </div>
    <?}?>
</div>
</div>
