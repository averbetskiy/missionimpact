<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?foreach ($arResult as $item){?>
    <div class="footer__top-menu">
        <ul>
            <li>
                <?if($item['PARAMS']['CODE'] == 'lang'){?>
                    <a href="javascript:void(0)" class="hoverMe footer_menu_lang" data-attr="<?=$item['TEXT']?>">
                        <?=$item['TEXT']?>
                    </a>
                <?}else{?>
                    <a href="<?=$item['LINK']?>" class="hoverMe open_modal_terms" data-attr="<?=$item['TEXT']?>" data-code="<?=$item['PARAMS']['CODE']?>">
                        <?=$item['TEXT']?>
                    </a>
                <?}?>
            </li>
        </ul>
    </div>
<?}?>