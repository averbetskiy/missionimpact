<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
use \Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
$ajaxHeader = $request->get("ajaxHeader");
$q = $request->get("q");
global $arHandBook;
$arNameTab = [
    PROJECT => $arHandBook['SEARCH_SOLUTIONS']['UF_VALUE'],
    CASES => $arHandBook['SEARCH_CASES']['UF_VALUE'],
    BLOG => $arHandBook['SEARCH_BLOG']['UF_VALUE'],
    EVENTS => $arHandBook['SEARCH_EVENTS']['UF_VALUE'],
    INSIGHTS => $arHandBook['SEARCH_INSIGHTS']['UF_VALUE'],
    TEST => $arHandBook['SEARCH_TEST']['UF_VALUE'],
    SPEAKER => $arHandBook['SEARCH_SPEAKER']['UF_VALUE'],
    PARTNERS => $arHandBook['SEARCH_PARTNER']['UF_VALUE'],
    MEDIA => $arHandBook['SEARCH_MEDIA']['UF_VALUE'],
];
$replace = ['<span class="searchHighlight">','</span>'];
?>
<?if(!is_array($arParams['IBLOCK_ID']) && $arParams['IBLOCK_ID'] == MEDIA){?>
    <div class="search__results-tabs__body-item current" data-cat="photovideo">
        <div class="search__results-tabs__body-item__media container">
            <?$i = 1;?>
            <?foreach ($arResult['ITEMS'] as $item){?>
                <?
                $name = str_replace($replace,['',''],$item['NAME']);
                ?>
                <?$section = $arResult['SECTION_MEDIA'][$item['IBLOCK_SECTION_ID']];?>
                <?if($section['CODE'] == 'video'){?>
					<a href="<?=$item['PROPERTIES']['video']['VALUE']?:'javascript:void(0)'?>" class="pv__videos-item" <?if($item['PROPERTIES']['video']['VALUE']){?>data-fancybox<?}?> data-type="video">
                        <div class="pv__videos-item__preview search__results-tabs__body-item__media-item__preview">
                            <?if($item['PREVIEW_PICTURE']['SRC']){?>
                                <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                            <?}?>
							<div class="pv__photos-item__preview-data">
								<div class="pv__photos-item__preview-date"><?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH2,date('d M Y',strtotime($item['ACTIVE_FROM'])))?></div>
							</div>
                        </div>
                        <div class="pv__item-content">
                            <div class="pv__item-content__title"><?=$item['NAME']?></div>
                        </div>
                    </a>
                <?}else{?>
					<a href="javascript:void(0)" class="pv__photos-item" data-preview="photos<?=$i?>">
						<div class="pv__photos-item__preview search__results-tabs__body-item__media-item__preview">
							<?if($item['PREVIEW_PICTURE']['SRC']){?>
								<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$name;?>" title="<?=$name;?>">
							<?}?>
							<div class="pv__photos-item__preview-data">
								<div class="pv__photos-item__preview-date"><?=str_replace(RU_SHORT_MONTH,EN_SHORT_MONTH2,date('d M Y',strtotime($item['ACTIVE_FROM'])))?></div>
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
                                    <img src="<?=$photo?>"  alt="<?=$name.'-'.$j?>" title="<?=$name.'-'.$j?>">
                                </a>
                                <?$j++;?>
                            <?}?>
                        </div>
                    <?}?>
                <?}?>
                <?$i++;?>
            <?}?>
        </div>
		<div class="search__more-wrap">
			<div class="container">
				<?if($ajaxHeader == 'Y'){?>
					<div class="search__results-tabs__body-item__more">
						<a href="/search/?q=<?=$q?>" class="hoverMe" data-attr="<?=$arHandBook['SEARCH_RESULT']['UF_VALUE']?>"><?=$arHandBook['SEARCH_RESULT']['UF_VALUE']?></a>
					</div>
				<?}?>
				<?if($ajaxHeader != 'Y'){?>
					<?=$arResult["NAV_STRING"]?>
				<?}?>
			</div>
		</div>
    </div>
<?}else{?>
    <div class="search__results-tabs__body-item current" data-cat="all">
        <div class="search__results-tabs__body-item__list" data-type="list">
            <?$i = 1;?>
            <?foreach ($arResult['ITEMS'] as $item){?>
                <?
                $name = str_replace($replace, ['', ''], $item['NAME']);
                $fancybox = '';
                $class = '';
                $url = $item['DETAIL_PAGE_URL'];
                if($item['IBLOCK_ID'] == SPEAKER){
                    $url = '/contributors/#search'.$item['ID'];
                }
                if($item['IBLOCK_ID'] == PARTNERS){
                    $url = '/about_partner/#search'.$item['ID'];
                }
                if($item['IBLOCK_ID'] == MEDIA){
                    $section = $arResult['SECTION_MEDIA'][$item['IBLOCK_SECTION_ID']];
                    if($section['CODE'] == 'video'){
                        $url = $item['PROPERTIES']['video']['VALUE']?:'javascript:void(0)';
                        if($item['PROPERTIES']['video']['VALUE']) {
                            $fancybox = 'data-fancybox';
                        }
                    }else{
                        $url = 'javascript:void(0)';
                        $fancybox = 'data-preview="photos'.$i.'"';
                        $class = 'search-all-photo';
                    }
                }
                ?>
                <a href="<?=$url?>" class="search__results-body__item <?=$class?>" <?=$fancybox?>>
                    <div class="search__results-body__item-wrap container">
                        <div class="search__results-body__item-left">
                            <div class="search__results-body__item-title"><?=$item['NAME']?></div>
                            <div class="search__results-body__item-desc"><?=$item['PREVIEW_TEXT']?></div>
                        </div>
                        <div class="search__results-body__item-link">
                            <?=$arNameTab[$item['IBLOCK_ID']]?>
                        </div>
                    </div>
                </a>
                <?if($item['IBLOCK_ID'] == MEDIA){?>
                    <?if($section['CODE'] != 'video'){?>
                        <?if($item['PROPERTIES']['photos']['VALUE']){?>
                            <div class="pv__photos-item__gallery">
                                <?$j=1;?>
                                <?foreach ($item['PROPERTIES']['photos']['VALUE'] as $photo){?>
                                    <a href="<?=$photo?>" data-fancybox="photos<?=$i?>">
                                        <img src="<?=$photo?>"  alt="<?=$name.'-'.$j?>" title="<?=$name.'-'.$j?>">
                                    </a>
                                    <?$j++;?>
                                <?}?>
                            </div>
                        <?}?>
                    <?}?>
                <?}?>
                <?$i++;?>
            <?}?>
        </div>
		<div class="search__more-wrap">
			<div class="container">
				<?if($ajaxHeader == 'Y'){?>
					<div class="search__results-tabs__body-item__more">
						<a href="/search/?q=<?=$q?>" class="hoverMe" data-attr="<?=$arHandBook['SEARCH_RESULT']['UF_VALUE']?>"><?=$arHandBook['SEARCH_RESULT']['UF_VALUE']?></a>
					</div>
				<?}?>
				<?if($ajaxHeader != 'Y'){?>
					<?=$arResult["NAV_STRING"]?>
				<?}?>
			</div>
		</div>
    </div>
<?}?>