<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
\Bitrix\Main\UI\Extension::load("ui.alerts");
?>
<?if($_GET["auth"] == "success"):?>
<div class="ui-alert ui-alert-success">
    <span class="ui-alert-message">Вы успешно авторизованы!</span>
</div>
<?endif;?>
<?if($_GET['auth'] == 'failed'):?>
<div class="ui-alert ui-alert-danger">
    <span class="ui-alert-message">Во время авторизации произошла ошибка:</span>
    <span><?=$APPLICATION->get_cookie('auth_error');?></span>
</div>
<?endif;?>
<form name="system_auth_form<?=$arResult["RND"]?>" method="post" action="/ajax.php" class="form validation ajax-form">
    <input type="hidden" name="ajax_auth" value="Y" />
    <input type="hidden" name="action_ajax" value="auth"/>
    <div class="error">
    </div>
    <div class="form-group">
        <a class="btn btn-default btn-lg btn-simple btn-block">
            <img data-src="<?=PATH_FRONTEND?>img/icons/yandex.png"
                 srcset="<?=PATH_FRONTEND?>img/icons/yandex.png 1x, <?=PATH_FRONTEND?>img/icons/yandex@2x.png 2x" width="9" height="20" class="lazy"/>&nbsp;&nbsp;
            Войти через yandex
        </a>
    </div>
    <div class="form-inline auth-row mb15">
        <div class="form-group form-group--w30">
            <a class="btn btn-default btn-lg btn-simple btn-block" href="<?=$arResult["CALLBACK"]?>?provider=Mailru">
                <img data-src="<?=PATH_FRONTEND?>img/icons/mail.png"
                     srcset="<?=PATH_FRONTEND?>img/icons/mail.png 1x, <?=PATH_FRONTEND?>img/icons/mail@2x.png 2x" width="20" height="19" class="lazy"/>&nbsp;
                Mail.ru
            </a>
        </div>
        <div class="form-group form-group--w30">
            <a class="btn btn-default btn-lg btn-simple btn-block">
                <img data-src="<?=PATH_FRONTEND?>img/icons/google.png"
                     srcset="<?=PATH_FRONTEND?>img/icons/google.png 1x, <?=PATH_FRONTEND?>img/icons/google@2x.png 2x" width="20" height="20" class="lazy"/>&nbsp;&nbsp;
                Google
            </a>
        </div>
        <div class="form-group form-group--w30mob">
            <a class="btn btn-default btn-decor btn-lg s-fb"><i class="fab fa-facebook-f"></i></a>
        </div>
        <div class="form-group form-group--w30mob">
            <a class="btn btn-default btn-decor btn-lg s-vk" href="<?=$arResult["CALLBACK"]?>?provider=Vkontakte"><i class="fab fa-vk"></i></a>
        </div>
        <div class="form-group form-group--w30mob">
            <a class="btn btn-default btn-decor btn-lg s-tw"><i class="fab fa-twitter"></i></a>
        </div>
    </div>
    <div class="form-group">
        <input type="email" placeholder="E-mail *" required aria-required="true" class="form-control input-lg" name="USER_LOGIN" value="">
        <script>
            BX.ready(function() {
                var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                if (loginCookie)
                {
                    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                    var loginInput = form.elements["USER_LOGIN"];
                    loginInput.value = loginCookie;
                }
            });
        </script>
    </div>
    <div class="form-group">
        <input type="text" placeholder="Пароль *" required aria-required="true" class="form-control input-lg" name="USER_PASSWORD" value="" minlength="6">
    </div>
    <div class="form-group form-group--agree">
        <div class="radio">
            <label class="check-style check-style-agree">
                <input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" required aria-required="true" checked> Запомнить меня
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" class="btn btn-primary btn-decor btn-lg btn-block">Войти</button>
                <a href="#" class="btn btn-link btn-lg btn-simple btn-block auth-forgot">Забыли пароль?</a>
            </div>
        </div>
    </div>
</form>
