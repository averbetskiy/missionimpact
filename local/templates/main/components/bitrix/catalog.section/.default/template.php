<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

global $arHandBook;
$i = 1;
foreach ($arResult['ITEMS'] as $item){
    if($arResult['CODE'] == 'video'){?>
                    <a href="<?=$item['PROPERTIES']['video']['VALUE']?:'javascript:void(0)'?>" class="pv__videos-item" <?if($item['PROPERTIES']['video']['VALUE']){?>data-fancybox<?}?>>
                        <div class="pv__videos-item__preview">
                            <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                            <?}?>
							<div class="pv__photos-item__preview-data">
								<div class="pv__photos-item__preview-date"><?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH2,date('d M Y',strtotime($item['DATE_ACTIVE_FROM'])))?></div>
							</div>
                        </div>
                        <div class="pv__item-content">
                            <div class="pv__item-content__title"><?=$item['NAME']?></div>
                        </div>
                    </a>
    <?}else{?>
        <a href="javascript:void(0)" class="pv__photos-item" data-preview="photos<?=$i?>">
            <div class="pv__photos-item__preview">
                <?if($item['PREVIEW_PICTURE']['SRC']){?>
                    <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>" title="<?=$item['NAME']?>">
                <?}?>
				<div class="pv__photos-item__preview-data">
					<div class="pv__photos-item__preview-date"><?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH2,date('d M Y',strtotime($item['DATE_ACTIVE_FROM'])))?></div>
                	<?if($item['PROPERTIES']['photos']['VALUE']){?>
                    	<span class="pv__photos-item__preview-count">
							<?=count($item['PROPERTIES']['photos']['VALUE'])?> <?=$arHandBook['NAME_PHOTOS']['UF_VALUE']?>
						</span>
					<?}?>
				</div>
            </div>
            <div class="pv__item-content">
                <div class="pv__item-content__title"><?=$item['NAME']?></div>
            </div>
        </a>
        <?if($item['PROPERTIES']['photos']['VALUE']){?>
            <div class="pv__photos-item__gallery">
                <?$j=1;?>
                <?foreach ($item['PROPERTIES']['photos']['VALUE'] as $photo){?>
                    <a href="<?=$photo?>" data-fancybox="photos<?=$i?>">
                        <img src="<?=$photo?>"  alt="<?=$item['NAME'].'-'.$j?>" title="<?=$item['NAME'].'-'.$j?>">
                    </a>
                    <?$j++;?>
                <?}?>
            </div>
        <?}?>
    <?}?>
<?
    $i++;
}