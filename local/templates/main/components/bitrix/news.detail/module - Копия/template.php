<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;

?>
<?if($arResult['DUPLICATE']){?>
    <div class="duplicate" data-href="<?=$arResult['DUPLICATE']['DETAIL_PAGE_URL']?>"></div>
<?}?>
<div class="pageCourse__inner-content pageCourse__modulecard">
<!--
	<div class="pageCourse__modulecard-full">
		<p><?=$arResult['STRINGFIOLET'];?></p>
	</div>
-->
    <div class="pageCourse__modulecard-uptitle"><?= $arResult['NAME'] ?></div>
    <?if ($arResult['PROPERTIES']['VIDEO']['VALUE']){?>
        <div class="pageCourse__modulecard-video">
            <div class="pageCourse__modulecard-video__iframe">
                <iframe width="560" height="315" src="<?=$arResult['PROPERTIES']['VIDEO']['VALUE']?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
            </div>
        </div>
    <?}?>
<!--    <div class="pageCourse__modulecard-title"><?= $arResult['NAME'] ?></div>-->
	 <div class="pageCourse__modulecard-number"><?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$arResult['PROPERTIES']['NUMBER']['VALUE']?></div>
    <div class="pageCourse__modulecard-text">
        <?= $arResult['DETAIL_TEXT'] ?>
    </div>
</div>


<div class="pageCourse__inner-right">
    <div class="pageCourse__modulecard-other">
		<?php if ($arResult['TEST'] && $arResult['TEST']['AVAIL'] == 'Y'): ?>
<!--
			<div class="pageCourse__modulecard-full">
				<p><?=$arResult['STRINGFIOLET'];?></p>
			</div>
-->
		<?php endif; ?>
        <? foreach ($arResult['MODULES'] as $module) { ?>
            <a href="<?= $arResult['COURSE']['DETAIL_PAGE_URL'] ?>module/<?=$module['ID']?>/" class="pageCourse__module" data-type="video">
                <div class="pageCourse__module-media">
                    <div class="pageCourse__module-photo">
                        <?if ($module['PREVIEW_PICTURE']){?>
                            <img src="<?=$module['PREVIEW_PICTURE']?>" alt="">
                        <?}?>
                    </div>
                    <div class="pageCourse__module-content">
                        <div class="pageCourse__module-name"><?=$arHandBook['MODULE_TITLE']['UF_VALUE']?> <?=$module['NUMBER_VALUE']?></div>
                        <div class="pageCourse__module-title"><?=$module['NAME']?></div>
                    </div>
                </div>
                <div class="pageCourse__module-info">
                    <div class="pageCourse__module-type">
                        <?=$module['VIDEO_VALUE'] ?
                            $arHandBook['MODULE_TYPE_VIDEO']['UF_VALUE']
                            : $arHandBook['MODULE_TYPE_TEXT']['UF_VALUE']
                        ?>
                    </div>
                    <div class="pageCourse__module-time"><?=$module['DURATION_VALUE']?></div>
                </div>
                <div class="pageCourse__module-status__wrap">
                    <div class="pageCourse__module-status" style="width:<?=($module['COMPLETED'] == 'Y') ? '100%' : '0%'?>"></div>
                </div>
            </a>
        <? } ?>
        <? if ($arResult['TEST']) { ?>
                <?if ($arResult['TEST']['AVAIL'] == 'Y') {?>
        <a href="<?= $arResult['COURSE']['DETAIL_PAGE_URL'] ?>test/" class="pageCourse__module" data-type="test">
                        <?}else{?>
            <div class="pageCourse__module" data-type="test">
                        <?}?>
                <div class="pageCourse__module-media">
                    <div class="pageCourse__module-photo"></div>
                    <div class="pageCourse__module-content">
                        <?if ($arResult['TEST']['AVAIL'] != 'Y') {?>
                            <div class="pageCourse__module-title __close"><?=$arHandBook['TEST_MODULES_NOT_COMPLETED']['UF_VALUE']?></div>
                        <?}else{?>
                            <div class="pageCourse__module-title"><?=$arHandBook['TEST_MODULES_COMPLETED']['UF_VALUE']?></div>
                        <?}?>
                    </div>
                </div>
                <div class="pageCourse__module-info">
                    <div class="pageCourse__module-type"><?=$arHandBook['TEST_TYPE']['UF_VALUE']?></div>
<!--                    <div class="pageCourse__module-time">00:05</div>-->
                </div>
                <?if ($arResult['TEST']['AVAIL'] == 'Y') {?>
            </a>
                    <?}else{?>
            </div>
                        <?}?>
        <? } ?>
    </div>
</div>