<?
global $headerDark;
global $arHandBook;
$headerDark = true;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<main class="error">
    <div class="errorSection1">
        <div class="container">
            <div class="errorSection1__wrap">
                <div class="errorSection1__text">
                    <h2 class="errorSection1__subtitle"><?=$arHandBook['PAGE_404']['UF_VALUE']?></h2>
                    <div class="errorSection1__heading">
                        <span><?=$arHandBook['PAGE_404_TEXT1']['UF_VALUE']?></span> <br>
                        <span><?=$arHandBook['PAGE_404_TEXT2']['UF_VALUE']?></span> <br>
                        <span><?=$arHandBook['PAGE_404_TEXT3']['UF_VALUE']?></span>
                    </div>

                </div>
                <div class="errorSection1__media">
                    <div class="errorSection1__media-item">
                        <img src="/local/assets/img/404/1.png" alt="">
                    </div>
                    <div class="errorSection1__media-item">
                        <img src="/local/assets/img/404/2.png" alt="">
                    </div>
                    <div class="errorSection1__media-item">
                        <img src="/local/assets/img/404/3.png" alt="">
                    </div>
                    <div class="errorSection1__media-item">
                        <img src="/local/assets/img/404/4.png" alt="">
                    </div>
                    <div class="errorSection1__media-item">
                        <img src="/local/assets/img/404/5.png" alt="">
                    </div>
                </div>
            </div>
            <div class="errorSection1__more">
                <?=$arHandBook['PAGE_404_TEXT_BOTTOM']['UF_VALUE']?> <br>
                <a href="/" class="hoverMe" data-attr="<?=$arHandBook['HOME_PAGE']['UF_VALUE']?>"><?=$arHandBook['HOME_PAGE']['UF_VALUE']?></a>
            </div>
        </div>
    </div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
