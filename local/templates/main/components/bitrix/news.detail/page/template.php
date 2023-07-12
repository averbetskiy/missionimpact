<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
?>
<div class="container">
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
<?if($arResult['PROPERTIES']['content2']['VALUE']){?>
<div class="aboutLeaders">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "sprint.editor:blocks",
            "main",
            Array(
                "ELEMENT_ID" => $arResult["ID"],
                "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                "PROPERTY_CODE" => 'content2',
                "JSON" => htmlspecialchars_decode($arResult['PROPERTIES']['content2']['VALUE'])
            ),
            $component,
            Array(
                "HIDE_ICONS" => "Y"
            )
        );?>
    </div>
</div>
<?}?>