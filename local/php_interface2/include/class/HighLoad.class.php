<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Highloadblock as HL;

/**
 * Класс для работы с HighLoad блоками
 * Class Highload
 */
class Highload
{
    public function getList($id, $select = ['*'], $filter = [], $order = [])
    {
        try {
            if (!Loader::includeModule("highloadblock")) {
                throw new \Error(Loc::getMessage('Не подключен модуль HighLoadBlock'));
            }
            $result = [];
            $hlblock = HL\HighloadBlockTable::getById($id)->fetch();

            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
            $entity_data_class = $entity->getDataClass();

            $rsData = $entity_data_class::getList(array(
                "select" => $select,
                "order" => $order,
                "filter" => $filter
            ));
            while ($arData = $rsData->fetch()) {
                if($_COOKIE['mi_lang'] == 's2'){
                    $arData['UF_VALUE'] = $arData['UF_TEXT_RU'];
                }else{
                    $arData['UF_VALUE'] = $arData['UF_TEXT_EN'];
                }
                if($arData['UF_CODE'] == 'TITLE'){
                    $result[$arData['UF_CODE']][] = $arData;
                }else {
                    $result[$arData['UF_CODE']] = $arData;
                }
            }
            return $result;
        } catch (\Throwable $throwable) {
            throw $throwable;
        }
    }
}