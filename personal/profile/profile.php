<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('body_class', 'profile');
global $USER;
if(!$USER->IsAuthorized()){
    LocalRedirect('/');
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<?$APPLICATION->IncludeComponent(
    "bitrix:main.profile",
    "cover",
    Array(
        "CHECK_RIGHTS" => "N",
        "SEND_INFO" => "N",
        "SET_TITLE" => "Y",
        "USER_PROPERTY" => array(),
        "USER_PROPERTY_NAME" => ""
    )
);?>
<div class="profile">
    <div class="container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.profile",
            "header",
            Array(
                "CHECK_RIGHTS" => "N",
                "SEND_INFO" => "N",
                "SET_TITLE" => "Y",
                "USER_PROPERTY" => array(),
                "USER_PROPERTY_NAME" => ""
            )
        );?>
        <div class="profile__inner">
            <nav class="profile__menu">
                <a href="/personal/projects/" class="hoverMe" data-attr="Projects">Projects</a>
                <a href="/personal/courses/" class="hoverMe" data-attr="Courses" class="active">Courses</a>
                <!--				<a href="/profile/events.php" class="hoverMe" data-attr="Events">Events</a>-->
                <a href="/personal/profile/" class="hoverMe active" data-attr="Profile"><?=$arHandBook['PROFILE_PROFILE']['UF_VALUE']?></a>
            </nav>

            <?$APPLICATION->IncludeComponent(
                "bitrix:main.profile",
                "main",
                Array(
                    "CHECK_RIGHTS" => "N",
                    "SEND_INFO" => "N",
                    "SET_TITLE" => "Y",
                    "USER_PROPERTY" => array(),
                    "USER_PROPERTY_NAME" => ""
                )
            );?>
        </div>
    </div>
</div>
<div class="profile__popup" id="notify">
	<div class="profile__popup-overlay"></div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">x</div>
		<div class="profile__popup-wrap profile__popup-notify">
			<div class="popup__notify-title profile__popup-title">Notifications</div>
			<div class="popup__notify-count">2 new messages</div>
			<div class="popup__notify-list">
				<a href="#" class="popup__notify-item" data-status="new">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <span>Human-Centered Transformation</span> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<div data-attr="View details →" class="hoverMe">View details →</div>
						</div>
					</div>
				</a>
				<a href="#" class="popup__notify-item" data-status="new">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <span>Human-Centered Transformation</span> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<div data-attr="View details →" class="hoverMe">View details →</div>
						</div>
					</div>
				</a>
				<a href="#" class="popup__notify-item">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title" data-status="success">Your profile has been verified</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<div data-attr="View details →" class="hoverMe">View details →</div>
						</div>
					</div>
				</a>
				<a href="#" class="popup__notify-item">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <span>Human-Centered Transformation</span> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<div data-attr="View details →" class="hoverMe">View details →</div>
						</div>
					</div>
				</div>
				<a href="#" class="popup__notify-item" data-type="success">
					<div class="popup__notify-item__photo"></div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Profile</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">Your profile has been verified</div>
							<div class="popup__notify-item__text">Your profile has been verified. More courses are now available to you. </div>
						</div>
						<div class="popup__notify-item__view">
							<div data-attr="View details →" class="hoverMe">View details →</div>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>

<?
//$APPLICATION->IncludeComponent(
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
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>