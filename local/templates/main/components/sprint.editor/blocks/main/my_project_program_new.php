<? /** @var $block array */?>
<?
$arItem = [];
if($block['events']['element_ids']) {
    $sort = ['ID' => 'DESC'];
    $arSelect = ["ID", "IBLOCK_ID", "CODE", "NAME", "DETAIL_PAGE_URL","PREVIEW_TEXT","DETAIL_TEXT","PROPERTY_type"];
    $arFilter = ["IBLOCK_ID" => $block['events']['iblock_id']];
    if($block['events']['element_ids']){
        $arFilter['ID'] = $block['events']['element_ids'];
        $sort = ["ID" => $block['events']['element_ids']];
    }
    $res = CIblockElement::GetList($sort, $arFilter, false, [], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arItem[] = $ob->GetFields();
    }
}
?>
<div class="projectProgram">
    <div class="container">
        <div class="projectProgram__wrap">
            <div class="projectProgram__heading">
                <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['type']['value'])?></p>
                <div class="heading__columns-title"><?=$block['title']['value']?></div>
                <div class="heading__columns-subtitle">
                    <?if($block['link']['value']){?>
                        <a href="<?=$block['link']['value']?>" class="hoverMe" data-attr="<?=str_replace(['<p>','</p>'],"",$block['text_button']['value'])?>"><?=$block['text_button']['value']?></a>
                    <?}?>
                </div>
            </div>
            <div class="projectProgram__list">
                <?foreach ($arItem as $item){?>
                    <div class="projectProgram__item <?if($item['DETAIL_TEXT']){?>__existText<?}?>">
                        <div class="projectProgram__item-type"><?=$item['PROPERTY_TYPE_VALUE']?></div>
						<?php if ($item['link']['value'] != ""): ?>
							<a href="<?=$item['link']['value'];?>" data-attr="<?=strip_tags($item['title']['value'])?>" class="projectProgram__item-title hoverMe">
								<?=$item['title']['value']?>
							</a>
						<?php else: ?>
							<div class="projectProgram__item-title">
								<?=$item['title']['value']?>
							</div>
						<?php endif; ?>
						<?php var_dump($item['link']['value']); ?>
                        <div class="projectProgram__item-desc"><?=$item['PREVIEW_TEXT']?></div>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>