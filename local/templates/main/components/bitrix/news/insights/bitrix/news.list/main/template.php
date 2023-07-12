<? use Bitrix\Main\Context;
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
global $arHandBook;
$request = Context::getCurrent()->getRequest();
$ajax = $request->get('ajax');
$class = '';
?>
<div class="diveinblog__tabs divein__hr filtering">
    <div class="diveinblog__tabs_head-wrap">
        <div class="diveinblog__tabs-head tabs__head">
            <a href="#" class="diveinblog__tabs-head__item tabs__head-item filtering__button cat-all active hoverMe" data-attr="<?=$arHandBook['ALL_TOPICS']['UF_VALUE']?>"><?=$arHandBook['ALL_TOPICS']['UF_VALUE']?></a>
            <?foreach ($arResult['TABS'] as $key => $value){?>
                <a href="#" class="diveinblog__tabs-head__item tabs__head-item filtering__button hoverMe" data-cat="<?=$key?>" data-attr="<?=$value?>"><?=$value?></a>
            <?}?>
        </div>
<!--        <form action="#" method="POST" class="diveinblog__tabs-search">-->
<!--            <button class="diveinblog__tabs-search__button">-->
<!--                <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <circle cx="9.27148" cy="9" r="5" stroke="#1A1A1A" stroke-width="2"/>-->
<!--                    <rect x="13.4102" y="11.1724" width="7.6196" height="2" transform="rotate(40 13.4102 11.1724)" fill="#1A1A1A"/>-->
<!--                </svg>-->
<!--            </button>-->
<!--            <input class="diveinblog__tabs-search__input" placeholder="Search topics, titles and words">-->
<!--        </form>-->
    </div>
    <div class="divein__blog-list filter-cat-results">
        <?foreach ($arResult['ITEMS'] as $item){?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="divein__blog-item f-cat" data-cat="<?=$item['PROPERTIES']['type']['VALUE_XML_ID']?>">
                <div class="divein__blog_item-top">
                    <div class="divein__blog_item-meta">
                        <span class="orange"><?=($item['PROPERTIES']['number']['VALUE'])?'№'.$item['PROPERTIES']['number']['VALUE']:""?></span> <?=($item['DISPLAY_ACTIVE_FROM'])?'\\ '.$item['DISPLAY_ACTIVE_FROM']:''?>
                    </div>
                    <div class="divein__blog_item-photo">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                        <?}?>
                    </div>
                    <div class="divein__blog_item-title"><?=$item['NAME']?></div>
                </div>
                <div class="divein__blog_item-more hoverMe" data-attr="<?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?>"><?=$arHandBook['NAME_READ_MORE']['UF_VALUE']?></div>
            </a>
        <?}?>
    </div>
</div>