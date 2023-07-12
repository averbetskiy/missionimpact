<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('body_class', 'profile');
global $USER;
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
                <a href="/profile/projects.php" class="hoverMe" data-attr="Projects">Projects</a>
                <a href="/profile/courses.php" class="hoverMe" data-attr="Courses" class="active">Courses</a>
                <!--				<a href="/profile/events.php" class="hoverMe" data-attr="Events">Events</a>-->
                <a href="/profile/profile.php" class="hoverMe active" data-attr="Profile"><?=$arHandBook['PROFILE_PROFILE']['UF_VALUE']?></a>
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

<div class="profile__popup" id="settings">
	<div class="profile__popup-overlay"></div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">x</div>
		<div class="profile__popup-wrap">
			<div class="popup__settings-title profile__popup-title">Settings</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Login details</div>
				<div class="popup__settings-sections">
					<div class="popup__settings-login__section active">
						<div class="popup__settings-login__row">
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">E-mail</div>
								<div class="popup__settings-login__value">gert@mail.com</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">Password</div>
								<div class="popup__settings-login__value passwordHidden">Ztd~ggp_Iy)uLuc</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">Single Sign On</div>
								<div class="popup__settings-login__value">
									<div class="popup__settings-login__social" data-type="google">Google</div>
								</div>
							</div>
						</div>
						<div class="popup__settings-login__edit">
							<a href="#" class="hoverMe" data-attr="Edit →">Edit →</a>
						</div>
					</div>
					<div class="popup__settings-login__section">
						<form action="" method="post" class="popup__settings-login__form">
							<div class="popup__settings-login__group profile__popup-form__group">
								<label for="loginemail">E-mail</label>
								<input name="loginemail" id="loginemail" type="text" placeholder="gert@mail.com">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group">
								<label for="logincurrentpass">Current Password</label>
								<input name="logincurrentpass" id="logincurrentpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half">
								<label for="loginnewpass">New Password</label>
								<input name="loginnewpass" id="loginnewpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half">
								<label for="loginnewpass2">New Password</label>
								<input name="loginnewpass2" id="loginnewpass2" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__sso">
								<div class="popup__settings-login__sso-title">Single Sign On</div>
								<div class="popup__settings-login__sso-list">
									<div class="popup__settings-login__sso-item">
										<div class="popup__settings-login__social" data-type="google">Google</div>
										<a href="#" class="popup__settings-login__social-unlink hoverMe" data-attr="Unlink">Unlink</a>
									</div>
								</div>
							</div>
							<button type="button" class="popup__settings-button hoverMe" data-attr="Save Changes">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Notifications</div>
				<form action="#" method="post" class="popup__settings-form">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<label>
							<input type="checkbox" name="reminder" checked/><i></i>
							<div class="popup__settings-form__checkbox-content">
								<div class="popup__settings-form__checkbox-title">Reminders about failed modules</div>
								<div class="popup__settings-form__checkbox-text">These notifications will appears on the page «Notifications» inside of platform</div>
							</div>
						</label>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<label>
							<input type="checkbox" name="digest"/><i></i>
							<div class="popup__settings-form__checkbox-content">
								<div class="popup__settings-form__checkbox-title">Digest subscription</div>
								<div class="popup__settings-form__checkbox-text">Receive information materials by E-mail</div>
							</div>
						</label>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<label>
							<input type="checkbox" name="emailnotify"/><i></i>
							<div class="popup__settings-form__checkbox-content">
								<div class="popup__settings-form__checkbox-title">E-mail Notifications</div>
								<div class="popup__settings-form__checkbox-text">Information about activities on the platform</div>
							</div>
						</label>
					</div>
				</form>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Preferences</div>
				<div class="popup__settings-sections">
					<div class="popup__settings-login__section active">
						<div class="popup__settings-login__row">
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">Interface language</div>
								<div class="popup__settings-login__value">English</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">Timezone</div>
								<div class="popup__settings-login__value">Europe/Moscow [GMT+3]</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">Date format</div>
								<div class="popup__settings-login__value">dd/mm/yyyy</div>
							</div>
						</div>
						<div class="popup__settings-login__edit">
							<a href="#" class="hoverMe" data-attr="Edit →">Edit →</a>
						</div>
					</div>
					<div class="popup__settings-login__section">
						<form action="#" method="post" class="popup__settings-login__form">
							<div class="popup__settings-login__group profile__popup-form__group __half popup__settings-login__select">
								<label for="language">Interface language</label>
								<select id="normal-select-1" id="language" placeholder-text="English">
									<option value="eng" class="select-dropdown__list-item">English</option>
									<option value="rus" class="select-dropdown__list-item">Русский</option>
								</select>
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half popup__settings-login__select">
								<label for="timezone">Timezone</label>
								<select id="normal-select-2" id="timezone" placeholder-text="Europe/Moscow">
									<option value="Europe/Moscow" class="select-dropdown__list-item">Europe/Moscow</option>
									<option value="Asia/Omsk" class="select-dropdown__list-item">Asia/Omsk</option>
								</select>
							</div>
							<div class="popup__settings-login__group profile__popup-form__group popup__settings-login__select">
								<label for="formatdate">Date format</label>
								<select id="normal-select-3" id="formatdate" placeholder-text="dd/mm/yyyy">
									<option value="dd/mm/yyyy" class="select-dropdown__list-item">dd/mm/yyyy</option>
									<option value="dd.mm.yyyy" class="select-dropdown__list-item">dd.mm.yyyy</option>
								</select>
							</div>
							<button type="button" class="popup__settings-button hoverMe" data-attr="Save Changes">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__cover">
					<div class="popup__settings-section__top">
						<div class="popup__settings-section__title">Cover</div>
						<div class="popup__settings-cover__title">Optimal size 2800 x 400px</div>
					</div>
					<div class="popup__settings-cover__media">
						<div class="popup__settings-cover__image">
							<img src="/images/profile/cover.png" alt="">
						</div>
						<div class="popup__settings-cover__button"><span>Edit cover image</span></div>
					</div>
					<form action="#" class="popup__settings-cover__form">
						<input type="file" class="popup__settings-cover__form-input">
						<div class="popup__settings-cover__media">
							<div class="popup__settings-cover__image">
								<img src="/images/profile/cover.png" alt="">
							</div>
						</div>
						<div class="popup__settings-cover__tools">
							<div class="popup__settings-cover__tools-left">
								<button class="popup__settings-cover__tools-save">Save Changes</button>
								<a href="#" class="popup__settings-cover__tools-replace">Replace</a>
							</div>
							<div class="popup__settings-cover__tools-right">
								<a href="#" class="popup__settings-cover__tools-cancel">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Account deleting</div>
				<div class="popup__settings-section__text">
					<p>You can permanently delete your account, all information.<br> Recovery will be impossible.</p></div>
				<div class="popup__settings-delete">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<label>
							<input type="checkbox" name="removedaccount"/><i></i>
							<div class="popup__settings-form__checkbox-content">
								<div class="popup__settings-form__checkbox-title">Yes, I understand and want to continue</div>
							</div>
						</label>
					</div>
					<div class="popup__settings-delete__action"><a href="#" class="hoverMe" data-attr="Delete Account">Delete Account</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>