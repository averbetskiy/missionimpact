<?php

class NotificationsUser
{
    const hlBlockName = 'Notifications';
    const hlBlockNameRead = 'NotificationsRead';
    const notifications = [];


    public static function getByUser(int $userId)
    {
        $arNotifications = [];
        $arNotificationsRead = static::getByUserRead($userId);
        $arUser = \Bitrix\Main\UserTable::getRow(['filter' => ['ID' => $userId]]);
        $notificationsEntity = static::getEntity();
        $rsNotifications = $notificationsEntity::getList([
            'filter' => [
                '>UF_DATE' => $arUser['DATE_REGISTER'],
                [
                    'LOGIC' => 'OR',
                    ['UF_USERS' => ''],
                    ['UF_USERS' => $userId]
                ]
            ],
            'order' => [
                'UF_DATE' => 'DESC'
            ]
        ]);
        while($notifications = $rsNotifications->fetch()){
            $notifications['UF_IMAGE'] = CFile::GetPath($notifications['UF_IMAGE']);
            $notifications['READ'] = false;
            if($arNotificationsRead[$notifications['ID']]){
                $notifications['READ'] = true;
            }
            $arNotifications[] = $notifications;
        }
        return $arNotifications;
    }

    public static function getByUserRead(int $userId)
    {
        $arNotificationsRead = [];
        $notificationsReadEntity = static::getEntityRead();
        $rsNotificationsRead = $notificationsReadEntity::getList([
            'filter' => [
                'UF_USER_ID' => $userId
            ]
        ]);
        while($notificationsRead = $rsNotificationsRead->fetch()){
            $arNotificationsRead[$notificationsRead['UF_NOTIFICATION_ID']] = $notificationsRead;
        }
        return $arNotificationsRead;
    }

    public static function countNew(int $userId){
        $count = 0;
        $arNotificationsRead = static::getByUserRead($userId);
        $arUser = \Bitrix\Main\UserTable::getRow(['filter' => ['ID' => $userId]]);
        $notificationsEntity = static::getEntity();
        $rsNotifications = $notificationsEntity::getList([
            'filter' => [
                '>UF_DATE' => $arUser['DATE_REGISTER'],
                [
                    'LOGIC' => 'OR',
                    ['UF_USERS' => ''],
                    ['UF_USERS' => $userId]
                ]
            ],
            'order' => [
                'UF_DATE' => 'DESC'
            ]
        ]);
        while($notifications = $rsNotifications->fetch()){
            if(!$arNotificationsRead[$notifications['ID']]){
                $count++;
            }
        }
        return $count;
    }

    public static function read(int $userId, int $notification){
        $notificationsReadEntity = static::getEntityRead();
        if(static::getOne($userId,$notification)) {
            $notificationsReadEntity::add([
                'UF_USER_ID' => $userId,
                'UF_NOTIFICATION_ID' => $notification
            ]);
        }
    }

    public static function getOne(int $userId, int $notificationId)
    {
        if (!$userId || !$notificationId){
            throw new Exception('Required fields: userId, notification');
        }

        $notificationEntity = static::getEntity();
        $notification = $notificationEntity::getRow([
            'filter' => [
                'ID' => $notificationId
            ]
        ]);
        return $notification;
    }

    public static function add(array $params){
        if (!$params){
            throw new Exception('Required fields: userId, params');
        }
        $notificationEntity = static::getEntity();
        $notificationEntity::add($params);
    }

    public static function getEntity()
    {
        return \Helper\HLBlockHelper::getEntityByName(static::hlBlockName);
    }
    public static function getEntityRead()
    {
        return \Helper\HLBlockHelper::getEntityByName(static::hlBlockNameRead);
    }
}