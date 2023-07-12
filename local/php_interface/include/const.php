<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
//Hl-block
define('HL_HANDBOOK',1);

define('EN_SHORT_MONTH',['jan','feb','mar','apr','may','june','july','aug','sep','oct','nov','dec']);
define('EN_SHORT_MONTH2',['Jan','Feb','Mar','Apr','May','June','July','Aug','Sep','Oct','Nov','Dec']);
define('RU_SHORT_MONTH',['янв','фев','мар','апр','май','июн','июл','авг','сен','окт','ноя','дек']);
define('RU_SHORT_MONTH2',['Янв','Фев','Мар','Апр','Май','Июн','Июл','Авг','Сен','Окт','Ноя','Дек']);
define('EN_LONG_MONTH',['January','February','March','April','May','June','July','August','September','October','November','December']);
define('RU_LONG_MONTH',['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря']);
define('RU_LONG_MONTH2',['Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря']);

\Bitrix\Main\Loader::includeModule('iblock');
$arSiteIblock = [];
$arIblocks = \Bitrix\Iblock\IblockTable::getList([
    'select' => ['ID','CODE','LID']
])->fetchAll();
$iblockConst = [];
$iblockIds = [];
$lang = $_COOKIE['mi_lang'];
if(!$lang){
    $lang = 's1';
}
foreach ($arIblocks as $iblock){
    if($lang == 's2') {
        if(strripos($iblock['CODE'],'_ru') !== false){
            $code = strtoupper(str_replace('_ru','',$iblock['CODE']));
            define($code,$iblock['ID']);
        }
    }else{
        if(strripos($iblock['CODE'],'_ru') === false) {
            $code = strtoupper(str_replace('_ru', '', $iblock['CODE']));
            define($code, $iblock['ID']);
        }
    }
    $code = strtoupper(str_replace('_ru', '', $iblock['CODE']));
    $iblockConst[$iblock['ID']] = $code;
    if(strripos($iblock['CODE'],'_ru') !== false) {
        $iblockIds[$code]['s2'] = $iblock['ID'];
    }else{
        $iblockIds[$code]['s1'] = $iblock['ID'];
    }
}
define('IBLOCK_CONTST',$iblockConst);
define('IBLOCK_IDS',$iblockIds);
?>