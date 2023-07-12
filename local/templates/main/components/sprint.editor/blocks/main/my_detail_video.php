<? /** @var $block array */?>
<?
global $arProp;
?>
<!-- здесь нужна проверка: если мы загружаем с youtube, то показывать див с классом divein__article-iframe, если файлом, то показывать див с классом divein__article-video. Постер должен задаваться из админки и ссылка на файл тоже -->
<?if($arProp['PROP']['link_video']['VALUE']){?>
    <div class="divein__article-iframe">
    <iframe width="560" height="315" src="<?=$arProp['PROP']['link_video']['VALUE']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
<?}elseif($arProp['PROP']['video']['VALUE']){?>
    <video width="320" height="240" controls poster="<?=$arProp['PICTURE']['SRC']?>" muted>
        <source src="<?=CFile::GetPath($arProp['PROP']['video']['VALUE'])?>" type="video/mp4">
    </video>
<?}?>
