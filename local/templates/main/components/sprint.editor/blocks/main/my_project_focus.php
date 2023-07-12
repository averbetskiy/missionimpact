<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_project_focus_text'){
        $blockText = $item;
    }else if($item['name'] == 'my_project_focus_item'){
        $blockItems[] = $item;
    }
}
?>
<div class="focus">
    <div class="container">
        <?if($blockText['htag_result']['value']){?>
            <p class="index__heading __multiply"><?=$blockText['htag_result']['value']?></p>
        <?}?>
        <?if($blockText['text_result']['value']){?>
            <div class="heading__columns-title"><?=$blockText['text_result']['value']?></div>
        <?}?>
        <div class="focus__list">
            <?foreach ($blockItems as $item){?>
                <div class="focus__item">
                    <div class="focus__item-number">
                        <?if($item['digit1']['files'][0]['file']['SRC']){?>
                            <img src="<?=$item['digit1']['files'][0]['file']['SRC']?>">
                        <?}?>
                    </div>
                    <div class="focus__item-text">
                        <?=$item['title1']['value']?>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>
