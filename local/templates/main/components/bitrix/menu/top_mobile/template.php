<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);?>
<?php //var_dump($arResult); ?>
<nav class="header__nav_mob">
    <ul>
        <?foreach ($arResult as $item){?>
            <li class="dropdown__mob">
                <a href="#" class="header__menu-link hoverMe<?if($item['PARAMS']['SUB_SECTIONS']){?> openDropdown<?}?>" data-attr="<?=$item['TEXT']?> →">
					<?=$item['TEXT']?> →
				</a>
				<?if($item['PARAMS']['SUB_SECTIONS']){?>
					<ul class="dropdown__mob-list">
						<?foreach ($item['PARAMS']['SUB_SECTIONS'] as $subSection){?>
							<li>
								<a href="<?=$subSection['UF_LINK']?>" class="hoverMe" data-attr="<?=$subSection['~NAME']?>">
									<?=$subSection['~NAME']?>
								</a>
							</li>
						<?}?>
					</ul>
				<?}?>
            </li>
        <?}?>
    </ul>
</nav>