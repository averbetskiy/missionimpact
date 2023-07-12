<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook;
?>
<div class="indexSection3">
    <div class="container">
        <h3 class="index__heading"><?=$arResult['NAME']?></h3>
        <div class="heading__columns __top">
            <div class="heading__columns-title"><?=htmlspecialchars_decode($arResult['PROPERTIES']['main_title']['VALUE'])?></div>
            <div class="heading__columns-subtitle">
                <?=$arResult['PREVIEW_TEXT']?>
            </div>
        </div>
        <?if($arResult['PROPERTIES']['link']['VALUE']){?>
            <a href="<?=$arResult['PROPERTIES']['link']['VALUE']?>" class="button"><?=$arHandBook['LEARN_MORE_2']['UF_VALUE']?></a>
        <?}?>

        <div class="indexSection3__sections">
            <div class="indexSection3__section-wrap">
                <section class="indexSection3__section indexSection3__numbers">
                    <div class="indexSection3__numbers-wrap">
                        <div class="indexSection3__numbers-side">
                            <ul>
                                <?foreach ($arResult['PROPERTIES']['second_title']['VALUE'] as $title){?>
                                    <li><span><?=$title?></span></li>
                                <?}?>
                            </ul>
                        </div>
                        <div class="indexSection3__numbers-content">
                            <?foreach ($arResult['PROPERTIES']['desc_title']['VALUE'] as $descTitle){?>
                                <div class="indexSection3__numbers_content-item">
                                    <?$arDescTitle = explode(PHP_EOL,$descTitle);?>
                                    <?foreach ($arDescTitle as $desc){?>
                                        <?$arDesc = explode(';',$desc);?>
                                        <div class="indexSection3__numbers-digit">
                                            <div class="indexSection3__numbers_digit-wrap">
                                                <div class="indexSection3__numbers-value"><?=$arDesc[0]?></div>
                                                <div class="indexSection3__numbers-title"><?=$arDesc[1]?></div>
                                            </div>
                                        </div>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="indexSection3__numbers-text">
                        <p>
                            <?=$arResult['DETAIL_TEXT']?>
                        </p>
                    </div>
                </section>
                <section class="indexSection3__section indexSection3__contents">
                    <div class="indexSection3__contents-wrap">
                        <div class="indexSection3__contents-left">
                            <div class="indexSection3__contents-text">
                                <p><?=$arResult['PROPERTIES']['text']['VALUE']['TEXT']?></p>
                            </div>
                            <div class="indexSection3__contents-meta">
                                <?if($arResult['AUTHOR']){?>
                                    <div class="indexSection3__contents_meta-author">
                                        <div class="indexSection3__contents_meta_author-name">
                                            <?=$arResult['AUTHOR']['NAME']?>
                                        </div>
                                        <div class="indexSection3__contents_meta_author-post">
                                            <?=$arResult['AUTHOR']['POST_VALUE']?>
                                        </div>
                                    </div>
                                <?}?>
                                <?if($arResult['UNIVER']){?>
                                    <div class="indexSection3__contents_meta-univer">
                                        <div class="indexSection3__contents_meta-univer__logo">
                                            <?if($arResult['UNIVER']['PREVIEW_PICTURE']){?>
                                                <img src="<?=CFile::GetPath($arResult['UNIVER']['PREVIEW_PICTURE'])?>" alt="">
                                            <?}?>
                                        </div>
                                        <div class="indexSection3__contents_meta-univer__content">
                                            <div class="indexSection3__contents_meta-univer__name">
                                                <?=$arResult['UNIVER']['NAME']?>
                                            </div>
                                            <div class="indexSection3__contents_meta-univer__city">
                                                <?=$arResult['UNIVER']['CITY_VALUE']?>
                                            </div>
                                        </div>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                        <a href="<?=$arResult['PROPERTIES']['link_video']['VALUE']?>" class="indexSection3__contents-video">
                            <img src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" alt="">
                        </a>
                        <?$video = CFile::GetPath($arResult['PROPERTIES']['video']['VALUE']);?>
                        <?if($video && !$arResult['PROPERTIES']['link_video']['VALUE']){?>
                            <div class="modal__video">
                                <div class="modal__video-overlay"></div>
                                <button class="modal__video-close">✕</button>
                                <div class="modal__video-wrap">
                                    <div class="modal__video-inner">
                                        <div class="modal__video-preview">
                                            <img src="/local/assets/img/section3/indexSection3__contents-video.png" alt="">
                                        </div>
                                        <div class="modal__video-iframe">
                                            <video width="320" height="240" controls>
                                                <source src="<?=$video?>" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                    <div class="modal__video-meta">
                                        <div class="modal__video-title"><?=$arResult['AUTHOR']['NAME']?>/ <?=$arResult['UNIVER']['NAME']?></div>
                                        <div class="modal__video-time"><?=$arResult['PROPERTIES']['time']['VALUE']?></div>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
