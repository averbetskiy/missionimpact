<? /** @var $block array */?>
<?
$blockText = [];
$blockItems = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'text'){
        $blockText = $item;
    }else if($item['name'] == 'my_courses_about_list'){
        $blockItems[] = $item;
    }
}
?>
<div class="container">
    <div class="pageCourse__about">
        <div class="pageCourse__about-title"><?=$blockText['value']?></div>
        <div class="pageCourse__about-content">
            <?foreach ($blockItems as $item){?>
                <div class="pageCourse__about-section">
                    <div class="pageCourse__about-section__title"><?=$item['title']['value']?></div>
                    <div class="pageCourse__about-section__list">
                        <?=$item['text']['value']?>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
</div>
