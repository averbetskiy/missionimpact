<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?if ($arResult){?>
    <nav class="profile__menu">
        <?foreach ($arResult as $item){?>
            <a href="<?=$item['LINK']?>" class="hoverMe<?=$item['SELECTED'] ? ' active' : ''?>" data-attr="<?=ucfirst($item['TEXT'])?>"><?=ucfirst($item['TEXT'])?></a>
        <?}?>
    </nav>
<?}?>
