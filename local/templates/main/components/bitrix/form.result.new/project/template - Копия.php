<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
global $USER;
$formSettings = array(
	$arHandBook['FORM_LABEL_NAME']['UF_VALUE'] => array(),
	$arHandBook['FORM_LABEL_COMPANY']['UF_VALUE'] => array(),
	$arHandBook['FORM_LABEL_PHONE']['UF_VALUE'] => array("RULE" => "PHONE"),
	$arHandBook['FORM_LABEL_EMAIL']['UF_VALUE'] => array("RULE" => "EMAIL")
);
if($USER->IsAuthorized()){
	$userId = $USER->GetID();
	$userData = CUser::GetByID($userId)->Fetch();
	$formSettings[$arHandBook['FORM_LABEL_NAME']['UF_VALUE']]["VALUE"] = $userData['NAME'];
	$formSettings[$arHandBook['FORM_LABEL_COMPANY']['UF_VALUE']]["VALUE"] = $userData['WORK_COMPANY'];
	$formSettings[$arHandBook['FORM_LABEL_PHONE']['UF_VALUE']]["VALUE"] = $userData['PERSONAL_PHONE'];
	$formSettings[$arHandBook['FORM_LABEL_EMAIL']['UF_VALUE']]["VALUE"] = $userData['EMAIL'];
}
?>
<div class="callback">
    <div class="container">
        <?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

        <?=$arResult["FORM_NOTE"]?>
        <?=$arResult["FORM_HEADER"]?>
        <input type="hidden" name="action" value="form_callback">
        <fieldset class="callback__content">
            <legend class="callback__title"><?=$arResult['arForm']['DESCRIPTION']?></legend>
                <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
                    if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'radio'){?>
                        <div class="callback__text">
                            <?=$arQuestion['CAPTION']?>
                        </div>
                        <div class="callback__list">
                            <?foreach ($arQuestion['STRUCTURE'] as $item){?>
                                <div class="callback__item">
                                    <input type="radio" id="subject_<?=$item['ID']?>" name="form_radio_<?=$FIELD_SID?>" value="<?=$item['ID']?>"
                                        <?if($item['FIELD_PARAM']){?>checked<?}?>
                                        <?if($arQuestion['REQUIRED']=='Y'){?>
                                            aria-required="true"
                                        <?}?>
                                    >
                                    <label for="subject_<?=$item['ID']?>"><?=$item['MESSAGE']?></label>
                                </div>
                            <?}?>
                        </div>
                    <?}?>
                <?}?>
            <div class="callback__info"><?=$arHandBook['FORM_TEXT_PROJECT']['UF_VALUE']?></div>
        </fieldset>
        <div class="callback__form">
            <div class="callback__form-wrap">
                <?php
					foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
						if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text'){
							if ($formSettings) {
									
								// подставляем значения в форму
								$inputValue = "";
								if ($formSettings[$arQuestion['CAPTION']] && $formSettings[$arQuestion['CAPTION']] != "")
									$inputValue = $formSettings[$arQuestion['CAPTION']]['VALUE'];
																			
								// делаем подстановку типа поля
								$type = "text";
								$addName = "";
								if ($formSettings[$arQuestion['CAPTION']]['RULE'] == "EMAIL"):
									$type = "email";
									$addName = " email";
								endif;
									
								if ($formSettings[$arQuestion['CAPTION']]['RULE'] == "PHONE"):
									$maskPhone = true;
									$addName = " CALLBACK_PHONE";
								else:
									$maskPhone = false;
								endif;
							}
						?>
						<div class="profile__popup-form__group __half form-group<?=($maskPhone) ? ' __inner-input':'';?>">
							<?=($maskPhone) ? '<div class="profile__popup-form__group-input">' : '';?>
							<input type="<?=$type;?>"
								   id="name_<?=$arQuestion['STRUCTURE'][0]['ID']?><?=$addName;?>"
								   name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?><?=$addName;?>"
								   placeholder="<?=$arQuestion['STRUCTURE'][0]['VALUE']?>"
								   <?=($inputValue != "") ? ' value="'.$inputValue.'"' : ''; ?>
								   <?if($arQuestion['REQUIRED']=='Y'){?>
								   	required aria-required="true"
								   <?}?>
								   <?=($maskPhone) ? ' PHONE_MASK="true"' : ''; ?>
								   <?if($addName == " email") {?> pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" <?}?>
							>
							<?=($maskPhone) ? '</div>' : '';?>
                        </div>
                    	<?}if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea'){?>
                        	<div class="profile__popup-form__group form-group">
                            	<label for="message"><?=$arQuestion['CAPTION']?></label>
                            	<textarea
                                    id="messageWrite"
                                    name="form_textarea_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                                    placeholder="<?=$arQuestion['STRUCTURE'][0]['VALUE']?>"
                                               <?if($arQuestion['REQUIRED']=='Y'){?>
                                                   required aria-required="true"
                                   <?}?>></textarea>
                        	</div>
                    	<?}?>
                	<?}?>
            </div>
            <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
                if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'file'){?>
                    <label class="callback__form-file">
                        <input type="file" name="form_file_<?=$arQuestion['STRUCTURE'][0]['ID']?>">
						<div class="hoverMe" data-attr="<?=$arQuestion['CAPTION']?>"><?=$arQuestion['CAPTION']?></div>
                    </label>
                <?}?>
            <?}?>
            <div class="callback__form-tools">
                <div class="callback__form-policy">
                    <input type="checkbox" name="policy" id="policy">
                    <label for="policy"><?=htmlspecialchars_decode($arHandBook['LETS_MODAL_PRIVACY']['UF_VALUE'])?></label>
                </div>
                <button class="callback__form-button hoverMe button" data-attr="<?=$arHandBook['FORM_PROJECT_BUTTON']['UF_VALUE']?>"><?=$arHandBook['FORM_PROJECT_BUTTON']['UF_VALUE']?></button>
            </div>
        </div>
        <?=$arResult["FORM_FOOTER"]?>
        <div class="callback__success hidden">
            <div class="callback__success-title"><?=$arHandBook['FORM_THANK_YOU']['UF_VALUE']?></div>
            <div class="callback__success-text"><?=$arHandBook['FORM_PROJECT_TEXT_SUCCESS']['UF_VALUE']?></div>
        </div>
    </div>
</div>