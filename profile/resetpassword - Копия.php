<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty('body_class', 'header__transparent profileSample');
?>

<div class="profileSample">
	<div class="profileSample__box">
		<div class="profileSample__box-title">Set your new password</div>
		<form action="#" method="POST" class="login__popup-form">
			<div class="login__popup-form__group">
				<div class="login__popup-form__name">
					<label for="password">Password</label>
				</div>
				<input type="text" name="password" placeholder="Enter password">
			</div>
			<div class="login__popup-form__group">
				<div class="login__popup-form__name">
					<label for="repeat">Repeat</label>
				</div>
				<input type="text" name="confirmpassword" placeholder="Confirm new password">
			</div>
			<button type="submit" class="login__popup-form__button hoverMe" data-attr="Save new password">Save new password</button>
		</form>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>