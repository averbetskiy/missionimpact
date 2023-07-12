<?php

class ProjectsUser
{
    const hlBlockName = 'ProjectsUsers';

    public static function getByUser(int $userId){
        $projectEntity = static::getEntity();
        $rsProject = $projectEntity::getList([
            'filter' => ['UF_USER_ID' => $userId]
        ]);
        return $rsProject->fetchAll();
    }

    public static function getOne(int $userId, int $projectId)
    {
        if (!$userId || !$projectId){
            throw new Exception('Required fields: userId, projectId');
        }

        $projectEntity = static::getEntity();
        $project = $projectEntity::getRow([
            'filter' => [
                'UF_USER_ID' => $userId,
                'UF_PROJECT_ID' => $projectId
            ]
        ]);
        return $project;
    }
    public static function add(array $params){
        $projectEntity = static::getEntity();
        $projectEntity::add($params);
    }

    public static function deleteAll(int $userId){
        $projectEntity = static::getEntity();
        $arProjects = static::getByUser($userId);
        foreach ($arProjects as $project){
            $projectEntity::delete($project['ID']);
        }
    }

    public static function getEntity(){
        return \Helper\HLBlockHelper::getEntityByName(static::hlBlockName);
    }

}