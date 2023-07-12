<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

function pre($value){
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
function get_filesize($file)
{
    if(!file_exists($file)) return "Файл  не найден";

    $filesize = filesize($file);

    if($filesize > 1024){
        $filesize = ($filesize/1024);
        if($filesize > 1024){
            $filesize = ($filesize/1024);
            if($filesize > 1024) {
                $filesize = ($filesize/1024);
                $filesize = round($filesize, 1);
                return $filesize." ГБ";
            } else {
                $filesize = round($filesize, 1);
                return $filesize." MБ";
            }
        } else {
            $filesize = round($filesize, 1);
            return $filesize." Кб";
        }
    } else {
        $filesize = round($filesize, 1);
        return $filesize." байт";
    }
}
//Хранилище (Аналог GLOBAL)
Class GarbageStorage
{
    private static $storage = array();

    public static function set($name, $value)
    {
        static::$storage[$name] = $value;
    }

    public static function get($name)
    {
        return static::$storage[$name];
    }
}

function duplicateElement($duplicateId){

    $duplicate = [];
    if($duplicateId){
        $duplicate = \Bitrix\Iblock\ElementTable::getRow([
            'select' => ['ID', 'IBLOCK_ID','CODE', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL' => 'IBLOCK.DETAIL_PAGE_URL'],
            'filter' => ['ID' => $duplicateId,'ACTIVE' => 'Y']
        ]);
        if($duplicate) {
            $duplicate['DETAIL_PAGE_URL'] = CIBlock::ReplaceDetailUrl($duplicate['DETAIL_PAGE_URL'], $duplicate, false, 'E');
        }
    }
    return $duplicate;
}