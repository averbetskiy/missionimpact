<?php

namespace Helper;

use Bitrix\Main\Entity\DataManager;
use \Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\SystemException;
use \Bitrix\Highloadblock\HighloadBlockTable;

class HLBlockHelper
{
    protected static $entityClasses;

    /**
     * @param $hlBlockName
     * @return DataManager
     * @throws SystemException
     */
    public static function getEntityByName($hlBlockName)
    {
        if (!static::$entityClasses[$hlBlockName]) {
            if (!Loader::includeModule('highloadblock')) {
                throw new \Error('need install highloadblock module');
            }

            $hlBlock = HighloadBlockTable::getRow(['filter' => ['name' => $hlBlockName]]);
            if ($hlBlock) {
                $entity = HighloadBlockTable::compileEntity($hlBlock);
                $entityClass = $entity->getDataClass();
            } else {
                throw new \Exception("HL block {$hlBlockName} not found");
            }
            static::$entityClasses[$hlBlockName] = $entityClass;
        }
        return static::$entityClasses[$hlBlockName];
    }
}