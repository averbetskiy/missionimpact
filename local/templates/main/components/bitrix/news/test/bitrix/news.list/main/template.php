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
$sectionId= $request->get('section');
?>
<div class="diveinblog__tabs filtering">
    <div class="diveinblog__tabs_head-wrap">
        <div class="diveinblog__tabs-head tabs__head">
            <a href="#" class="diveinblog__tabs-head__item tabs__head-item cat-all <?=($sectionId == 0 || !$sectionId)?'active':''?> hoverMe tabAjaxBlog"
               data-id="0"
               data-attr="<?=$arHandBook['ALL_TEST']['UF_VALUE']?>">
                <?=$arHandBook['ALL_TEST']['UF_VALUE']?>
            </a>
            <?foreach ($arResult['SECTION'] as $key => $section){?>
                <a href="#" class="diveinblog__tabs-head__item tabs__head-item hoverMe tabAjaxBlog <?=($sectionId == $section['ID'])?'active':''?>"
                   data-id="<?=$section['ID']?>"
                   data-cat="<?=strtolower($section['CODE'])?>"
                   data-attr="<?=$section['NAME']?> [<?=$section['COUNT']?>]">
                    <?=$section['NAME']?> [<?=$section['COUNT']?>]
                </a>
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
        <!-- нужно сделать галочку "длинный блок" в админке, который бы добавляла класс large к блоку ниже -->
        <?foreach ($arResult['ITEMS'] as $item){?>
            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="divein__blog-item f-cat active" data-cat="<?=strtolower($item['SECTION_NAME'])?>">
                <div class="divein__blog_item-top">
                    <div class="divein__blog_item-meta"><?=$item['SECTION_NAME']?> <?=($item['DISPLAY_ACTIVE_FROM'])?'\\ '.$item['DISPLAY_ACTIVE_FROM']:''?></div>
                    <div class="divein__blog_item-photo">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
                        <?}?>
                    </div>
                    <div class="divein__blog_item-title"><?=$item['NAME']?></div>
                </div>
                <div class="divein__blog_item-more hoverMe" data-attr="<?=$arHandBook['NAME_READ_MORE_TEST']['UF_VALUE']?>"><?=$arHandBook['NAME_READ_MORE_TEST']['UF_VALUE']?></div>
            </a>
        <?}?>
    </div>
<!--    --><?//=$arResult["NAV_STRING"]?>
</div>