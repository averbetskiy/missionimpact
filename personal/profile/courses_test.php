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
					<div class="pageCourse__test-text">
						<p>To receive a certificate at the end of viewing, you must pass a test. You must answer 3 out of 4 questions correctly to qualify.</p>
					</div>
					<div class="pageCourse__test-inner">
						<form action="#" method="POST" class="pageCourse__test-list">
								<fieldset class="pageCourse__test-item">
									<legend>What are the three levels of human rights observance?</legend>
									<div>
										<input type="radio" id="q1_1" name="q1" value="q1_1" checked>
										<label for="q1_1">Mandatory, voluntary, corporate</label>
									</div>
									<div>
										<input type="radio" id="q1_2" name="q1" value="q1_2">
										<label for="q1_2">International, state, corporate</label>
									</div>
									<div>
										<input type="radio" id="q1_3" name="q1" value="q1_3">
										<label for="q1_3">Personal, public, corporate</label>
									</div>
								</fieldset>
								<fieldset class="pageCourse__test-item">
									<legend>What are the three levels of human rights observance?</legend>
									<div>
										<input type="radio" id="q2_1" name="q2" value="q2_1" checked>
										<label for="q2_1">Employees</label>
									</div>
									<div>
										<input type="radio" id="q2_2" name="q2" value="q2_2">
										<label for="q2_2">Suppliers and contractors</label>
									</div>
									<div>
										<input type="radio" id="q2_3" name="q2" value="q2_3">
										<label for="q2_3">Suppliers and contractors</label>
									</div>
									<div>
										<input type="radio" id="q2_4" name="q2" value="q2_4">
										<label for="q2_4">Suppliers and contractors</label>
									</div>
									<div>
										<input type="radio" id="q2_5" name="q2" value="q2_5">
										<label for="q2_5">Local population in the regions of presence</label>
									</div>
								</fieldset>
								<fieldset class="pageCourse__test-item">
									<legend>What type of human rights impact is the impact from the company's suppliers and contractors?</legend>
									<div>
										<input type="radio" id="q3_1" name="q3" value="q3_1" checked>
										<label for="q3_1">Direct</label>
									</div>
									<div>
										<input type="radio" id="q3_2" name="q3" value="q3_2">
										<label for="q3_2">Indirect</label>
									</div>
									<div>
										<input type="radio" id="q3_3" name="q3" value="q3_3">
										<label for="q3_3">General</label>
									</div>
								</fieldset>
								<fieldset class="pageCourse__test-item">
									<legend>Is it true that human rights in a company can only be enshrined in a Human Rights Policy?</legend>
									<div>
										<input type="radio" id="q4_1" name="q4" value="q4_1" checked>
										<label for="q4_1">True</label>
									</div>
									<div>
										<input type="radio" id="q4_2" name="q4" value="q4_2">
										<label for="q4_2">False</label>
									</div>
								</fieldset>
							<button class="pageCourse__test-button hoverMe" data-attr="Check result" type="button">Check result</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>