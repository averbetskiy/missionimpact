<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?foreach ($arResult as $item){?>
    <?if($item['PARAMS']['CODE'] == 'contact'){?>
        <div class="footer__top-social _mobile">
            <a href="<?=$item['LINK']?>" class="footer__top_menu-title hoverMe" data-attr="<?=$item['TEXT']?>"><?=$item['TEXT']?></a>
            <?if($item['PARAMS']['SUB_SECTIONS']){?>
                <ul>
                    <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                        <li>
                            <a href="<?=$subSection['UF_LINK']?>" class="hoverMe" data-attr="<?=$subSection['~NAME']?>" target="_blank">
                                <?=$subSection['~NAME']?>
                            </a>
                        </li>
                    <?}?>
                    <li><?=$item['PARAMS']['DESCRIPTION']?></li>
                </ul>
            <?}?>
        </div>
        <?$this->SetViewTarget('footer_menu_contact');?>
            <div class="footer__right">
                <div class="footer__top-social">
                    <a href="<?=$item['LINK']?>" class="footer__top_menu-title hoverMe" data-attr="<?=$item['TEXT']?>"><?=$item['TEXT']?></a>
                    <?if($item['PARAMS']['SUB_SECTIONS']){?>
                        <ul>
                            <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                                <li>
                                    <a href="<?=$subSection['UF_LINK']?>" class="hoverMe" data-attr="<?=$subSection['~NAME']?>">
                                        <?=$subSection['~NAME']?>
                                    </a>
                                </li>
                            <?}?>
                            <li><?=$item['PARAMS']['DESCRIPTION']?></li>
                        </ul>
                    <?}?>
                </div>
            </div>
        <?$this->EndViewTarget();?>
    <?}else{?>
        <div class="footer__top-menu">
            <a href="<?=$item['LINK']?>" target="_blank" class="footer__top_menu-title hoverMe" data-attr="<?=$item['TEXT']?>"><?=$item['TEXT']?></a>
            <?if($item['PARAMS']['SUB_SECTIONS']){?>
                <ul>
                    <?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
                        <li>
                            <a href="<?=$subSection['UF_LINK']?>" class="hoverMe" data-attr="<?=$subSection['~NAME']?>">
                                <?=$subSection['~NAME']?>
                            </a>
                        </li>
                    <?}?>
                    <li><?=$item['PARAMS']['DESCRIPTION']?></li>
                </ul>
            <?}?>
        </div>
    <?}?>
<?}?>