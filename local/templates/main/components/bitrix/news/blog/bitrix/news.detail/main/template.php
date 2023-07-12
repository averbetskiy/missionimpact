<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
global $arProp;
$arProp = [
    'PICTURE' => $arResult['DETAIL_PICTURE'],
    'PROP' => $arResult['PROPERTIES']
];
?>
<?if($arResult['DUPLICATE']){?>
    <div class="duplicate" data-href="<?=$arResult['DUPLICATE']['DETAIL_PAGE_URL']?>">
    </div>
<?}?>
<div class="container">
    <div class="diveininner__wrap">
        <a href="/blog/" class="divein__back hoverMe" data-attr="<?=$arHandBook['BACK_TO_BLOG']['UF_VALUE']?>"><?=$arHandBook['BACK_TO_BLOG']['UF_VALUE']?></a>
        <div class="diveininner__content">
            <div class="divein__article">
                <div class="divein__meta">
                    <div class="divein__meta-type" data-type="<?=$arResult['SECTION_NAME']['CODE']?>"><?=$arResult['SECTION_NAME']['NAME']?></div>
                    <div class="divein__meta-date"><?=$arResult['DATE']?></div>
                </div>
                <h1 class="divein__article-title"><?=$arResult['NAME']?></h1>
                <div class="divein__article-content">
                    <?$APPLICATION->IncludeComponent(
                        "sprint.editor:blocks",
                        "main",
                        Array(
                            "ELEMENT_ID" => $arResult["ID"],
                            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                            "PROPERTY_CODE" => 'content',
                            "JSON" => htmlspecialchars_decode($arResult['PROPERTIES']['content']['VALUE'])
                        ),
                        $component,
                        Array(
                            "HIDE_ICONS" => "Y"
                        )
                    );?>
                </div>
                <div class="divein__share">
<!--                    <div class="divein__share-title">Share</div>-->
<!--                    <div class="divein__share-list">-->
<!--                        <a href="#" class="divein__share-item">-->
<!--                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <g clip-path="url(#clip0_629_5135)">-->
<!--                                    <path d="M20 10C20 4.47715 15.5229 0 10 0C4.47715 0 0 4.47715 0 10C0 14.9912 3.65684 19.1283 8.4375 19.8785V12.8906H5.89844V10H8.4375V7.79688C8.4375 5.29063 9.93047 3.90625 12.2146 3.90625C13.3084 3.90625 14.4531 4.10156 14.4531 4.10156V6.5625H13.1922C11.95 6.5625 11.5625 7.3334 11.5625 8.125V10H14.3359L13.8926 12.8906H11.5625V19.8785C16.3432 19.1283 20 14.9912 20 10Z" fill="#1A1A1A"/>-->
<!--                                </g>-->
<!--                                <defs>-->
<!--                                    <clipPath id="clip0_629_5135">-->
<!--                                        <rect width="20" height="20" fill="white"/>-->
<!--                                    </clipPath>-->
<!--                                </defs>-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                        <a href="#" class="divein__share-item">-->
<!--                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <g clip-path="url(#clip0_629_5136)">-->
<!--                                    <path d="M18.5195 0H1.47656C0.660156 0 0 0.644531 0 1.44141V18.5547C0 19.3516 0.660156 20 1.47656 20H18.5195C19.3359 20 20 19.3516 20 18.5586V1.44141C20 0.644531 19.3359 0 18.5195 0ZM5.93359 17.043H2.96484V7.49609H5.93359V17.043ZM4.44922 6.19531C3.49609 6.19531 2.72656 5.42578 2.72656 4.47656C2.72656 3.52734 3.49609 2.75781 4.44922 2.75781C5.39844 2.75781 6.16797 3.52734 6.16797 4.47656C6.16797 5.42188 5.39844 6.19531 4.44922 6.19531ZM17.043 17.043H14.0781V12.4023C14.0781 11.2969 14.0586 9.87109 12.5352 9.87109C10.9922 9.87109 10.7578 11.0781 10.7578 12.3242V17.043H7.79688V7.49609H10.6406V8.80078H10.6797C11.0742 8.05078 12.043 7.25781 13.4844 7.25781C16.4883 7.25781 17.043 9.23438 17.043 11.8047V17.043Z" fill="#1A1A1A"/>-->
<!--                                </g>-->
<!--                                <defs>-->
<!--                                    <clipPath id="clip0_629_5136">-->
<!--                                        <rect width="20" height="20" fill="white"/>-->
<!--                                    </clipPath>-->
<!--                                </defs>-->
<!--                            </svg>-->
<!--                        </a>-->
<!--                    </div>-->
                </div>
                <?$APPLICATION->ShowViewContent('blog_news');?>
            </div>
        </div>
    </div>
</div>