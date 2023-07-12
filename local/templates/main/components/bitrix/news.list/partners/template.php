<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<?
if($arResult['ITEMS']) {?>
    <div class="indexMission">
        <div class="container">
            <div class="indexMission__wrap">
                <div class="indexMission__top">
                    <div class="indexMission__uptitle"><?=$arHandBook['MAIN_BLOCK_MISSION_PARTNER_NAME']['UF_VALUE']?></div>
                    <div class="indexMission__title"><?=$arHandBook['MAIN_BLOCK_MISSION_PARTNER_TEXT']['UF_VALUE']?></div>
                </div>
                <div class="indexMission__logos">
                    <?
                        foreach ($arResult['ITEMS'] as $item) {
                            ?>
                            <div class="indexMission__logos-item"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>"></div>
                            <?
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?
}
?>