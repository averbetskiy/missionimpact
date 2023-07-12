<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'profile');
?>

<div class="pageCourse pageCourse__noBottom">
	<div class="container">
		<div class="pageCourse__inner">
			<div class="pageCourse__inner-back">
				<a href="/courses/" class="hoverMe" data-attr="← Back to Course">← Back to Course</a>
			</div>
			<div class="pageCourse__inner-content">
				<div class="pageCourse__test">
					<div class="pageCourse__test-title">
						Human rights・Test
					</div>
					<div class="pageCourse__test-result">
						<div class="pageCourse__test-result__uptitle">Where did you go wrong</div>
						<div class="pageCourse__test-result__title">What type of human rights impact is the impact from the company's suppliers and contractors?</div>
						<div class="pageCourse__test-result__list">
							<div class="pageCourse__test-result__item">Direct</div>
							<div class="pageCourse__test-result__item" data-type="yes">Indirect</div>
							<div class="pageCourse__test-result__item" data-type="no">General</div>
						</div>
					</div>
					<div class="pageCourse__test-passed">
						<div class="pageCourse__test-passed__image"></div>
						<div class="pageCourse__test-passed__content">
							<div class="pageCourse__test-passed__title">Test successfully passed! </div>
							<div class="pageCourse__test-passed__text">You answered 3 out of 4 questions correctly. The certificate is now available to you in your profile</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>