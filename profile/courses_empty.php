<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'profile');
?>

<div class="profile__cover">
	<img src="/images/profile/cover.png" alt="">
</div>

<div class="profile">
	<div class="container">
		<div class="profile__top">
			<div class="profile__top-photo">
				<div class="profile__top-photo__progress">
					<?php $percent = 10; $percentCircle = $percent * 6.04; ?>
					<svg viewBox="0 0 196 196">
					  <circle cx="98" cy="98" r="96" stroke-dasharray="<?=$percentCircle;?> 900"> 
					  </circle>  
					 </svg>  
				</div>
				<div class="profile__top-photo__inner">
					EG
				</div>
			</div>
			<div class="profile__top-info">
				<div class="profile__member-name">Ekaterina Gert</div>
				<div class="profile__member-meta">
					<div class="profile__member-role">Newcomer</div>
					<div class="profile__member-progress">Profile is 15% complete</div>
				</div>
			</div>
			<div class="profile__top-tools">
				<!-- если есть новые уведомления, показываем data-status="new" -->
				<a href="#notify" class="profile__tools-notify openProfilePopup" data-status="new">
					<div class="profile__tools-notify__count hoverMe" data-attr="3 new messages">3 new messages</div>
					<div class="profile__tools-notify__icon">
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
							<path d="M8.99967 0C7.05475 0 5.18949 0.772617 3.81422 2.14788C2.43896 3.52315 1.66634 5.38841 1.66634 7.33333V13.3333H0.333008V14.6667H17.6663V13.3333H16.333V7.33333C16.333 5.38841 15.5604 3.52315 14.1851 2.14788C12.8099 0.772617 10.9446 0 8.99967 0ZM5.66634 16.6667V16H12.333V16.6667C12.333 17.5507 11.9818 18.3986 11.3567 19.0237C10.7316 19.6488 9.88373 20 8.99967 20C8.11562 20 7.26777 19.6488 6.64265 19.0237C6.01753 18.3986 5.66634 17.5507 5.66634 16.6667Z" fill="#1A1A1A"/>
						</svg>
					</div>
				</a>
				<a href="#settings" class="profile__tools-settings openProfilePopup">
					<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_2710_9501)">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M7.424 0H12.5707L12.7893 1.116V1.12L13.1493 2.9C13.66 3.12933 14.136 3.41467 14.5733 3.736L16.3667 3.12533L17.428 2.79067L17.984 3.76L19.4333 6.232L20 7.22267L19.156 7.97333L17.8107 9.13867C17.8533 9.40133 17.892 9.696 17.892 10C17.892 10.304 17.852 10.6 17.812 10.8613L19.1613 12.032L20 12.7773L19.4293 13.7747L17.984 16.24L17.428 17.2133L16.352 16.8693L14.5733 16.264C14.1294 16.592 13.6521 16.8723 13.1493 17.1L12.7893 18.88V18.884L12.5733 20H7.42667L7.20933 18.8813L6.84933 17.1C6.34655 16.8723 5.86923 16.592 5.42533 16.264L3.63467 16.8733L2.56933 17.2133L2.016 16.24L0.565333 13.7667L0 12.7773L0.842667 12.0267L2.18667 10.86C2.13722 10.5759 2.11047 10.2883 2.10667 10C2.10667 9.69733 2.14667 9.4 2.188 9.14L0.836 7.96667L0 7.224L0.568 6.22667L2.01467 3.76L2.568 2.78933L3.64533 3.13067L5.424 3.736C5.86789 3.40794 6.34521 3.12772 6.848 2.9L7.208 1.11733L7.424 0ZM10 6.66667C8.192 6.66667 6.72667 8.16 6.72667 10C6.72667 11.84 8.19333 13.3333 9.99867 13.3333C11.8053 13.3333 13.2707 11.84 13.2707 10C13.2707 8.16 11.804 6.66667 10 6.66667Z" fill="#1A1A1A"/>
					</g>
					<defs>
					<clipPath id="clip0_2710_9501">
					<rect width="20" height="20" fill="white"/>
					</clipPath>
					</defs>
					</svg>
				</a>
			</div>
		</div>
		<div class="profile__inner">
			<nav class="profile__menu">
				<a href="/profile/projects.php" class="hoverMe" data-attr="Projects">Projects</a>
				<a href="/profile/courses.php" class="hoverMe active" data-attr="Courses" class="active">Courses</a>
<!--				<a href="/profile/events.php" class="hoverMe" data-attr="Events">Events</a>-->
				<a href="/profile/profile.php" class="hoverMe" data-attr="Profile">Profile</a>
			</nav>
			<div class="profile__main">
				<div class="profile__main-left">
					<div class="profile__tabs-select">
						<div class="profile__tabs-select__item active">My Courses <span>3</span></div>
						<div class="profile__tabs-select__item">Passed 2</div>
					</div>
				</div>
				<div class="profile__main-center">
					<div class="profile__tabs-body">
						<div class="profile__tabs-body__item active">
							<a href="#" class="profile__courses-empty">
								<div class="profile__courses-empty__text">
									<p>There are no courses yet. You will receive a certificate for completing the course.</p>
								</div>
								<div class="profile__courses-empty__more">
									<div data-attr="Explore →" class="hoverMe">Explore →</div>
								</div>
							</a>
						</div>
						<div class="profile__tabs-body__item">
							<a href="#" class="profile__courses-empty">
								<div class="profile__courses-empty__text">
									<p>There are no courses yet. You will receive a certificate for completing the course.</p>
								</div>
								<div class="profile__courses-empty__more">
									<div data-attr="Explore →" class="hoverMe">Explore →</div>
								</div>
							</a>
						</div>
					</div>
					<div class="profile__courses-other">
						<div class="profile__courses-other__title">Other courses</div>
						<div class="profile__courses-other__list pageCourses__list">
							<a href="#other1" class="pageCourses__list-item openProfilePopup">
								<div class="pageCourses__list-item__top">
									<div class="pageCourses__item-media">
                                		<div class="courses__item-media__photo">
											<img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
										</div>
										<div class="pageCourses__item-media__content">
											<div class="pageCourses__item-media-time">4 modules and test</div>
											<div class="pageCourses__item-media-level">56 minutes</div>
										</div>
									</div>
									<div class="pageCourses__item-content">
										<div class="pageCourses__item-content__title">Введение в устойчивое развитие</div>
										<div class="pageCourses__item-content_meta">
											<span></span>
										</div>
									</div>
								</div>
								<div class="pageCourses__item-content__more hoverMe" data-attr="Explore →">Explore →</div>
							</a>
							<div class="profile__popup" id="other1">
								<div class="profile__popup-overlay"></div>
								<div class="profile__popup-inner">
									<div class="profile__popup-close">x</div>
									<div class="profile__popup-wrap profile__popup-courses">
										<div class="profile__popup-title">Human rights</div>
										<div class="profile__popup-courses__meta">
											<div class="profile__popup-courses__meta-item __count">4 modules and test</div>
											<div class="profile__popup-courses__meta-item __times">Duration: 56 minutes</div>
											<div class="profile__popup-courses__meta-item __certs">Certificate of completion</div>
										</div>
										<div class="profile__popup-courses__photo">
											<img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
										</div>
										<div class="profile__popup-courses__text">
											<p>This is an educational video about key sustainable practices at Rosatom. What aspects of the ESG agenda does the Corporation have? What subjects have priority for Rosatom?</p>
										</div>
										<div class="profile__popup-courses__program">
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">Module 1</div>
													<div class="profile__popup-courses__program-item__type">Video</div>
												</div>
												<div class="profile__popup-courses__program-item__title">Human rights in Rosatom</div>
												<div class="profile__popup-courses__program-item__text">
													<p>Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">Module 2</div>
													<div class="profile__popup-courses__program-item__type">Video</div>
												</div>
												<div class="profile__popup-courses__program-item__title">Human rights in Rosatom</div>
												<div class="profile__popup-courses__program-item__text">
													<p>Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">Module 3</div>
													<div class="profile__popup-courses__program-item__type">Video</div>
												</div>
												<div class="profile__popup-courses__program-item__title">Human rights in Rosatom</div>
												<div class="profile__popup-courses__program-item__text">
													<p>Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">Module 4</div>
													<div class="profile__popup-courses__program-item__type">Video</div>
												</div>
												<div class="profile__popup-courses__program-item__title">Human rights in Rosatom</div>
												<div class="profile__popup-courses__program-item__text">
													<p>Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it</p>
												</div>
											</div>
											<div class="profile__popup-courses__program-item">
												<div class="profile__popup-courses__program-item__meta">
													<div class="profile__popup-courses__program-item__index">Test</div>
												</div>
												<div class="profile__popup-courses__program-item__title">Certificate of completion</div>
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
											<div class="pageCourses__item-media-time">4 modules and test</div>
											<div class="pageCourses__item-media-level">56 minutes</div>
										</div>
									</div>
									<div class="pageCourses__item-content">
										<div class="pageCourses__item-content__title">Введение в устойчивое развитие</div>
										<div class="pageCourses__item-content_meta">
											<span></span>
										</div>
									</div>
								</div>
								<div class="pageCourses__item-content__more hoverMe" data-attr="Explore →">Explore →</div>
							</a>
							<div class="profile__popup" id="other2">
								<div class="profile__popup-overlay"></div>
								<div class="profile__popup-inner">
									<div class="profile__popup-close">x</div>
									<div class="profile__popup-wrap">
										<div class="popup__notify-title">Human rights</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="profile__main-right"></div>
			</div>
		</div>
	</div>
</div>

<div class="profile__popup" id="notify">
	<div class="profile__popup-overlay"></div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">x</div>
		<div class="profile__popup-wrap">
			<div class="popup__notify-title">Notifications</div>
			<div class="popup__notify-count">2 new messages</div>
			<div class="popup__notify-list">
				<div class="popup__notify-item" data-status="new">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <a href="#">Human-Centered Transformation</a> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<a href="#" data-attr="View details →" class="hoverMe">View details →</a>
						</div>
					</div>
				</div>
				<div class="popup__notify-item" data-status="new">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <a href="#">Human-Centered Transformation</a> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<a href="#" data-attr="View details →" class="hoverMe">View details →</a>
						</div>
					</div>
				</div>
				<div class="popup__notify-item">
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
							<a href="#" data-attr="View details →" class="hoverMe">View details →</a>
						</div>
					</div>
				</div>
				<div class="popup__notify-item">
					<div class="popup__notify-item__photo">
						<img src="/images/profile/cover.png" alt="">
					</div>
					<div class="popup__notify-item__content">
						<div class="popup__notify-item__top">
							<div class="popup__notify-item__meta">
								<div class="popup__notify-item__cat">Events</div>
								<div class="popup__notify-item__date">12 April at 12:00</div>
							</div>
							<div class="popup__notify-item__title">The <a href="#">Human-Centered Transformation</a> event will begin in 24 hours.</div>
							<div class="popup__notify-item__text">The event will be held online</div>
						</div>
						<div class="popup__notify-item__view">
							<a href="#" data-attr="View details →" class="hoverMe">View details →</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="profile__popup" id="settings">
	<div class="profile__popup-overlay"></div>
	<div class="profile__popup-inner">
		<div class="profile__popup-close">x</div>
		<div class="profile__popup-wrap">
			<div class="popup__settings-title">Settings</div>
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
								<div class="popup__settings-login__value">Ztd~ggp_Iy)uLuc</div>
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
							<div class="popup__settings-login__group">
								<label for="loginemail">E-mail</label>
								<input name="loginemail" id="loginemail" type="text" placeholder="gert@mail.com">
							</div>
							<div class="popup__settings-login__group">
								<label for="logincurrentpass">Current Password</label>
								<input name="logincurrentpass" id="logincurrentpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group __half">
								<label for="loginnewpass">New Password</label>
								<input name="loginnewpass" id="loginnewpass" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__group __half">
								<label for="loginnewpass2">New Password</label>
								<input name="loginnewpass2" id="loginnewpass2" type="text" placeholder="Enter Password">
							</div>
							<div class="popup__settings-login__sso">
								<div class="popup__settings-login__sso-title">Single Sign On</div>
								<div class="popup__settings-login__sso-list">
									<div class="popup__settings-login__sso-item">
										<div class="popup__settings-login__social" data-type="google">Google</div>
										<a href="#" class="popup__settings-login__social-unlink">Unlink</a>
									</div>
								</div>
							</div>
							<button type="button" class="popup__settings-button">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Notifications</div>
				<form action="#" method="post" class="popup__settings-form">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<input type="checkbox" name="reminder">
						<div class="popup__settings-form__checkbox-title">Reminders about failed modules</div>
						<div class="popup__settings-form__checkbox-text">These notifications will appears on the page «Notifications» inside of platform</div>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<input type="checkbox" name="digest">
						<div class="popup__settings-form__checkbox-title">Digest subscription</div>
						<div class="popup__settings-form__checkbox-text">Receive information materials by E-mail</div>
					</div>
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<input type="checkbox" name="emailnotify">
						<div class="popup__settings-form__checkbox-title">E-mail Notifications</div>
						<div class="popup__settings-form__checkbox-text">Information about activities on the platform</div>
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
							<div class="popup__settings-login__group __half">
								<label for="language">Interface language</label>
								<div class="popup__settings-login__select">
									<select name="language" id="language">
										<option value="English">English</option>
										<option value="Russian">Russian</option>
									</select>
									<div class="popup__settings-login__select-wrap">
										<div class="popup__settings-login__select-current">English</div>
										<div class="popup__settings-login__select-list">
											<div class="popup__settings-login__select-item">English</div>
											<div class="popup__settings-login__select-item">Russian</div>
										</div>
									</div>
								</div>
							</div>
							<div class="popup__settings-login__group __half">
								<label for="language">Timezone</label>
								<div class="popup__settings-login__select">
									<select name="timezone" id="timezone">
										<option value="Europe/Moscow">Europe/Moscow</option>
										<option value="Asia">Asia</option>
									</select>
									<div class="popup__settings-login__select-wrap">
										<div class="popup__settings-login__select-current">Europe/Moscow</div>
										<div class="popup__settings-login__select-list">
											<div class="popup__settings-login__select-item">Europe/Moscow</div>
											<div class="popup__settings-login__select-item">Asia</div>
										</div>
									</div>
								</div>
							</div>
							<div class="popup__settings-login__group">
								<label for="formatdate">Date format</label>
								<div class="popup__settings-login__select">
									<select name="formatdate" id="formatdate">
										<option value="dd/mm/yyyy">dd/mm/yyyy</option>
										<option value="dd.mm.yyyy">dd.mm.yyyy</option>
									</select>
									<div class="popup__settings-login__select-wrap">
										<div class="popup__settings-login__select-current">dd/mm/yyyy</div>
										<div class="popup__settings-login__select-list">
											<div class="popup__settings-login__select-item">dd/mm/yyyy</div>
											<div class="popup__settings-login__select-item">dd.mm.yyyy</div>
										</div>
									</div>
								</div>
							</div>
							<button type="button" class="popup__settings-button">Save Changes</button>
						</form>
					</div>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__cover">
					<div class="popup__settings-section__top">
						<div class="popup__settings-section__title">Cover</div>
						<div class="popup__settings-section__title">Optimal size 2800 x 400px</div>
					</div>
					<div class="popup__settings-cover__media">
						<div class="popup__settings-cover__image">
							<img src="/images/profile/cover.png" alt="">
						</div>
						<div class="popup__settings-cover__button"><span>Edit cover image</span></div>
					</div>
					<div class="popup__settings-cover__tools">
						<div class="popup__settings-cover__tools-left">
							<button class="popup__settings-cover__tools-save">Save Changes</button>
							<button class="popup__settings-cover__tools-replace">Replace</button>
						</div>
						<div class="popup__settings-cover__tools-right">
							<button class="popup__settings-cover__tools-cancel">Cancel</button>
						</div>
					</div>
				</div>
			</div>
			<div class="popup__settings-section">
				<div class="popup__settings-section__title">Account deleting</div>
				<div class="popup__settings-section__text">
					<p>You can permanently delete your account, all information.<br> Recovery will be impossible.</p></div>
				<div class="popup__settings-delete">
					<div class="popup__settings-form__group popup__settings-form__checkbox">
						<div class="popup__settings-form__checkbox-title">Yes, I understand and want to continue</div>
					</div>
					<div class="popup__settings-delete__action"><a href="#">Delete Account</a></div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>