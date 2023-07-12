<?php

namespace Vayti\HybridAuth;
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UserTable;
use Bitrix\Main\Type;
use Bitrix\Main\ORM\Fields;
use Bitrix\Main\ORM\Data;
use Bitrix\Main\ORM\Query\Join;

class HybridAuthTable extends Data\DataManager
{
    public static function getUfId()
    {
        return "HYBRIDAUTH";
    }

    public static function getTableName()
    {
        return 'b_vayti_hybridauth_user';
    }

    public static function getMap()
    {
        return [
            new Fields\IntegerField("ID",
                [
                    "primary" => true,
                    "autocomplete" => true,
                ]),
            new Fields\IntegerField("USER_ID",
                [
                    "required" => true,
                ]),
            new Fields\StringField("EXTERNAL_SITE",
                [
                    "required" => true,
                ]), //mail, vkontakte, etc
            new Fields\StringField("EXTERNAL_USER_ID",
                [
                    "required" => true
                ]), //identity
/*            new Fields\StringField("ACCESS_TOKEN"),
            new Fields\IntegerField("EXPIRES_AT"), //todo удалять токен когда он устарел
            new Fields\StringField("REFRESH_TOKEN"),
            new Fields\Relations\Reference(
                "USER",
                UserTable::class,
                Join::on("this.USER_ID", "ref.ID")
            ),*/
        ];
    }

    function OnUserDelete($userId) {
        \Bitrix\Main\Loader::includeModule('vayti.hybridauth');
        $res = HybridAuthTable::getList([
            'filter' => ['USER_ID' => $userId],
        ]);
        while($auth = $res->fetchObject()) {
            $auth->delete();
        }
        return;
    }
}