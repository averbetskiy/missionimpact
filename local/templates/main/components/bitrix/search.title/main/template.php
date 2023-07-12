<? use Bitrix\Main\Context;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
$request = Context::getCurrent()->getRequest();
$q = $request->get("q");
$opened = '';
?>
<div class="header__search-form__wrap">
    <div class="container">
        <form action="<?=$arResult["FORM_ACTION"]?>" class="header__search-form">
            <div class="header__search-form__loop">
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="10" r="9" stroke="#1A1A1A" stroke-width="2"/>
                    <rect x="17.1758" y="14.2993" width="11.4851" height="3.25214" transform="rotate(40 17.1758 14.2993)" fill="#1A1A1A"/>
                </svg>
            </div>
			<button class="header__search-form__loop-btn">
                <svg width="26" height="25" viewBox="0 0 26 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="10" cy="10" r="9" stroke="#1A1A1A" stroke-width="2"/>
                    <rect x="17.1758" y="14.2993" width="11.4851" height="3.25214" transform="rotate(40 17.1758 14.2993)" fill="#1A1A1A"/>
                </svg>
			</button>
            <div class="header__search-form__input">
                <input type="text" name="q" value="<?=$q?>" class="header__search-form__input" placeholder="<?=$arHandBook['SEARCH_PLACEHOLDER']['UF_VALUE']?>">
            </div>
            <a href="#" class="header__search-form__microphone" id="voice-trigger">
                <svg width="20" height="26" viewBox="0 0 20 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0013 16.6667C8.89019 16.6667 7.94575 16.2779 7.16797 15.5001C6.39019 14.7223 6.0013 13.7779 6.0013 12.6667V4.66675C6.0013 3.55564 6.39019 2.61119 7.16797 1.83341C7.94575 1.05564 8.89019 0.666748 10.0013 0.666748C11.1124 0.666748 12.0569 1.05564 12.8346 1.83341C13.6124 2.61119 14.0013 3.55564 14.0013 4.66675V12.6667C14.0013 13.7779 13.6124 14.7223 12.8346 15.5001C12.0569 16.2779 11.1124 16.6667 10.0013 16.6667ZM8.66797 26.0001V21.9001C6.35686 21.589 4.44575 20.5556 2.93464 18.8001C1.42352 17.0445 0.667969 15.0001 0.667969 12.6667H3.33464C3.33464 14.5112 3.98464 16.0834 5.28464 17.3834C6.58464 18.6834 8.15686 19.3334 10.0013 19.3334C11.8457 19.3334 13.418 18.6834 14.718 17.3834C16.018 16.0834 16.668 14.5112 16.668 12.6667H19.3346C19.3346 15.0001 18.5791 17.0445 17.068 18.8001C15.5569 20.5556 13.6457 21.589 11.3346 21.9001V26.0001H8.66797Z" fill="#1A1A1A"/>
                </svg>
            </a>
            <a href="#" class="header__search-form__clear button hoverMe" data-attr="<?=$arHandBook['SEARCH_CLEAR']['UF_VALUE']?>"><?=$arHandBook['SEARCH_CLEAR']['UF_VALUE']?></a>
            <a href="/search/?q=<?=$q;?>" data-attr="<?=$arHandBook['SEARCH_NAME']['UF_VALUE']?>" class="button hoverMe header__search-form__do"><?=$arHandBook['SEARCH_NAME']['UF_VALUE']?></a>
            <a href="#" class="header__search-form__close">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="26.275" height="1.87678" transform="matrix(0.710431 0.703767 -0.710431 0.703767 1.33203 0)" fill="#1A1A1A"/>
                    <rect width="26.275" height="1.87678" transform="matrix(0.710431 -0.703767 0.710431 0.703767 0 18.6792)" fill="#1A1A1A"/>
                </svg>
            </a>
        </form>
    </div>
</div>
<div class="search__results-inner hidden">
	<div class="search__results-overlay"></div>
	<div class="search__results-wrap"></div>
</div>