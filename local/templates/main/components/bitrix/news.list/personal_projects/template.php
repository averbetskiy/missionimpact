<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
$this->setFrameMode(true);
global $arHandBook,$USER;
?>
<div class="profile__main">
    <div class="profile__main-left"></div>
    <div class="profile__main-center">
        <div class="profile__projects-header">
            <div class="profile__projects-title"><p><?=$arHandBook['PROFILE_PROJECTS_TITLE']['UF_VALUE']?></p></div>
            <div class="profile__projects-text"><p><?=$arHandBook['PROFILE_PROJECTS_TEXT']['UF_VALUE']?></p></div>
        </div>
        <div class="profile__projects-list">
            <?$i=1;?>
            <?foreach ($arResult['ITEMS'] as $item){?>
				<?php if ($item['ID'] != 63 && $item['ID'] != 10445): ?>
                	<a href="#project<?=$i?>" class="profile__projects-item openProfilePopup">
				<?php else: ?>
					<a href="<?=$item['DETAIL_PAGE_URL']?>" class="profile__projects-item">	
				<?php endif; ?>
                    <div class="profile__projects-item__photo">
                        <?if($item['PREVIEW_PICTURE']['SRC']){?>
                            <img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="" loading="lazy">
                        <?}?>
                    </div>
                    <div class="profile__projects-item__inner">
                        <div class="profile__projects-item__content">
                            <div class="profile__projects-item__top">
                                <?if(in_array($item['ID'],$arResult['PROJECTS_USER'])){?>
                                    <div class="profile__projects-item__member"><?=$arHandBook['PROFILE_PROJECTS_MEMBER']['UF_VALUE']?></div>
                                <?}?>
                                <div class="profile__projects-item__tag"><?=$item['PROPERTIES']['type']['VALUE_ENUM']?></div>
                            </div>
                            <div class="profile__projects-item__title"><?=$item['NAME']?></div>
                            <div class="profile__projects-item__text"><?=$item['PREVIEW_TEXT']?></div>
                        </div>
                        <div class="profile__projects-item__link">
                            <div class="hoverMe" data-attr="<?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?>"><?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?></div>
                        </div>
                    </div>
                </a>
                <div class="profile__popup" id="project<?=$i?>">
                    <div class="profile__popup-overlay"></div>
                    <div class="profile__popup-inner">
                        <div class="profile__popup-close">x</div>
                        <div class="profile__popup-wrap profile__popup-project">
                            <div class="profile__popup-project__title profile__popup-title"><p><?=$item['NAME']?></p></div>
                            <div class="profile__popup-project__text"><p><?=$item['PREVIEW_TEXT']?></p></div>
                            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="profile__popup-projects__more hoverMe" data-attr="<?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?>"><?=$arHandBook['PROFILE_PROJECTS_EXPLORE']['UF_VALUE']?></a>
							<?php //var_dump($item); ?>
							
								<?if(!in_array($item['ID'],$arResult['PROJECTS_USER'])){?>
									<form action="" method="POST" class="profile__popup-project__form personal_projects_form validation_profile" data-project="<?=$i?>">
										<input type="hidden" value="personal_projects" name="action">
										<input type="hidden" value="<?=$USER->GetID()?>" name="user">
										<input type="hidden" value="<?=$item['ID']?>" name="project">
										<div class="profile__popup-project__form-title"><?=$arHandBook['PROFILE_PROJECTS_FORM_TITLE']['UF_VALUE']?></div>
										<div class="profile__popup-project__form-text"><?=$arHandBook['PROFILE_PROJECTS_FORM_TEXT']['UF_VALUE']?></div>
										<div class="profile__popup-form__group input_group">
											<label for="name"><?=$arHandBook['PROFILE_PROJECTS_USER_NAME']['UF_VALUE']?></label>
											<input type="text" name="NAME" placeholder="Ekaterina Gert" value="<?=$USER->GetLastName().' '.$USER->GetFirstName().' '.$USER->GetSecondName()?>" required aria-required="true" data-rule-nonumber="true">
										</div>
										<div class="profile__popup-form__group input_group">
											<label for="email"><?=$arHandBook['SIGN_IN_EMAIL']['UF_VALUE']?></label>
											<input type="email" name="LOGIN" placeholder="gert@mail.com" value="<?=$USER->GetEmail()?>" required aria-required="true">
										</div>
										<button class="profile__popup-form__button hoverMe" data-attr="<?=$arHandBook['SIGN_IN_BUTTON']['UF_VALUE']?>"><?=$arHandBook['SIGN_IN_BUTTON']['UF_VALUE']?></button>
									</form>
								<?}?>
								<div class="profile__popup-project__exist project_exist_<?=$i?>" <?if(!in_array($item['ID'],$arResult['PROJECTS_USER'])){?>style="display: none"<?}?>>
									<div class="profile__popup-project__exist-title"><?=$arHandBook['PROFILE_PROJECTS_EXIST_TITLE']['UF_VALUE']?></div>
									<div class="profile__popup-project__exist-text"><?=$arHandBook['PROFILE_PROJECTS_EXIST_TEXT']['UF_VALUE']?></div>
								</div>
                        </div>
                    </div>
                </div>
                <?$i++;?>
            <?}?>
            <a href="/solutions/" class="profile__projects-item __empty">
                <div class="profile__projects-item__inner">
                    <div class="profile__projects-item__content">
                        <div class="profile__projects-item__title"><?=$arHandBook['PROFILE_PROJECTS_LINK_ALL']['UF_VALUE']?></div>
                    </div>
                    <div class="profile__projects-item__link">
                        <div class="hoverMe" data-attr="<?=$arHandBook['PROFILE_PROJECTS_LINK_TEXT']['UF_VALUE']?>"><?=$arHandBook['PROFILE_PROJECTS_LINK_TEXT']['UF_VALUE']?></div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="profile__main-right"></div>
</div>
