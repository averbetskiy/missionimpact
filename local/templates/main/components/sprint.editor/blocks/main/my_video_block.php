<? /** @var $block array */?>
<?
$author = [];
$univer = [];
$lang = $_COOKIE['gic_lang'];
if(!$lang){
    $lang = 's1';
}
if($block['author']['element_ids'][0]){
    $arSelect = ["ID", "NAME", 'PROPERTY_POST'];
    $arFilter = ["IBLOCK_ID" => SPEAKER , "ACTIVE"=>"Y","ID" => $block['author']['element_ids'][0]];
    $res = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilter, false, [], $arSelect);
    if($ob = $res->GetNextElement())
    {
        $author = $ob->GetFields();
    }
}
if($block['univer']['element_ids'][0]){
    $arSelectCompany = ["ID", "NAME", 'PROPERTY_CITY','PREVIEW_PICTURE'];
    $arFilterCompany = ["IBLOCK_ID" => COMPANY , "ACTIVE"=>"Y","ID" => $block['univer']['element_ids'][0]];
    $resCompany = CIBlockElement::GetList(['SORT' => 'ASC'], $arFilterCompany, false, [], $arSelectCompany);
    if($obCompany = $resCompany->GetNextElement())
    {
        $univer = $obCompany->GetFields();
    }
}
?>
<div class="projectQuotes">
    <div class="container">
        <div class="indexSection3__contents">
            <div class="indexSection3__contents-wrap">
                <div class="indexSection3__contents-left">
                    <div class="indexSection3__contents-text">
                        <?=$block['text']['value']?>
                    </div>
                    <div class="indexSection3__contents-meta">
                        <?if($author){?>
                            <div class="indexSection3__contents_meta-author">
                                <div class="indexSection3__contents_meta_author-name"><?=$author['NAME']?></div>
                                <div class="indexSection3__contents_meta_author-post"><?=$author['PROPERTY_POST_VALUE']?></div>
                            </div>
                        <?}?>
                        <?if($univer){?>
                            <div class="indexSection3__contents_meta-univer">
                                <div class="indexSection3__contents_meta-univer__logo">
                                    <?if($univer['PREVIEW_PICTURE']){?>
                                        <img src="<?=CFile::GetPath($univer['PREVIEW_PICTURE'])?>" alt="">
                                    <?}?>
                                </div>
                                <div class="indexSection3__contents_meta-univer__content">
                                    <div class="indexSection3__contents_meta-univer__name"><?=$univer['NAME']?></div>
                                    <div class="indexSection3__contents_meta-univer__city"><?=$univer['PROPERTY_CITY_NAME']?></div>
                                </div>
                            </div>
                        <?}?>
                    </div>
                </div>
                <?if($block['image']['file']['ORIGIN_SRC']){?>
                    <?
                    $video = '';
                    if($block['video']['url']){
                        $video = $block['video']['url'];
                    }elseif ($block['video_files']['files'][0]['file']['SRC']){
                        $video = $block['video_files']['files'][0]['file']['SRC'];
                    }
                    ?>
                    <?if($video){?>
                        <a href="#" class="indexSection3__contents-video">
                            <?if($block['image']['file']['ORIGIN_SRC']){?>
                                <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                            <?}?>
                        </a>
                    <?}else{?>
                        <div class="indexSection3__contents-video">
                            <?if($block['image']['file']['ORIGIN_SRC']){?>
                                <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
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
                                        <?if($block['image']['file']['ORIGIN_SRC']){?>
                                            <img src="<?=$block['image']['file']['ORIGIN_SRC']?>" alt="">
                                        <?}?>
                                    </div>
                                    <div class="modal__video-iframe">
                                        <video width="320" height="240" controls>
                                            <source src="<?=$video?>" type="video/mp4">
                                        </video>
                                    </div>
                                </div>
                                <div class="modal__video-meta">
                                    <div class="modal__video-title"><?=$author['NAME']?>/ <?=$univer['NAME']?></div>
                                    <?if($block['time']['value']){?>
                                        <div class="modal__video-time"><?=$block['time']['value']?></div>
                                    <?}?>
                                </div>
                            </div>
                        </div>
                    <?}?>
                <?}?>
            </div>
        </div>
    </div>
</div>
