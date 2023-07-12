<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
?>
<form class="search" data-block="header-search-form" action="<?=$arResult["FORM_ACTION"]?>">
    <div id="clearable" class="search-input">
        <div class="search-input__icon icon-search">
            <svg width="20" height="20">
                <use xlink:href="#search"></use>
            </svg>
        </div>
        <div class="search-input__input">
            <input type="text"
                   name="q" value=""
                   size="40"
                   maxlength="50"
                   autocomplete="off"
                   placeholder="Поиск материала ...">
        </div>
        <div class="search-input__icon icon-cross">
            <svg width="14" height="14">
                <use xlink:href="#cross"></use>
            </svg>
        </div>
    </div>
</form>