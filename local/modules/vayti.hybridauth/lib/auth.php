<?php

namespace Vayti\HybridAuth;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\EventResult;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use Bitrix\Main\UserTable;
use Helper\LogHelper;
use Hybridauth\Adapter\OAuth2;

Loc::loadMessages(__FILE__);


class Auth
{
    /**
     * @var OAuth2
     */
    protected $provider;
    protected $userData;
    public $providerName;
    public $storage;

    public static $providers = [
        'mailru',
        'facebook',
        'vkontakte',
        'odnoklassniki',
        'yandex',
        'twitter',
        'google'
    ];

    /**
     * Auth constructor.
     * @param string $provider
     * @throws \Bitrix\Main\ArgumentNullException
     * @throws \Hybridauth\Exception\RuntimeException
     */
    public function __construct($provider = '')
    {
        $this->storage = new \Hybridauth\Storage\Session();
        if(!$provider)
        {
            $provider = $this->storage->get("PROVIDER");
            if (!$provider)
                throw new \LogicException("Provider not found in session storage");
        }
        $provider = strtolower($provider);
        if(!in_array($provider, static::$providers)) {
            throw new \LogicException("Wrong provider");
        }
        if(Option::get('vayti.hybridauth', "{$provider}_enabled") != 'Y') //Включен ли провайдер
            throw new \Bitrix\Main\SystemException("Provider {$provider} is disabled");
        $keys = [
            'id' => Option::get("vayti.hybridauth", "{$provider}_private_key"),
            'secret' => Option::get("vayti.hybridauth", "{$provider}_secret_key")
        ]; //При отсутсвии ключей исключение InvalidApplicationCredentialsException
        $config = [
            "callback" => \Hybridauth\HttpClient\Util::getCurrentUrl(false, false),
            "keys" => $keys,
            'debug_mode' => true,
            'debug_file' => __FILE__.'.log',
        ];
        $provider = ucfirst($provider);
        $adapter = "\\Hybridauth\\Provider\\{$provider}";
        $this->provider = new $adapter($config);
        $this->providerName = $provider;
        $this->storage->set("PROVIDER", $provider); //Т.к. Authorize() перезагружает страницу и стирает GET, этот параметр надо запомнить
    }

    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Получение ИД пользователя по внешнему ИД
     * @param $ext_site string Внешний сайт
     * @param $ext_id int Внешний ИД
     * @return mixed Возвращает ИД Пользователя
     */
    public function getAuthUserId($ext_id)
    {
        return HybridAuthTable::getRow([
            'select' => ["ID", "USER_ID"],
            'filter' => [
                'EXTERNAL_SITE' => $this->providerName,
                'EXTERNAL_USER_ID' => $ext_id,
            ]
        ]);
    }

    /**
     * Получает ИД пользователя по токену
     * @param $token string
     * @return array Массив с ИД пользователя
     *
    public function getIdByToken($token)
    {
        return HybridAuthTable::getRow([
            'select' => ["ID", "USER_ID"],
            'filter' => [
                'EXTERNAL_SITE' => $this->providerName,
                'ACCESS_TOKEN' => $token,
            ]
        ]);
    }
    */

    /**
     * Получение всех связей пользователя с провайдерами
     * @param int $userId ИД пользователя. По умолчанию $USER->GetID()
     * @param bool $keys Задать ли ключи выдаваемому массиву
     * @return array Массив
     * @throws \Bitrix\Main\ArgumentException
     */
    static function getUserAuths($userId = '', $keys = true)
    {
        global $USER;
        $userId = $userId ?: $USER->GetID();
        $auths = [];
        $result = HybridAuthTable::getList([
            'select' => ['ID', 'EXTERNAL_SITE', 'EXTERNAL_USER_ID'],
            'filter' => ['USER_ID' => $userId]
            ]);
        while($a = $result->fetch())
        {
            if($keys)
            {
                $auths[$a['EXTERNAL_SITE']] = [
                    'EXTERNAL_ID' => $a["EXTERNAL_USER_ID"]
                ];
            } else {
                $auths[] = [
                    'EXTERNAL_SITE' => $a["EXTERNAL_SITE"],
                    'EXTERNAL_ID' => $a["EXTERNAL_USER_ID"]
                ];
            }
        }
        return $auths;
    }

    /**
     * Авторизация с провайдером и получение данных
     * @return array
     * @throws \Hybridauth\Exception\Exception
     */
    public function getUserData()
    {
        if(!$this->userData)
        {
            $this->provider->authenticate();
            $this->userData = [
                'ACCESS_TOKEN' => $this->provider->getAccessToken(),
                'USER_PROFILE' => $this->provider->getUserProfile()
            ];
        }
        if(!$this->userData) throw new \LogicException("Отсутвуют данные пользователя");
        return $this->userData;
    }

    /**
     * Отправка событий
     * @param $name string Название события
     * @param $data array Данные для обработки
     * @return bool Прошла ли обработка успешно
     */
    public function processEvent($name, $data)
    {
        if(!is_array($data))
            $data = [$data];
        $event = new \Bitrix\Main\Event('vayti.hybridauth', $name, $data);
        $event->send();
        foreach($event->getResults() as $r)
        {
            if($r->getType() === EventResult::ERROR)
            {
                pre("Ошибка в обработчике");
                return false;
            }
        }
        return true;
    }

    /**
     * Авторизация по данным в сессии
     * @return bool
     *
    public function loginThroughSession()
    {
        global $USER;
        if(!$this->provider->isConnected()) //Проверяет данные в $_SESSION
        {
            return false;
        }
        $access_token = $this->storage->get($this->providerName."."."access_token");
        if(!$this->processEvent('onSessionAuth', $access_token)) throw new \Exception("Ошибка в обработчике");
        $arAuthUser = $this->getIdByToken($access_token);
        $userId = $arAuthUser['USER_ID'];
        if(!$userId)
            throw new \LogicException("No user ID");
        $USER->Authorize(intval($userId));
        $this->processEvent('afterSessionAuth', [$userId]);
        return true;
    }*/

    /**
     * Главный метод. Регистрирует, авторизует и присоединяет пользователя к провайдеру.
     * @param bool $attach Должна ли функция привязывать уже авторизованных пользователей
     * @param bool $detach Должна ли функция отвязывать уже авторизованных пользователей
     * @throws \Hybridauth\Exception\Exception
     * @throws UserRegisterException
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Hybridauth\Exception\NotImplementedException
     */
    public function login($attach = false, $detach = false)
    {
        global $USER;
/*        if($this->loginThroughSession()) //если есть данные в сессии, авторизуемся
        {
            pre("You've been authorized through session");
            return;
        }*/
        $arUser = $this->getUserData();
        if(!$this->processEvent('onLogin', $arUser)) return false;
        if (!$USER->IsAuthorized()) {
            $arAuthUser = $this->getAuthUserId($arUser["USER_PROFILE"]->identifier);
            if ($arAuthUser) {
                $userId = $arAuthUser['USER_ID'];
                pre("You've been authorized");
            } else {
                try
                {
                    $userId = self::registerWithResponse($arUser);
                    $this->attachTo($userId);
                }
                catch(\Exception $e)
                {
                    if($userId)
                    {
                        (new \CUser())->Delete($userId);
                        $this->detach($userId);
                    }
                    throw $e; //rethrow
                }
                $this->processEvent('afterRegister', ['USER_ID' => $userId]);
                pre("You've been registered");
            }

            if (isset($userId) && intval($userId) > 0) {
                $bitrixUser = UserTable::getRowById(intval($userId));
                if ($bitrixUser && $bitrixUser['ACTIVE'] != 'Y'){
                    $cUser = new \CUser;
                    $cUser->Update($bitrixUser['ID'], ['ACTIVE' => 'Y']);
                }
                $USER->Authorize(intval($userId));
                if (!$USER->IsAuthorized()){
                    throw new \LogicException("Need to confirm your email address");
                }
            } else {
                throw new \LogicException("No user ID");
            }
        }
        else
        {
            $userId = $USER->GetID();
            if($attach || $detach)
            {
                if($detach)
                {
                    $this->attachToggle($userId);
                } else {
                    $this->attach($userId);
                }
            }
        }
        $this->processEvent('afterLogin', $userId);
        return true;
    }

    /**
     * Удаления связи пользователя с провайдером
     * @param $userId
     * @return mixed Был ли удалён объект
     * @throws \Bitrix\Main\ArgumentException
     */
    public function detach($userId)
    {
        if(!$this->processEvent('onDetach', [$userId])) return false;
        $obj = HybridAuthTable::getList([
            'filter' => [
                "USER_ID" => $userId,
                "EXTERNAL_SITE" => $this->providerName
            ],
            'select' => ['ID'],
            ])
            ->fetchObject();
        return $obj ? $obj->delete() : null;
    }

    public function attachToggle($userId)
    {
        $arUser = $this->getUserData();
        $isAttached = $this->getAuthUserId($arUser["USER_PROFILE"]->identifier);
        if($isAttached)
        {
            $this->detach($userId);
            pre("You've been detached from $this->providerName");
        }
        else
        {
            $this->attach($userId);
            pre("You've been attached to $this->providerName");
        }
    }

    /**
     * Внутренний метод для добавления связи между пользователем и провайдером
     * @param $userId
     * @throws \Hybridauth\Exception\Exception
     */
    protected function attachTo($userId)
    {
        $arUser = $this->getUserData();
        if(!$this->processEvent('onAttach', [$arUser, $userId])) return false;
        if($this->getAuthUserId($arUser["USER_PROFILE"]->identifier))
            throw new AttachException("This account is already attached to other user");
        HybridAuthTable::add(
            [
                "USER_ID" => $userId,
                "EXTERNAL_SITE" => $this->providerName,
                "EXTERNAL_USER_ID" => $arUser["USER_PROFILE"]->identifier,
                /*
                "ACCESS_TOKEN" => $arUser["ACCESS_TOKEN"]["access_token"],
                "EXPIRES_AT" => $arUser["ACCESS_TOKEN"]["expires_at"] ?: 0,
                "REFRESH_TOKEN" => $arUser["ACCESS_TOKEN"]["refresh_token"] ?: '',
                */
            ]);
    }

    /** //todo ???
     * Добавляет  пользователю связь с провайдером
     * @param $userId
     * @throws Exception
     * @throws \Hybridauth\Exception\NotImplementedException
     */
    public function attach($userId)
    {
        global $USER;
        $this->attachTo($userId);
        return true;
    }

    /**
     * Регистрация пользователя по ответу провайдера
     * @param $response array Массив от GetUserData()
     * @return mixed $userId
     * @throws UserRegisterException Неизвестная ошибка при регистрации
     */
    protected function registerWithResponse($response)
    {
        $user = new \CUser;
        if(!$this->processEvent('onRegister', $response)) return false;
        //$arStorage = self::getStorage(['GROUPS']); //todo: ???
        $email = $response['USER_PROFILE']->emailVerified ?: $response['USER_PROFILE']->email;
        $login = $email ?: $response['USER_PROFILE']->identifier;
        $password = randString();
        $arFields = Array(
            "NAME" => $response['USER_PROFILE']->firstName,
            "LAST_NAME" => $response['USER_PROFILE']->lastName,
            "EMAIL" => $email,
            "LOGIN" => $login,
            "LID" => "ru",
            "ACTIVE" => "Y",
            //"GROUP_ID" => $arStorage['GROUPS'],
            "PASSWORD" => $password, //random password
            "CONFIRM_PASSWORD" => $password,
        );
        LogHelper::addLogMessage($arFields);
        $userId = $user->Add($arFields);

        if (intval($userId) <= 0)
        {
            $userId = UserTable::getRow( //Возможно он уже зарегистрирован
                [
                    'filter' => ['LOGIN' => $login],
                    'select' => ['ID']
                ])['ID'];
            if(!$userId)
                throw new UserRegisterException($user->LAST_ERROR); //Всё плохо
        }
        $this->processEvent('afterRegister', $userId);
        return $userId;
    }
}

class UserRegisterException extends \Bitrix\Main\SystemException
{
    public function __construct($message = "", $code = 0, $file = "", $line = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $file, $line, $previous);
    }
}

class AttachException extends \Bitrix\Main\SystemException
{
    public function __construct($message = "", $code = 0, $file = "", $line = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $file, $line, $previous);
    }
}