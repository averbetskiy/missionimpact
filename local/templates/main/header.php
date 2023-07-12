<?php
use Bitrix\Main\Page\Asset;

/**
 * $APPLICATION
 */
global $USER;
global $APPLICATION;
global $arHandBook;
global $headerDark;
global $notificationsNew;
$arHandBook = Highload::getList(HL_HANDBOOK);
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><? $APPLICATION->ShowTitle() ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-config" content="/browserconfig.xml" />
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <?
	Asset::getInstance()->addCss('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css');
    Asset::getInstance()->addCss('/local/assets/css/main.css');
    Asset::getInstance()->addCss('/local/assets/css/media.css');
    Asset::getInstance()->addCss('/local/assets/css/custom.css');
	Asset::getInstance()->addCss('/local/assets/css/swiper.css');
	Asset::getInstance()->addCss('/local/assets/css/intltelinput.css');
	Asset::getInstance()->addCss('/local/assets/css/air.css');
    if ($USER->IsAdmin()) {

        $APPLICATION->ShowHead();

    } else {
        $APPLICATION->ShowCSS();
        $APPLICATION->ShowHeadScripts();
        $APPLICATION->ShowHeadStrings();
    }
    ?>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(70344037, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript>
        <div>
            <img src="https://mc.yandex.ru/watch/70344037" style="position:absolute; left:-9999px;" alt="" />
        </div>
    </noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-9CBPMK45Q1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-9CBPMK45Q1');
    </script>
</head>
<? if ($USER->IsAdmin()): ?>
    <div id="panel">
        <?
        $APPLICATION->ShowPanel();
        ?>
    </div>
    <style>
/*
        .bx-core .header{
            position: relative;
        }
*/
    </style>
<? endif ?>
<body data-lang="<?=($_COOKIE['mi_lang'] == 's2')?'ru':'en'?>" class="<?php $APPLICATION->ShowProperty('body_class', 'default');?>">
<div class="megamenu__overlay"></div>
<div class="search__overlay"></div>

<header class="header <?=($headerDark)?"_dark":""?>">
    <div class="container">
        <div class="header__wrap">
			<div class="header__logo-wrap">
				<a href="/" class="header__logo">
					<svg width="70" height="52" viewBox="0 0 70 52" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M15.2374 0V9.74928H17.5685V2.34561H64.5815V9.74928H66.9126V0H15.2374ZM64.5815 49.6521H17.5685V42.2484H15.2374V52H66.9172V42.2484H64.5815V49.6521ZM41.4346 29.8486C41.6526 30.3659 41.759 30.9239 41.7468 31.4857C41.7573 32.0459 41.651 32.602 41.4346 33.1182C41.2265 33.5921 40.9084 34.0088 40.5072 34.3335C40.0684 34.6799 39.5658 34.9355 39.0283 35.0855C38.3907 35.2655 37.7309 35.3527 37.0687 35.3446H35.8701V38.7839H33.5277V27.8194H37.2783C37.9026 27.8112 38.5253 27.8844 39.1309 28.0372C39.6391 28.1638 40.1176 28.3897 40.5391 28.7022C40.9292 29.0019 41.2374 29.3963 41.4346 29.8486ZM37.0915 33.2879C37.6705 33.321 38.2458 33.1762 38.7412 32.8729C38.9408 32.7255 39.0999 32.5295 39.2035 32.3033C39.3071 32.0771 39.3519 31.8281 39.3337 31.5797C39.3337 30.9607 39.14 30.5296 38.7572 30.2728C38.3744 30.016 37.8229 29.8876 37.1074 29.8876H35.8154V33.2879H37.0915ZM25.6162 36.0921L28.0316 27.8286L30.7363 27.8217L31.8415 38.7862H29.4899L28.8997 31.5018L26.6576 38.7862H24.4313L22.221 31.5339L21.6286 38.7862H19.2861L20.3753 27.8217H23.1553L25.6162 36.0921ZM56.5603 29.9976C56.1382 30.1224 55.749 30.3401 55.4209 30.6351C55.0949 30.9393 54.843 31.3151 54.6849 31.7333C54.4987 32.2377 54.409 32.7729 54.4206 33.3108C54.4191 34.471 54.7434 35.3446 55.3936 35.9316C56.0438 36.5186 56.918 36.8121 58.0163 36.8121C58.3227 36.8066 58.6279 36.772 58.9278 36.7089C59.2813 36.6414 59.6261 36.5337 59.9554 36.3879L60.4112 38.3506C60.2676 38.4239 60.1081 38.4973 59.9372 38.5684C59.7399 38.6498 59.5374 38.718 59.3311 38.7725C59.0644 38.84 58.7933 38.889 58.5199 38.9192C58.1711 38.9582 57.8204 38.9766 57.4694 38.9742C56.6997 38.9831 55.934 38.8614 55.2045 38.6143C54.5546 38.3911 53.9601 38.0298 53.4613 37.5549C52.9638 37.0694 52.5808 36.4778 52.3402 35.8238C52.0632 35.0619 51.9287 34.255 51.9437 33.4438C51.9291 32.5938 52.0633 31.7478 52.3402 30.9446C52.5756 30.2587 52.9655 29.6368 53.4794 29.1277C53.9932 28.6185 54.6172 28.2359 55.3024 28.0097C56.0774 27.7472 56.8911 27.6192 57.7087 27.6314C58.2445 27.6258 58.7793 27.6788 59.3037 27.7896C59.6952 27.8684 60.0771 27.9891 60.4431 28.1496L59.9304 30.1238C59.6013 30.0096 59.2627 29.9252 58.9187 29.8715C58.6246 29.8246 58.3277 29.7985 58.03 29.7936C57.5327 29.7879 57.0374 29.8566 56.5603 29.9976ZM61.4844 29.9885V27.8217L69.9997 27.8286V29.9885H66.9167V38.7931H64.5811V29.9885H61.4844ZM41.405 38.7862L45.126 27.8217H48.1612L51.8366 38.7862H49.4532L48.6761 36.3879H44.488L43.7087 38.7862H41.405ZM46.5798 29.7156L45.126 34.322H48.029L46.5798 29.7156ZM15.2373 38.7862H17.5729V27.8217H15.2373V38.7862ZM10.2129 24.1737H12.5645L11.4593 13.2069H8.76596L6.33692 21.4773L3.87826 13.2069H1.09147L0 24.1714H2.35156L2.94401 16.9191L5.1543 24.1737H7.38738L9.62273 16.8916L10.2129 24.1737ZM17.5729 24.1738H15.2373V13.2093H17.5729V24.1738ZM21.054 21.8327C20.8887 21.7591 20.7295 21.6725 20.5778 21.5736L20.0947 23.6073C20.3101 23.7232 20.5341 23.8221 20.7647 23.9031C21.0394 24.0023 21.3203 24.0834 21.6055 24.1462C21.9192 24.2172 22.2364 24.2723 22.5557 24.3113C22.886 24.3524 23.2186 24.3731 23.5514 24.3732C24.0965 24.3741 24.639 24.2969 25.1624 24.1439C25.629 24.01 26.0654 23.7865 26.4476 23.4858C26.8083 23.1947 27.0983 22.8246 27.2953 22.4036C27.5051 21.9421 27.6087 21.4389 27.5983 20.9316C27.5993 20.6098 27.5633 20.2889 27.4912 19.9754C27.4185 19.6737 27.2919 19.3878 27.1175 19.1317C26.9182 18.8484 26.6696 18.6037 26.3838 18.4094C26.0176 18.1629 25.6198 17.9677 25.2012 17.8293L24.7979 17.6894C24.3923 17.5549 24.0596 17.4304 23.7998 17.3157C23.5847 17.2254 23.3793 17.1133 23.1869 16.981C23.0533 16.8914 22.9456 16.7681 22.8747 16.6233C22.8136 16.4728 22.7841 16.3112 22.7881 16.1486C22.7783 15.9888 22.8124 15.8294 22.8868 15.6878C22.9612 15.5462 23.0729 15.428 23.2096 15.3461C23.5843 15.1526 24.0038 15.064 24.4242 15.0893C24.8071 15.0926 25.1887 15.1341 25.5635 15.2131C25.9741 15.2975 26.3738 15.4282 26.7552 15.6029L27.2884 13.5783C26.8875 13.415 26.4736 13.2861 26.0511 13.1931C25.4445 13.0637 24.8254 13.003 24.2054 13.012C23.6909 13.0098 23.179 13.0871 22.6878 13.2413C22.2499 13.3754 21.8405 13.59 21.4801 13.8741C21.142 14.147 20.8687 14.4924 20.6803 14.8853C20.446 15.4114 20.3514 15.9896 20.4058 16.5635C20.4601 17.1374 20.6615 17.6874 20.9902 18.1595C21.3898 18.6731 22.0202 19.0751 22.8815 19.3655L23.2552 19.4916C23.5765 19.6063 23.8522 19.7072 24.0801 19.7966C24.2792 19.8689 24.466 19.9718 24.6338 20.1015C24.7672 20.2084 24.874 20.345 24.946 20.5005C25.0179 20.6827 25.0521 20.8778 25.0462 21.0737C25.0555 21.2536 25.0213 21.433 24.9467 21.5967C24.8721 21.7604 24.7593 21.9035 24.6178 22.0138C24.3277 22.2324 23.8788 22.3417 23.2712 22.3417C22.9969 22.3425 22.7232 22.3187 22.4531 22.2706C22.1976 22.2261 21.9455 22.1632 21.6989 22.0826C21.4791 22.0125 21.2638 21.929 21.054 21.8327ZM29.9867 21.5736C30.1383 21.6725 30.2976 21.7591 30.4629 21.8327C30.6726 21.929 30.888 22.0125 31.1077 22.0826C31.3551 22.1635 31.6079 22.2264 31.8643 22.2706C32.1335 22.3189 32.4065 22.3427 32.68 22.3417C33.2877 22.3417 33.7365 22.2324 34.0267 22.0138C34.1681 21.9035 34.281 21.7604 34.3556 21.5967C34.4302 21.433 34.4643 21.2536 34.4551 21.0737C34.4609 20.8778 34.4268 20.6827 34.3548 20.5005C34.2829 20.345 34.176 20.2084 34.0426 20.1015C33.8748 19.9718 33.688 19.8689 33.4889 19.7966C33.2611 19.7072 32.9854 19.6063 32.6641 19.4916L32.2904 19.3655C31.429 19.0751 30.7986 18.6731 30.3991 18.1595C30.0703 17.6874 29.8689 17.1374 29.8146 16.5635C29.7603 15.9896 29.8549 15.4114 30.0892 14.8853C30.2776 14.4918 30.5518 14.1462 30.8913 13.8741C31.2505 13.5896 31.6593 13.375 32.0967 13.2413C32.5879 13.0871 33.0997 13.0098 33.6143 13.012C34.2343 13.003 34.8534 13.0637 35.46 13.1931C35.8825 13.2861 36.2964 13.415 36.6973 13.5783L36.1527 15.5938C35.7713 15.4191 35.3715 15.2883 34.9609 15.204C34.5899 15.1256 34.2121 15.0842 33.833 15.0802C33.4126 15.0548 32.9932 15.1435 32.6185 15.337C32.4817 15.4188 32.37 15.537 32.2957 15.6786C32.2213 15.8202 32.1871 15.9796 32.1969 16.1395C32.193 16.302 32.2224 16.4636 32.2835 16.6141C32.3545 16.7589 32.4622 16.8823 32.5957 16.9718C32.7881 17.1041 32.9935 17.2163 33.2087 17.3065C33.4684 17.4212 33.8011 17.5458 34.2067 17.6803L34.61 17.8201C35.0291 17.959 35.4277 18.1542 35.7949 18.4002C36.0796 18.5952 36.3273 18.8398 36.5264 19.1225C36.7007 19.3786 36.8274 19.6645 36.9001 19.9663C36.9722 20.2798 37.0081 20.6006 37.0072 20.9224C37.0176 21.4298 36.914 21.933 36.7041 22.3944C36.5071 22.8154 36.2172 23.1855 35.8564 23.4767C35.4742 23.7773 35.0378 24.0008 34.5713 24.1347C34.0478 24.2878 33.5054 24.365 32.9603 24.364C32.6274 24.3639 32.2949 24.3433 31.9645 24.3021C31.6452 24.2632 31.3281 24.2081 31.0143 24.137C30.7291 24.0743 30.4483 23.9931 30.1735 23.894C29.9435 23.8134 29.7202 23.7145 29.5059 23.5982L29.9867 21.5736ZM39.585 24.1738H41.9206V13.2093H39.585V24.1738ZM49.8793 24.3617C49.1447 24.3715 48.4143 24.2472 47.7237 23.9948C47.092 23.7614 46.5199 23.3894 46.0489 22.9057C45.5654 22.3985 45.1963 21.7924 44.9666 21.1287C44.7006 20.3446 44.5719 19.5199 44.586 18.6914C44.5717 17.8622 44.7068 17.0372 44.9848 16.2564C45.223 15.5932 45.5972 14.9877 46.0831 14.4794C46.5493 13.9987 47.1149 13.6269 47.7397 13.3903C48.4048 13.14 49.11 13.0149 49.8201 13.0212C50.5876 13.0085 51.3506 13.1415 52.0691 13.4132C52.7004 13.6564 53.2695 14.0387 53.7348 14.5322C54.202 15.0467 54.5547 15.6556 54.7693 16.3183C55.2591 17.9181 55.2456 19.631 54.7306 21.2228C54.4972 21.888 54.1197 22.4926 53.6254 22.9929C53.1533 23.4571 52.5843 23.8096 51.9597 24.0246C51.2902 24.2547 50.5867 24.3686 49.8793 24.3617ZM49.9568 22.2981C50.3318 22.2992 50.7029 22.2211 51.046 22.0688C51.3805 21.9196 51.6744 21.6915 51.9028 21.4039C52.1588 21.0707 52.3462 20.6896 52.4542 20.2827C52.5942 19.7596 52.6602 19.2193 52.6502 18.6777C52.6502 17.4349 52.3904 16.5239 51.8709 15.9446C51.6129 15.6577 51.2956 15.4312 50.9413 15.281C50.587 15.1309 50.2043 15.0608 49.8201 15.0756C49.4474 15.0759 49.0789 15.154 48.7377 15.3049C48.396 15.4527 48.0944 15.6807 47.8582 15.9698C47.5852 16.3026 47.3828 16.6881 47.2634 17.1025C47.1136 17.6183 47.0421 18.1541 47.0515 18.6914C47.0405 19.2353 47.1175 19.7774 47.2794 20.2964C47.4085 20.7075 47.6177 21.0887 47.8946 21.4176C48.1436 21.7068 48.4555 21.9343 48.8061 22.0826C49.1716 22.2304 49.5629 22.3029 49.9568 22.2958V22.2981ZM64.3307 24.1738H66.917L66.9102 13.2093H64.6315V20.6978L60.4912 13.2093H57.7568V24.1829H60.0355V16.4605L64.3307 24.1738Z"
							  fill="#1A1A1A" />
					</svg>
				</a>
			</div>
            <?$APPLICATION->IncludeComponent("bitrix:menu","top",Array(
                    "ROOT_MENU_TYPE" => "top",
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "top",
                    "USE_EXT" => "Y",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "Y",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => "",
                    "MENU_ITEMS_ELEMENT" => 4
                )
            );?>
			<div class="header__right">
				<?
				$lang = $_COOKIE['mi_lang'];
				if(!$lang){
					$lang = 's1';
				}
				if($lang == 's2'){
					$langText = 'En';
				}else{
					$langText = 'Ru';
				}
				?>
				<div class="header__search-open">
					<svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<circle cx="10" cy="10" r="9" stroke="#1A1A1A" stroke-width="2"/>
					<rect x="17.1758" y="14.2993" width="11.4851" height="3.25214" transform="rotate(40 17.1758 14.2993)" fill="#1A1A1A"/>
					</svg>
				</div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:search.title",
                    "main",
                    array(
                        "CATEGORY_0" => array(
                            0 => "iblock_catalog",
                        ),
                        "CATEGORY_0_TITLE" => "",
                        "CATEGORY_0_iblock_catalog" => array(
                            0 => "1",
                        ),
                        "CHECK_DATES" => "N",
                        "CONTAINER_ID" => "title-search",
                        "INPUT_ID" => "title-search-input",
                        "NUM_CATEGORIES" => "1",
                        "ORDER" => "rank",
                        "PAGE" => "#SITE_DIR#search/",
                        "SHOW_INPUT" => "Y",
                        "SHOW_OTHERS" => "N",
                        "TOP_COUNT" => "5",
                        "USE_LANGUAGE_GUESS" => "Y",
                        "COMPONENT_TEMPLATE" => "main",
                        "PLACEHOLDER" => "Поиск по каталогу товаров"
                    ),
                    false
                ); ?>
                <div class="header__profile">
                    <?if(!$USER->IsAuthorized()){?>
                        <a href="#sign" class="header__profile-sign openLoginPopup"><?=$arHandBook['SIGN_IN']['UF_VALUE'];?></a>
                    <?}else{?>
                        <!-- если есть новые уведомления - выводим у div'a с классом header__profile-photo атрибут data-notify="true" -->
                            <?
							$userId = $USER->GetID();
                            $photoUser = \Bitrix\Main\UserTable::getRow([
                            	'filter'=>['ID'=>$userId],
                                'select'=>['UF_PHOTO']]);
                            $firstName = $USER->GetFirstName();
                            $lastName = $USER->GetLastName();
							 $notificationsNew = NotificationsUser::countNew($userId);
                            ?>
							<div class="header__profile-photo __icon" <?=($notificationsNew>0)?'data-notify="true"':''?>>
								<?if($photoUser['UF_PHOTO']){?>
									<div class="header__profile-photo__media">
										<img src="<?=CFile::GetPath($photoUser['UF_PHOTO'])?>" class="header_photo_user">
									</div>
								<?}else{?>
									<?=strtoupper(mb_substr($firstName,0,1).mb_substr($lastName,0,1))?>
								<?}?>
                        	</div>
							<div class="header__profile-menu">
								<div class="header__profile-overlay"></div>
								<div class="header__profile-menu__wrap">
									<div class="header__profile-menu__top">
										 <a href="/personal/profile/" class="header__profile-photo">
                                             <?if($photoUser['UF_PHOTO']){?>
												<div class="header__profile-photo__media">
                                                 <img src="<?=CFile::GetPath($photoUser['UF_PHOTO'])?>" class="header_photo_user">
											 	</div>
											<?}else{?>
                                                 <?=strtoupper(mb_substr($firstName,0,1).mb_substr($lastName,0,1))?>
                                             <?}?>
										</a>
										<div class="header__profile-menu__info">
											<div class="header__profile-menu__name"><?=$firstName." ".$lastName;?></div>
											<div class="header__profile-menu__role"><?$APPLICATION->ShowViewContent('USER_CUSTOMER_STATUS');?></div>
										</div>
									</div>
									<div class="header__profile-menu__list">
										<a href="/personal/projects/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_PROJECTS']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_PROJECTS']['UF_VALUE']?></a>
										<a href="/personal/courses/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_COURSES']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_COURSES']['UF_VALUE']?></a>
										<!--<a href="/personal/events/">My Events</a>-->
										<a href="/personal/profile/" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_PROFILE']['UF_VALUE']?>" class="hoverMe"><?=$arHandBook['HEADER_MENU_PROFILE_PROFILE']['UF_VALUE']?></a>
									</div>
									<div class="header__profile-menu__list">
										<div class="header__profile-menu__list-item" <?=($notificationsNew>0)?'data-notify="true"':''?>>
											<a href="/personal/projects/#notify" class="hoverMe openProfilePopup" data-attr="<?=$arHandBook['HEADER_MENU_PROFILE_NOTIFY']['UF_VALUE']?>"><?=$arHandBook['HEADER_MENU_PROFILE_NOTIFY']['UF_VALUE']?></a>
										</div>
										<a href="/personal/projects/#settings" class="hoverMe openProfilePopup" data-attr="<?=$arHandBook['PROFILE_SETTINGS']['UF_VALUE'];?>"><?=$arHandBook['PROFILE_SETTINGS']['UF_VALUE'];?></a>
									</div>
									<div class="header__profile-menu__list">
										<a href="/?logout=yes&<?=bitrix_sessid_get()?>" class="hoverMe" data-attr="<?=$arHandBook['PROFILE_SIGN_OUT']['UF_VALUE'];?>"><?=$arHandBook['PROFILE_SIGN_OUT']['UF_VALUE'];?></a>
									</div>
								</div>
							</div>
                    <?}?>
                </div>
				<div class="header__lang">
					<?if(!\Bitrix\Main\Config\Option::get( "askaron.settings", "UF_LANG_RU")){?>
						<a href="javascript:void(0)" class="header__lang-current hoverMe" data-attr="<?=$langText?>">
							<?=$langText?>
						</a>
					<?}?>
				</div>
			</div>
            <div class="header__menu_mob">
                <span></span>
            </div>
        </div>
    </div>
    <?$APPLICATION->IncludeComponent("bitrix:menu","top_mobile",Array(
            "ROOT_MENU_TYPE" => "top",
            "MAX_LEVEL" => "2",
            "CHILD_MENU_TYPE" => "left",
            "USE_EXT" => "Y",
            "DELAY" => "N",
            "ALLOW_MULTI_SELECT" => "Y",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "MENU_CACHE_GET_VARS" => "",
            "MENU_ITEMS_ELEMENT" => 4
        )
    );?>
</header>

<div class="login__popup" id="sign">
    <div class="login__popup-overlay"></div>
    <div class="login__popup-wrap">
        <div class="login__popup-inner">
            <div class="login__popup-close">x</div>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.auth.form",
                "main",
                [
                    "REGISTER_URL" => SITE_DIR."auth/registration/",
                    "PROFILE_URL" => SITE_DIR."auth/forgot-password/",
                    "SHOW_ERRORS" => "Y",
                    "FORGOT_PASSWORD_URL" => SITE_DIR."auth/forgot-password/?forgot-password=yes",
                    "CHANGE_PASSWORD_URL" => SITE_DIR."auth/change-password/?change-password=yes",
					"SUCCESS_PAGE" => "/personal/profile/"
                ]
            );
            ?>
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:system.auth.forgotpasswd",
                "main",
                Array()
            );
            ?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:main.register",
				"main",
				Array(
					"USER_PROPERTY_NAME" => "",
					"SHOW_FIELDS" => array("LAST_NAME","NAME","EMAIL"),
					"REQUIRED_FIELDS" => array("LAST_NAME","NAME","EMAIL"),
					"AUTH" => "Y",
					"USE_BACKURL" => "Y",
					"SUCCESS_PAGE" => "/personal/profile/",
					"SET_TITLE" => "N",
				)
			);?>
        </div>
    </div>
</div>
	
<?
//if($USER->IsAuthorized()){
//	$APPLICATION->IncludeComponent(
//    "bitrix:main.profile",
//    "settings",
//    Array(
//        "CHECK_RIGHTS" => "N",
//        "SEND_INFO" => "N",
//        "SET_TITLE" => "Y",
//        "USER_PROPERTY" => array(),
//        "USER_PROPERTY_NAME" => ""
//    )
//);
//}
?>