<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
?>
<div class="terms__open" id="terms<?=$arResult["CODE"];?>">
    <div class="terms__overlay">
        <div class="terms__wrap">
            <div class="terms__inner">
                <button class="terms__close">✕</button>
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
        </div>
    </div>
</div>