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
			<div class="pageCourse__inner-content pageCourse__modulecard">
				<div class="pageCourse__modulecard-uptitle">Human rights</div>
				<div class="pageCourse__modulecard-number">Module 1</div>
				<div class="pageCourse__modulecard-video">
<!--
					<div class="pageCourse__modulecard-video__title">
						Human rights in Rosatom
					</div>
-->
					<div class="pageCourse__modulecard-video__iframe">
						<iframe width="560" height="315" src="https://www.youtube.com/embed/K4TOrB7at0Y" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
					</div>
				</div>
				<div class="pageCourse__modulecard-title">Human rights in Rosatom</div>
				<div class="pageCourse__modulecard-text">
					<p>Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it. Short description in a few lines. Can you hide it</p>
				</div>
			</div>
			<div class="pageCourse__inner-right">
				<div class="pageCourse__modulecard-other">
					<a href="#" class="pageCourse__module" data-type="video">
						<div class="pageCourse__module-media">
							<div class="pageCourse__module-photo">
								<img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
							</div>
							<div class="pageCourse__module-content">
								<div class="pageCourse__module-name">Module 2</div>
								<div class="pageCourse__module-title">Human rights in Rosatom</div>
							</div>
						</div>
						<div class="pageCourse__module-info">
							<div class="pageCourse__module-type">Video</div>
							<div class="pageCourse__module-time">00:14</div>
						</div>
						<div class="pageCourse__module-status__wrap">
							<div class="pageCourse__module-status" style="width:50%"></div>
						</div>
					</a>
					<a href="#" class="pageCourse__module" data-type="video">
						<div class="pageCourse__module-media">
							<div class="pageCourse__module-photo">
								<img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
							</div>
							<div class="pageCourse__module-content">
								<div class="pageCourse__module-name">Module 3</div>
								<div class="pageCourse__module-title">Human rights in Rosatom</div>
							</div>
						</div>
						<div class="pageCourse__module-info">
							<div class="pageCourse__module-type">Video</div>
							<div class="pageCourse__module-time">00:14</div>
						</div>
						<div class="pageCourse__module-status__wrap">
							<div class="pageCourse__module-status" style="width:50%"></div>
						</div>
					</a>
					<a href="#" class="pageCourse__module" data-type="video">
						<div class="pageCourse__module-media">
							<div class="pageCourse__module-photo">
								<img src="/upload/iblock/ec5/ud9xtdhl0svfucxxmtlc6rqvw9rybx5u.jpeg" alt="">
							</div>
							<div class="pageCourse__module-content">
								<div class="pageCourse__module-name">Module 4</div>
								<div class="pageCourse__module-title">Human rights in Rosatom</div>
							</div>
						</div>
						<div class="pageCourse__module-info">
							<div class="pageCourse__module-type">Video</div>
							<div class="pageCourse__module-time">00:14</div>
						</div>
						<div class="pageCourse__module-status__wrap">
							<div class="pageCourse__module-status" style="width:50%"></div>
						</div>
					</a>
					<div class="pageCourse__module" data-type="test">
						<div class="pageCourse__module-media">
							<div class="pageCourse__module-photo"></div>
							<div class="pageCourse__module-content">
								<div class="pageCourse__module-title __close">Test will be available after completing all modules</div>
							</div>
						</div>
						<div class="pageCourse__module-info">
							<div class="pageCourse__module-type">Test</div>
							<div class="pageCourse__module-time">00:05</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>