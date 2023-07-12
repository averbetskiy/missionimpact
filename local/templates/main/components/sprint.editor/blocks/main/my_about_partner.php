<? /** @var $block array */?>
<?
$arPartners = \Bitrix\Iblock\ElementTable::getList([
    'select' => ['ID','NAME','DETAIL_PICTURE'],
    'filter' => ['IBLOCK_ID' => $block['iblock_id'],'ID' => $block['element_ids']]
])->fetchAll();
?>
<div class="projectLogos__wrap aboutLogos__wrap">
    <?foreach ($arPartners as $partner){?>
        <?if($partner['DETAIL_PICTURE']){?>
            <div class="projectLogos__item">
                <img src="<?=CFile::GetPath($partner['DETAIL_PICTURE'])?>" alt="<?=$partner['NAME']?>">
            </div>
        <?}?>
    <?}?>
</div>
