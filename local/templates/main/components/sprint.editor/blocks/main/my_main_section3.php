<? /** @var $block array */?>
<?
$arText = [];
$arList = [];
$arVideo = [];
foreach ($block['blocks'] as $item){
    if($item['name'] == 'my_main_section3_1'){
        $arText = $item;
    }
    if($item['name'] == 'my_main_section_3_2'){
        $arList[] = $item;
    }
    if($item['name'] == 'my_main_section_3_3'){
        $arVideo = $item;
    }
}
$arItemAuthor = [];
$arItemCompany = [];
if($arVideo['author']['element_ids']){
    $arSelectAuthor = ["ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_post"];
    $arFilterAuthor = ["IBLOCK_ID" => $arVideo['author']['iblock_id'],"ID" => $arVideo['author']['element_ids']];
    $resAuthor = CIblockElement::GetList(["ACTIVE_FROM" => "ASC"], $arFilterAuthor, false, ["nPageSize"=>1], $arSelectAuthor);
    if ($obAuthor = $resAuthor->GetNextElement()) {
        $arItemAuthor = $obAuthor->GetFields();
    }
}
if($arVideo['company']['element_ids']){
    $arSelectCompany = ["ID", "IBLOCK_ID", "CODE", "NAME", "PROPERTY_city","PREVIEW_PICTURE"];
    $arFilterCompany = ["IBLOCK_ID" => $arVideo['company']['iblock_id'],"ID" => $arVideo['company']['element_ids']];
    $resCompany = CIblockElement::GetList(["ACTIVE_FROM" => "ASC"], $arFilterCompany, false, ["nPageSize"=>1], $arSelectCompany);
    if ($obCompany = $resCompany->GetNextElement()) {
        $arItemCompany = $obCompany->GetFields();
    }
}
?>
<div class="indexSection3">
    <div class="container">
        <?if($arText['name_block']['value']){?>
            <<?=$arText['name_block']['type']?> class="index__heading"><?=$arText['name_block']['value']?></<?=$arText['name_block']['type']?>>
        <?}?>
        <div class="heading__columns __top">
            <div class="heading__columns-title"><?=$arText['title']['value']?></div>
            <div class="heading__columns-subtitle"><?=$arText['sub_title']['value']?></div>
        </div>
        <?if($arText['link']['value']){?>
            <a href="<?=$arText['link']['value']?>" data-attr="<?=strip_tags($arText['text_botton']['value']);?>" class="button hoverMe"><?=$arText['text_botton']['value']?></a>
        <?}?>
        <div class="indexSection3__sections">
            <div class="indexSection3__section-wrap">
                <section class="indexSection3__section indexSection3__numbers">
                    <div class="indexSection3__numbers-wrap">
                        <div class="indexSection3__numbers-side">
                            <ul>
                                <?foreach ($arList as $list){?>
                                    <li><span><?=$list['name_list']['value']?></span></li>
                                <?}?>
                            </ul>
                        </div>
                        <div class="indexSection3__numbers-content">
                            <?foreach ($arList as $list){?>
                                <div class="indexSection3__numbers_content-item">
                                    <div class="indexSection3__numbers-digit">
                                        <div class="indexSection3__numbers_digit-wrap">
                                            <div class="indexSection3__numbers-value"><?=$list['value1']['value']?></div>
                                            <div class="indexSection3__numbers-title"><?=$list['title1']['value']?></div>
                                        </div>
                                    </div>
                                    <div class="indexSection3__numbers-digit">
                                        <div class="indexSection3__numbers_digit-wrap">
                                            <div class="indexSection3__numbers-value"><?=$list['value2']['value']?></div>
                                            <div class="indexSection3__numbers-title"><?=$list['title2']['value']?></div>
                                        </div>
                                    </div>
                                    <div class="indexSection3__numbers-digit">
                                        <div class="indexSection3__numbers_digit-wrap">
                                            <div class="indexSection3__numbers-value"><?=$list['value3']['value']?></div>
                                            <div class="indexSection3__numbers-title"><?=$list['title3']['value']?></div>
                                        </div>
                                    </div>
                                    <div class="indexSection3__numbers-digit">
                                        <div class="indexSection3__numbers_digit-wrap">
                                            <div class="indexSection3__numbers-value"><?=$list['value4']['value']?></div>
                                            <div class="indexSection3__numbers-title"><?=$list['title4']['value']?></div>
                                        </div>
                                    </div>
                                </div>
                            <?}?>
                        </div>
                    </div>
                    <div class="indexSection3__numbers-text">
                        <?=$arText['text_bottom']['value']?>
                    </div>
                </section>
                <section class="indexSection3__section indexSection3__contents">
                    <div class="indexSection3__contents-wrap">
                        <div class="indexSection3__contents-left">
                            <div class="indexSection3__contents-text">
                                <?=$arVideo['text']['value']?>
                            </div>
                            <div class="indexSection3__contents-meta">
                                <div class="indexSection3__contents_meta-author">
                                    <div class="indexSection3__contents_meta_author-name">
                                        <?=$arItemAuthor['NAME']?>
                                    </div>
                                    <div class="indexSection3__contents_meta_author-post">
                                        <?=$arItemAuthor['PROPERTY_POST_VALUE']?>
                                    </div>
                                </div>
                                <div class="indexSection3__contents_meta-univer">
                                    <div class="indexSection3__contents_meta-univer__logo">
                                        <?if($arItemCompany['PREVIEW_PICTURE']){?>
                                            <img src="<?=CFile::GetPath($arItemCompany['PREVIEW_PICTURE'])?>" alt="">
                                        <?}?>
                                    </div>
                                    <div class="indexSection3__contents_meta-univer__content">
                                        <div class="indexSection3__contents_meta-univer__name">
                                            <?=$arItemCompany['NAME']?>
                                        </div>
                                        <div class="indexSection3__contents_meta-univer__city">
                                            <?=$arItemCompany['PROPERTY_CITY_VALUE']?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?if($arVideo['image']['file']['ORIGIN_SRC']){?>
                            <?
                            $video = '';
                            if($arVideo['video']['url']){
                                $video = $arVideo['video']['url'];
                            }elseif ($arVideo['video_files']['files'][0]['file']['SRC']){
                                $video = $arVideo['video_files']['files'][0]['file']['SRC'];
                            }
                            ?>
                            <?if($video){?>
                                <a href="#" class="indexSection3__contents-video">
                                    <?if($arVideo['image']['file']['ORIGIN_SRC']){?>
                                        <img src="<?=$arVideo['image']['file']['ORIGIN_SRC']?>" alt="">
                                    <?}?>
                                </a>
                            <?}else{?>
                                <div class="indexSection3__contents-video">
                                    <?if($arVideo['image']['file']['ORIGIN_SRC']){?>
                                        <img src="<?=$arVideo['image']['file']['ORIGIN_SRC']?>" alt="">
                                    <?}?>
                                </div>
                            <?}?>
                            <?if($video){?>
                                <div class="modal__video">
                                    <div class="modal__video-overlay"></div>
                                    <button class="modal__video-close">✕</button>
                                    <div class="modal__video-wrap">
                                        <div class="modal__video-inner">
                                            <div class="modal__video-preview">
                                                <?if($arVideo['image']['file']['ORIGIN_SRC']){?>
                                                    <img src="<?=$arVideo['image']['file']['ORIGIN_SRC']?>" alt="">
                                                <?}?>
                                            </div>
                                            <div class="modal__video-iframe">
                                                <video width="320" height="240" controls>
                                                    <source src="<?=$video?>" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                        <div class="modal__video-meta">
                                            <div class="modal__video-title"><?=$arItemAuthor['NAME']?>/ <?=$arItemCompany['NAME']?></div>
                                            <?if($arVideo['time']['value']){?>
                                                <div class="modal__video-time"><?=$arVideo['time']['value']?></div>
                                            <?}?>
                                        </div>
                                    </div>
                                </div>
                            <?}?>
                        <?}?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
