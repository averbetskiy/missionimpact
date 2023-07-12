<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'header__transparent profileSample');
?>

<div class="profileSample">
	<div class="profileSample__box">
        <?
        if($_REQUEST['change_password'] === 'yes') {
            $APPLICATION->IncludeComponent(
                "bitrix:system.auth.changepasswd",
                "main",
                Array(
                    "SHOW_ERRORS" => "Y",
                    "AUTH_RESULT" => $APPLICATION->arAuthResult
                ),
                false
            );
        }
        ?>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>