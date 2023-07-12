<?php


class CourseUser
{
    const hlBlockName = 'CoursesUsers';


    public static function getByUser(int $userId)
    {
        $courseEntity = static::getEntity();
        $rsCourse = $courseEntity::getList([
            'filter' => ['UF_USER_ID' => $userId]
        ]);
        return $rsCourse->fetchAll();
    }

    public static function getOne(int $userId, int $courseId)
    {
        if (!$userId || !$courseId){
            throw new Exception('Required fields: userId, courseId');
        }

        $courseEntity = static::getEntity();
        $course = $courseEntity::getRow([
            'filter' => [
                'UF_USER_ID' => $userId,
                'UF_COURSE_ID' => $courseId
            ]
        ]);
        return $course;
    }

    public static function add(array $params)
    {
        $courseEntity = static::getEntity();
        $courseEntity::add($params);
    }

    public static function deleteAll(int $userId)
    {
        $courseEntity = static::getEntity();
        $arCourses = static::getByUser($userId);
        foreach ($arCourses as $course) {
            $courseEntity::delete($course['ID']);
        }
    }

    public static function getEntity()
    {
        return \Helper\HLBlockHelper::getEntityByName(static::hlBlockName);
    }
}
