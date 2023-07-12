<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'profile');
?><?$APPLICATION->IncludeComponent(
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
			 <?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"personal",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "personal",
		"COMPONENT_TEMPLATE" => "profile",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_ITEMS_ELEMENT" => "4",
		"ROOT_MENU_TYPE" => "personal",
		"USE_EXT" => "N"
	)
);?>
			<div class="profile__main">
				<div class="profile__main-left">
					<div class="profile__tabs-select">
						<div class="profile__tabs-select__item active">
							 My Courses 3
						</div>
						<div class="profile__tabs-select__item">
							 Passed 2<br>
 <br>
						</div>
					</div>
				</div>
				<div class="profile__main-center">
					 <?$APPLICATION->IncludeComponent(
	"aelita:test",
	"",
	Array(
		"ADD_GROUP_CHAIN" => "N",
		"ADD_TEST_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"COUNT_TEST" => "20",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "",
		"PROFILE_DETAIL_URL" => "",
		"SEF_MODE" => "N",
		"SET_TITLE_GROUP" => "N",
		"SET_TITLE_TEST" => "N",
		"SHOW_ALL" => "N",
		"SHOW_NO_GROUP" => "N",
		"TOP_TESTS" => "N",
		"VARIABLE_ALIASES" => Array("GROUP_CODE"=>"GROUP_CODE","TEST_CODE"=>"TEST_CODE")
	)
);?>
					<div class="profile__courses-other">
						<div class="profile__courses-other__title">
							 Other courses <br>
							 <?$APPLICATION->IncludeComponent(
	"aelita:test.profile", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"REPEATED_URL" => "",
		"ADD_TEST_CHAIN" => "N",
		"SET_TITLE_TEST" => "N",
		"ADD_QUESTIONING_CHAIN" => "N",
		"SET_TITLE_QUESTIONING" => "N",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/personal/test/",
		"COUNT_TEST" => "20",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"SEF_URL_TEMPLATES" => array(
			"tests" => "",
			"test" => "#TEST_CODE#/",
			"questioning" => "#TEST_CODE#/#QUESTIONING_CODE#/",
		)
	),
	false
);?><br>
						</div>
						<div class="profile__courses-other__list pageCourses__list">
 <a href="#other1" class="pageCourses__list-item openProfilePopup">
							<div class="pageCourses__list-item__top">
								<div class="pageCourses__item-media">
									<div class="courses__item-media__photo">
 <img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
									</div>
									<div class="pageCourses__item-media__content">
										<div class="pageCourses__item-media-time">
											 4 modules and test
										</div>
										<div class="pageCourses__item-media-level">
											 56 minutes
										</div>
									</div>
								</div>
								<div class="pageCourses__item-content">
									<div class="pageCourses__item-content__title">
										 Введение в устойчивое развитие
									</div>
									<div class="pageCourses__item-content_meta">
									</div>
								</div>
							</div>
							<div class="pageCourses__item-content__more hoverMe" data-attr="Explore →">
								 Explore →
							</div>
 </a>
							<div class="profile__popup" id="other1">
								<div class="profile__popup-overlay">
								</div>
								<div class="profile__popup-inner">
									<div class="profile__popup-close">
										 x
									</div>
									<div class="profile__popup-wrap profile__popup-courses">
										<div class="profile__popup-title">
											 Human rights
										</div>
										<div class="profile__popup-courses__meta">
											<div class="profile__popup-courses__meta-item __count">
												 4 modules and test
											</div>
											<div class="profile__popup-courses__meta-item __times">
												 Duration: 56 minutes
											</div>
											<div class="profile__popup-courses__meta-item __certs">
												 Certificate of completion
											</div>
										</div>
										<div class="profile__popup-courses__photo">
 <img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
										</div>
										<div class="profile__popup-courses__text">
											<p>
												 This is an educational video about key sustainable practices at Rosatom. What aspects of the ESG agenda does the Corporation have? What subjects have priority for Rosatom?
											</p>
										</div>
										<div class="profile__popup-courses__program">
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">
														 Module 1
													</div>
													<div class="profile__popup-courses__program-item__type">
														 Video
													</div>
												</div>
												<div class="profile__popup-courses__program-item__title">
													 Human rights in Rosatom
												</div>
												<div class="profile__popup-courses__program-item__text">
													<p>
														 Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it
													</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">
														 Module 2
													</div>
													<div class="profile__popup-courses__program-item__type">
														 Video
													</div>
												</div>
												<div class="profile__popup-courses__program-item__title">
													 Human rights in Rosatom
												</div>
												<div class="profile__popup-courses__program-item__text">
													<p>
														 Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it
													</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">
														 Module 3
													</div>
													<div class="profile__popup-courses__program-item__type">
														 Video
													</div>
												</div>
												<div class="profile__popup-courses__program-item__title">
													 Human rights in Rosatom
												</div>
												<div class="profile__popup-courses__program-item__text">
													<p>
														 Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it
													</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">
														 Module 4
													</div>
													<div class="profile__popup-courses__program-item__type">
														 Video
													</div>
												</div>
												<div class="profile__popup-courses__program-item__title">
													 Human rights in Rosatom
												</div>
												<div class="profile__popup-courses__program-item__text">
													<p>
														 Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it
													</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">
														 Test
													</div>
												</div>
												<div class="profile__popup-courses__program-item__title">
													 Certificate of completion
												</div>
											</div>
										</div>
 <a href="#" class="profile__popup-courses__start">Start this course</a>
									</div>
								</div>
							</div>
 <a href="#other2" class="pageCourses__list-item openProfilePopup">
							<div class="pageCourses__list-item__top">
								<div class="pageCourses__item-media">
									<div class="courses__item-media__photo">
 <img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
									</div>
									<div class="pageCourses__item-media__content">
										<div class="pageCourses__item-media-time">
											 4 modules and test
										</div>
										<div class="pageCourses__item-media-level">
											 56 minutes
										</div>
									</div>
								</div>
								<div class="pageCourses__item-content">
									<div class="pageCourses__item-content__title">
										 Введение в устойчивое развитие
									</div>
									<div class="pageCourses__item-content_meta">
									</div>
								</div>
							</div>
							<div class="pageCourses__item-content__more hoverMe" data-attr="Explore →">
								 Explore →
							</div>
 </a>
							<div class="profile__popup" id="other2">
								<div class="profile__popup-overlay">
								</div>
								<div class="profile__popup-inner">
									<div class="profile__popup-close">
										 x
									</div>
									<div class="profile__popup-wrap">
										<div class="popup__notify-title">
											 Human rights
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="profile__main-right">
				</div>
			</div>
		</div>
	</div>
</div>
<div class="profile__popup" id="notify">
	<div class="profile__popup-overlay">
	</div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">
			 x
		</div>
		<div class="profile__popup-wrap profile__popup-notify">
			<div class="popup__notify-title profile__popup-title">
				 Notifications
			</div>
			<div class="popup__notify-count">
				 2 new messages
			</div>
			<div class="popup__notify-list">
 <a href="#" class="popup__notify-item" data-status="new">
				<div class="popup__notify-item__photo">
 <img src="/images/profile/cover.png" alt="">
				</div>
				<div class="popup__notify-item__content">
					<div class="popup__notify-item__top">
						<div class="popup__notify-item__meta">
							<div class="popup__notify-item__cat">
								 Events
							</div>
							<div class="popup__notify-item__date">
								 12 April at 12:00
							</div>
						</div>
						<div class="popup__notify-item__title">
							 The Human-Centered Transformation event will begin in 24 hours.
						</div>
						<div class="popup__notify-item__text">
							 The event will be held online
						</div>
					</div>
					<div class="popup__notify-item__view">
						<div data-attr="View details →" class="hoverMe">
							 View details →
						</div>
					</div>
				</div>
 </a> <a href="#" class="popup__notify-item" data-status="new">
				<div class="popup__notify-item__photo">
 <img src="/images/profile/cover.png" alt="">
				</div>
				<div class="popup__notify-item__content">
					<div class="popup__notify-item__top">
						<div class="popup__notify-item__meta">
							<div class="popup__notify-item__cat">
								 Events
							</div>
							<div class="popup__notify-item__date">
								 12 April at 12:00
							</div>
						</div>
						<div class="popup__notify-item__title">
							 The Human-Centered Transformation event will begin in 24 hours.
						</div>
						<div class="popup__notify-item__text">
							 The event will be held online
						</div>
					</div>
					<div class="popup__notify-item__view">
						<div data-attr="View details →" class="hoverMe">
							 View details →
						</div>
					</div>
				</div>
 </a> <a href="#" class="popup__notify-item">
				<div class="popup__notify-item__photo">
 <img src="/images/profile/cover.png" alt="">
				</div>
				<div class="popup__notify-item__content">
					<div class="popup__notify-item__top">
						<div class="popup__notify-item__meta">
							<div class="popup__notify-item__cat">
								 Events
							</div>
							<div class="popup__notify-item__date">
								 12 April at 12:00
							</div>
						</div>
						<div class="popup__notify-item__title" data-status="success">
							 Your profile has been verified
						</div>
						<div class="popup__notify-item__text">
							 The event will be held online
						</div>
					</div>
					<div class="popup__notify-item__view">
						<div data-attr="View details →" class="hoverMe">
							 View details →
						</div>
					</div>
				</div>
 </a> <a href="#" class="popup__notify-item">
				<div class="popup__notify-item__photo">
 <img src="/images/profile/cover.png" alt="">
				</div>
				<div class="popup__notify-item__content">
					<div class="popup__notify-item__top">
						<div class="popup__notify-item__meta">
							<div class="popup__notify-item__cat">
								 Events
							</div>
							<div class="popup__notify-item__date">
								 12 April at 12:00
							</div>
						</div>
						<div class="popup__notify-item__title">
							 The Human-Centered Transformation event will begin in 24 hours.
						</div>
						<div class="popup__notify-item__text">
							 The event will be held online
						</div>
					</div>
					<div class="popup__notify-item__view">
						<div data-attr="View details →" class="hoverMe">
							 View details →
						</div>
					</div>
				</div>
 </a>
			</div>
 <a href="#" class="popup__notify-item"> </a><a href="#" class="popup__notify-item" data-type="success">
			<div class="popup__notify-item__photo">
			</div>
			<div class="popup__notify-item__content">
				<div class="popup__notify-item__top">
					<div class="popup__notify-item__meta">
						<div class="popup__notify-item__cat">
							 Profile
						</div>
						<div class="popup__notify-item__date">
							 12 April at 12:00
						</div>
					</div>
					<div class="popup__notify-item__title">
						 Your profile has been verified
					</div>
					<div class="popup__notify-item__text">
						 Your profile has been verified. More courses are now available to you.
					</div>
				</div>
				<div class="popup__notify-item__view">
					<div data-attr="View details →" class="hoverMe">
						 View details →
					</div>
				</div>
			</div>
 </a>
		</div>
	</div>
</div>
<div class="profile__popup" id="settings">
	<div class="profile__popup-overlay">
	</div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">
			 x
		</div>
		<div class="profile__popup-wrap">
			<div class="popup__settings-title profile__popup-title">
				 Settings
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">
					 Login details
				</div>
				<div class="popup__settings-sections">
					<div class="popup__settings-login__section active">
						<div class="popup__settings-login__row">
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 E-mail
								</div>
								<div class="popup__settings-login__value">
 <a href="mailto:gert@mail.com">gert@mail.com</a>
								</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 Password
								</div>
								<div class="popup__settings-login__value passwordHidden">
									 Ztd~ggp_Iy)uLuc
								</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 Single Sign On
								</div>
								<div class="popup__settings-login__value">
									<div class="popup__settings-login__social" data-type="google">
										 Google
									</div>
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
 <label for="loginemail">E-mail</label> <input name="loginemail" id="loginemail" type="text" placeholder="gert@mail.com">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group">
 <label for="logincurrentpass">Current Password</label> <input name="logincurrentpass" id="logincurrentpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half">
 <label for="loginnewpass">New Password</label> <input name="loginnewpass" id="loginnewpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half">
 <label for="loginnewpass2">New Password</label> <input name="loginnewpass2" id="loginnewpass2" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__sso">
								<div class="popup__settings-login__sso-title">
									 Single Sign On
								</div>
								<div class="popup__settings-login__sso-list">
									<div class="popup__settings-login__sso-item">
										<div class="popup__settings-login__social" data-type="google">
											 Google
										</div>
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
				<div class="popup__settings-section__title">
					 Notifications
				</div>
				<form action="#" method="post" class="popup__settings-form">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
 <label> <input type="checkbox" name="reminder" checked="">
						<div class="popup__settings-form__checkbox-content">
							<div class="popup__settings-form__checkbox-title">
								 Reminders about failed modules
							</div>
							<div class="popup__settings-form__checkbox-text">
								 These notifications will appears on&nbsp;the page «Notifications» inside of&nbsp;platform
							</div>
						</div>
 </label>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
 <label> <input type="checkbox" name="digest">
						<div class="popup__settings-form__checkbox-content">
							<div class="popup__settings-form__checkbox-title">
								 Digest subscription
							</div>
							<div class="popup__settings-form__checkbox-text">
								 Receive information materials by E-mail
							</div>
						</div>
 </label>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
 <label> <input type="checkbox" name="emailnotify">
						<div class="popup__settings-form__checkbox-content">
							<div class="popup__settings-form__checkbox-title">
								 E-mail Notifications
							</div>
							<div class="popup__settings-form__checkbox-text">
								 Information about activities on the platform
							</div>
						</div>
 </label>
					</div>
				</form>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">
					 Preferences
				</div>
				<div class="popup__settings-sections">
					<div class="popup__settings-login__section active">
						<div class="popup__settings-login__row">
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 Interface language
								</div>
								<div class="popup__settings-login__value">
									 English
								</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 Timezone
								</div>
								<div class="popup__settings-login__value">
									 Europe/Moscow [GMT+3]
								</div>
							</div>
							<div class="popup__settings-login__col">
								<div class="popup__settings-login__label">
									 Date format
								</div>
								<div class="popup__settings-login__value">
									 dd/mm/yyyy
								</div>
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
								<select id="normal-select-1" placeholder-text="English">
									<option value="eng" class="select-dropdown__list-item">English</option>
									<option value="rus" class="select-dropdown__list-item">Русский</option>
								</select>
							</div>
							<div class="popup__settings-login__group profile__popup-form__group __half popup__settings-login__select">
 <label for="timezone">Timezone</label>
								<select id="normal-select-2" placeholder-text="Europe/Moscow">
									<option value="Europe/Moscow" class="select-dropdown__list-item">Europe/Moscow</option>
									<option value="Asia/Omsk" class="select-dropdown__list-item">Asia/Omsk</option>
								</select>
							</div>
							<div class="popup__settings-login__group profile__popup-form__group popup__settings-login__select">
 <label for="formatdate">Date format</label>
								<select id="normal-select-3" placeholder-text="dd/mm/yyyy">
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
						<div class="popup__settings-section__title">
							 Cover
						</div>
						<div class="popup__settings-cover__title">
							 Optimal size 2800 x 400px
						</div>
					</div>
					<div class="popup__settings-cover__media">
						<div class="popup__settings-cover__image">
 <img src="/images/profile/cover.png" alt="">
						</div>
						<div class="popup__settings-cover__button">
							 Edit cover image
						</div>
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
 <button class="popup__settings-cover__tools-save">Save Changes</button> <a href="#" class="popup__settings-cover__tools-replace">Replace</a>
							</div>
							<div class="popup__settings-cover__tools-right">
 <a href="#" class="popup__settings-cover__tools-cancel">Cancel</a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">
					 Account deleting
				</div>
				<div class="popup__settings-section__text">
					<p>
						 You can permanently delete your account, all information.<br>
						 Recovery will be impossible.
					</p>
				</div>
				<div class="popup__settings-delete">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
 <label> <input type="checkbox" name="removedaccount">
						<div class="popup__settings-form__checkbox-content">
							<div class="popup__settings-form__checkbox-title">
								 Yes, I understand and want to continue
							</div>
						</div>
 </label>
					</div>
					<div class="popup__settings-delete__action">
 <a href="#" class="hoverMe" data-attr="Delete Account">Delete Account</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>