<?php


class ModuleUser
{
    const hlBlockName = 'ModulesUsers';


    public static function getByUser(int $userId)
    {
        $moduleEntity = static::getEntity();
        $rsModule = $moduleEntity::getList([
            'filter' => ['UF_USER_ID' => $userId]
        ]);
        return $rsModule->fetchAll();
    }

    public static function getOne(int $userId, int $moduleId)
    {
        if (!$userId || !$moduleId){
            throw new Exception('Required fields: userId, courseId');
        }

        $moduleEntity = static::getEntity();
        $module = $moduleEntity::getRow([
            'filter' => [
                'UF_USER_ID' => $userId,
                'UF_MODULE_ID' => $moduleId
            ]
        ]);
        return $module;
    }

    public static function add(array $params)
    {
        $moduleEntity = static::getEntity();
        $moduleEntity::add($params);
    }

    public static function deleteAll(int $userId)
    {
        $moduleEntity = static::getEntity();
        $arModules = static::getByUser($userId);
        foreach ($arModules as $module) {
            $moduleEntity::delete($module['ID']);
        }
    }

    public static function getEntity()
    {
        return \Helper\HLBlockHelper::getEntityByName(static::hlBlockName);
    }
}
