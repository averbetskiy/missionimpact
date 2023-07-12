<? /** @var $block array */?>
<div class="projectProgram projectDocuments">
    <div class="container">
        <div class="projectProgram__wrap">
            <div class="projectProgram__heading">
                <p class="index__heading __multiply"><?=str_replace(['<p>','</p>'],"",$block['name_block']['value'])?></p>
                <div class="heading__columns-title"><?=$block['text']['value']?></div>
            </div>
            <div class="projectProgram__list">
                <?foreach ($block['documents']['files'] as $document){?>
                    <a href="<?=$document['file']['SRC']?>" class="projectProgram__item projectDocuments__item" download>
                        <div class="projectProgram__item-title__wrap">
                            <span class="projectProgram__item-title"><?=($document['desc'])?$document['desc']:explode('.',$document['file']['ORIGINAL_NAME'])[0]?></span>
                            <span class="projectProgram__item-title__icon"></span>
                        </div>
                        <div class="projectProgram__item-type">
                            <?=pathinfo($document['file']['SRC'],PATHINFO_EXTENSION)?>. <?=get_filesize($_SERVER['DOCUMENT_ROOT'].$document['file']['SRC'])?>
                        </div>
                    </a>
                <?}?>
            </div>
        </div>
    </div>
</div>