<? /** @var $block array */?>
<div class="itvideo">
    <div class="container">
        <div class="itvideo__wrap">
            <div class="itvideo__media">
                <div class="itvideo__media-poster pv__main-media" data-cursor="swipe">
                    <?if($block['poster']['files'][0]['file']['SRC']){?>
                        <img src="<?=$block['poster']['files'][0]['file']['SRC']?>" alt="">
                    <?}?>
                </div>
                <div class="itvideo__media-iframe">
                    <?if($block['video']['url']){?>
                        <iframe width="560" height="315" src="<?=$block['video']['url']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <?}else{?>
                        <video width="480" controls>
                            <source src="<?=$block['video_files']['files'][0]['file']['SRC']?>" type="video/mp4">
                            Your browser doesn't support HTML5 video tag.
                        </video>
                    <?}?>
                </div>
            </div>
            <div class="itvideo__content">
                <div class="itvideo__content-top">
                    <p class="index__heading __multiply"><?=$block['text1']['value']?></p>
                    <div class="heading__columns-title"><p><?=$block['text2']['value']?></p></div>
                    <div class="itvideo__content-text"><p><?=$block['text3']['value']?></p></div>
                </div>
                <?if($block['report']['files'][0]['file']['SRC']){?>
                    <div class="itvideo__content-bottom">
                        <a href="<?=$block['report']['files'][0]['file']['SRC']?>" download="download" class="hoverMe" data-attr="<?=strip_tags($block['text_report']['value'])?>"><?=$block['text_report']['value']?></a>
                    </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
