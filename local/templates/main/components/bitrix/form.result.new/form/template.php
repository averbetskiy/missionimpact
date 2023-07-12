<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $arHandBook,$USER;
?>
<?if(!$USER->IsAuthorized()){?>
<a href="#sign" class="partners__button_login openLoginPopup">︎<?=$arHandBook['LETS_MODAL_BUTTON']['UF_VALUE']?></a>
<?}?>
<div class="lets">
    <div class="lets__overlay"></div>
    <div class="lets__wrap">
        <div class="lets__inner">
            <button class="lets__close">✕</button>
			<?if ($arResult["isFormNote"] != "Y"){?>
            	<div class="lets__box" id="lets__form">
                	<div class="lets__box-top">
                    	<div class="lets__box-title"><?=$arHandBook['LETS_MODAL_TITLE']['UF_VALUE']?></div>
                    	<div class="lets__box-desc"><?=$arHandBook['LETS_MODAL_DESC']['UF_VALUE']?></div>
                	</div>
                	<div class="lets__box-wrap">
                    	<div class="lets__box-info"><?=$arHandBook['LETS_MODAL_INFO']['UF_VALUE']?></div>
                    	<div class="lets__form-wrap" data-succes="<?=$arHandBook['FORM_TEXT_SUCCES']['UF_VALUE']?>">
                        	<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

							<?=$arResult["FORM_NOTE"]?>
							<?=$arResult["FORM_HEADER"]?>
                            	<input type="hidden" name="action" value="form">
                            	<?$textQuestion = 0;?>
                            	<?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
                                	if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'dropdown'){?>
                                    	<div class="lets__form-select">
                                        	<div class="lets__select-emulate">
                                            	<div class="lets__select_emulate-title"><?=$arQuestion['STRUCTURE'][0]['MESSAGE']?></div>
                                            	<div class="lets__select_emulate-list">
                                                	<?foreach ($arQuestion['STRUCTURE'] as $item){?>
                                                    	<div class="lets__select_emulate-item"><?=$item['MESSAGE']?></div>
                                                	<?}?>
                                            	</div>
                                        	</div>
                                        	<select
                                            	name="form_dropdown_<?=$FIELD_SID?>"
                                            	<?if($arQuestion['REQUIRED']=='Y'){?>
                                                required aria-required="true"
                                            	<?}?>
                                            	class="form-group"
                                        >
                                            	<?foreach ($arQuestion['STRUCTURE'] as $item){?>
                                             	   <option value="<?=$item['ID']?>"><?=$item['MESSAGE']?></option>
                                            	<?}?>
                                        	</select>
                                    	</div>
                                	<?}?>
                                	<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'text'){?>
                                    	<?if($textQuestion == 0){?>
                                        	<div class="lets__form-groups">
                                    	<?}?>
                                    	<?$textQuestion++;?>
                                    	<?
                                    	$type = 'text';
                                    	if($arQuestion['STRUCTURE'][0]['ID'] == 8 || $arQuestion['STRUCTURE'][0]['ID'] == 18){
                                        	$type = 'tel';
                                    	}
                                    	if($arQuestion['STRUCTURE'][0]['ID'] == 9 || $arQuestion['STRUCTURE'][0]['ID'] == 19){
                                        	$type = 'email';
                                    	}
                                    	?>
                                        	<div class="lets__form-group form-group">
                                            	<label for="name_<?=$arQuestion['STRUCTURE'][0]['ID']?>"><?=$arQuestion["CAPTION"]?></label>
                                            	<input type="<?=$type?>"
                                                   id="name_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                                                   name="form_text_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                                                   placeholder="<?=$arQuestion['STRUCTURE'][0]['VALUE']?>"
                                                    <?if($arQuestion['REQUIRED']=='Y'){?>
                                                        required aria-required="true"
                                                    <?}?>
                                                    <?if($type == 'tel'){?>
                                                        data-rule-phone="true"
                                                    <?}?>
                                                    <?if(in_array($arQuestion['STRUCTURE'][0]['ID'],[6,7,16,17])){?>
                                                        data-rule-nonumber="true"
                                                    <?}?>
                                            	>
                                        	</div>
                                	<?}?>
                                	<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'textarea'){?>
                                    	</div>
                                    	<div class="lets__form-textarea form-group">
                                        	<label for="message"><?=$arQuestion["CAPTION"]?></label>
                                        	<textarea id="message"
                                                  name="form_textarea_<?=$arQuestion['STRUCTURE'][0]['ID']?>"
                                                  placeholder="<?=$arQuestion['STRUCTURE'][0]['VALUE']?>"
                                               <?if($arQuestion['REQUIRED']=='Y'){?>
                                                   required aria-required="true"
                                               <?}?>
                                        	></textarea>
                                    	</div>
                                	<?}?>
                            	<?}?>
                            	<div class="lets__form-tools">
                                	<div class="lets__form-policy"><?=htmlspecialchars_decode($arHandBook['LETS_MODAL_PRIVACY']['UF_VALUE'])?></div>
                                	<button class="lets__form-button"><?=$arHandBook['LETS_MODAL_SEND']['UF_VALUE']?></button>
                            	</div>
                            	<?=$arResult["FORM_FOOTER"]?>

                    		</div>
                		</div>
            		</div>
			<?}?>
				<div class="lets__box hidden" id="lets__success">
					<div class="lets__box-inner">
						<div class="lets__success-title"><?=$arHandBook['lets_success-title']['UF_VALUE']?></div>
						<div class="lets__success-text"><?=$arHandBook['lets_success-text']['UF_VALUE']?></div>
						<a href="/" class="lets__success-button button hoverMe" data-attr="<?=$arHandBook['lets_success-button']['UF_VALUE']?>"><?=$arHandBook['lets_success-button']['UF_VALUE']?></a>
					</div>
				</div>
        </div>
    </div>
</div>
