<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
global $arHandBook;
$arUser = $arResult['arUser'];
?>
<div class="profile__cover">
    <img src="<?=CFile::GetPath($arUser['UF_COVER'])?:'/images/profile/cover.png'?>" alt="">
</div>