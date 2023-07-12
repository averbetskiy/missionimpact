<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="test">
<?if (count($arResult["ERROR"])):?>
	<?=ShowError(implode("<br />", $arResult["ERROR"]))?>
<?endif?>
	<form id="start_test" action="<?=$APPLICATION->GetCurPageParam("testaction=Y", ["testaction", "s"]);?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="initquestioning" value="Y">
		<input type="hidden" name="testsubmit" value="Y">
	</form>
    <script>
        window.onload=function() {
            document.getElementById("start_test").submit();
        }
    </script>
</div>