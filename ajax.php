<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
use \Bitrix\Main\Context;
use Bitrix\Main\Loader;

/**
 * @global CMain $APPLICATION
 */
$request = Context::getCurrent()->getRequest();

$action = $request->get("action");
global $USER;
switch ($action) {
    case 'lang':
		if (isset($_COOKIE["mi_lang"])) {
			$lang = $_COOKIE['mi_lang'];
			if ($lang == 's2') {
				setcookie('mi_lang', 's1', time()+60*60*24*300, "/");
			} else {
				setcookie('mi_lang', 's2', time()+60*60*24*300, "/");
			}
		} else {
			setcookie('mi_lang', 's1', time()+60*60*24*300, "/");
		}
		echo $lang;
        break;
    case 'form':
        \Bitrix\Main\Loader::includeModule('form');
        setcookie('mi_lets','Y');
        $params = $request->getPostList()->toArray();
        $formId = $params['WEB_FORM_ID'];
        unset($params['WEB_FORM_ID']);
        unset($params['sessid']);
        unset($params['action']);
        $RESULT_ID = CFormResult::Add($formId, $params);
        if($RESULT_ID) {
            CFormResult::Mail($RESULT_ID);
        }
        break;
    case 'form_callback':
        \Bitrix\Main\Loader::includeModule('form');
        $params = $request->getPostList()->toArray();
        $formId = $params['WEB_FORM_ID'];
        unset($params['WEB_FORM_ID']);
        unset($params['sessid']);
        unset($params['action']);
        foreach ($_FILES as $key=>$item){
            $arFile = current($_FILES);
            $arFileArray = array(
                "name" => $arFile["name"],
                "size" => $arFile["size"],
                "tmp_name" => $arFile["tmp_name"],
                "type" => $arFile["type"],
                "MODULE_ID" => "form"
            );
            $FileID = CFile::SaveFile($arFileArray, "form");
            $params[$key] = \CFile::MakeFileArray($FileID);
        }
        $RESULT_ID = CFormResult::Add($formId, $params);
        if($RESULT_ID) {
            CFormResult::Mail($RESULT_ID);
        }
        break;
    case 'checkLogin':
        $login = $request->get("REGISTER")['LOGIN'];
        $rsUser = \Bitrix\Main\UserTable::getList(array(
            'select' => array('ID'),
            'filter' => ["LOGIN" => $login],
        ));
        if ($rsUser->fetch()) {
            echo 'false';
        } else {
            echo 'true';
        }
        break;
    case 'checkLoginAuth':
        $login = $request->get("USER_LOGIN");
        $rsUser = \Bitrix\Main\UserTable::getList(array(
            'select' => array('ID'),
            'filter' => ["LOGIN" => $login],
        ));
        if ($rsUser->fetch()) {
            echo 'true';
        } else {
            echo 'false';
        }
        break;
    case 'checkPassword':
        $login = $request->get("USER_LOGIN");
        $password = $request->get("USER_PASSWORD");
        $user = $USER->Login($login,$password);
        $USER->Logout();
        if($user === true){
            echo 'true';
        } else {
            echo 'false';
        }
        break;
    case 'workCompany':
        try {
            $userId = $USER->GetID();
            if (!$userId){
                throw new Exception('Required fields: userId');
            }
            $arFields = [
                'WORK_COMPANY' => $request->get('WORK_COMPANY'),
                'UF_NUMBER_EMPLOYEES' => $request->get('UF_NUMBER_EMPLOYEES'),
                'WORK_PROFILE' => $request->get('WORK_PROFILE'),
                'WORK_POSITION' => $request->get('WORK_POSITION'),
            ];
            $user = new CUser;
            $user->Update($userId, $arFields);
            if($user == false){
                throw new Exception($user->LAST_ERROR);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'userInfoProfileUpdate':
        try {
            $userId = $USER->GetID();
            if (!$userId){
                throw new Exception('Required fields: userId');
            }
            $arFields = [
                'NAME' => $request->get('NAME'),
                'LAST_NAME' => $request->get('LAST_NAME'),
                'UF_GENDER' => $request->get('UF_GENDER'),
                'UF_BIRTHDAY' => $request->get('UF_BIRTHDAY'),
                'PERSONAL_CITY' => $request->get('PERSONAL_CITY'),
                'PERSONAL_STATE' => $request->get('PERSONAL_STATE'),
                'EMAIL' => $request->get('EMAIL'),
                'PERSONAL_PHONE' => $request->get('PERSONAL_PHONE'),
                'PERSONAL_NOTES' => $request->get('PERSONAL_NOTES')
            ];
			if ($_FILES['UF_PHOTO']['size'] > 0) { 
				$arFileArray = array(
					"name" => $_FILES["UF_PHOTO"]["name"],
					"size" => $_FILES["UF_PHOTO"]["size"],
					"tmp_name" => $_FILES["UF_PHOTO"]["tmp_name"],
					"type" => $_FILES["UF_PHOTO"]["type"],
					"MODULE_ID" => "user"
				);
				$FileID = CFile::SaveFile($arFileArray, "user");
			    $arFields['UF_PHOTO'] = \CFile::MakeFileArray($FileID);
			}
            $user = new CUser;
            $user->Update($userId, $arFields);
            if($user == false){
                throw new Exception($user->LAST_ERROR);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'settings_profile':
        try {
            $userId = $USER->GetID();
            if (!$userId) {
                throw new Exception('Required fields: userId');
            }
            $arFields = [
                'EMAIL' => $request->get('USER_LOGIN'),
                'LOGIN' => $request->get('USER_LOGIN'),
            ];
            $password = $request->get('NEW_PASSWORD');
            $passwordConfirm = $request->get('NEW_PASSWORD_CONFIRM');
            if ($password && $passwordConfirm) {
                $arFields['PASSWORD'] = $password;
            }
            $user = new CUser;
            $user->Update($userId, $arFields);
            if($user == false){
                throw new Exception($user->LAST_ERROR);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'checkPasswordProfile':
        $login = $request->get("USER_LOGIN");
        $password = $request->get("USER_PASSWORD");
        $user = $USER->Login($login,$password);
        if($user === true){
            echo 'true';
        } else {
            echo 'false';
        }
        break;
    case 'settings_profile_preferences':
        try {
            $userId = $USER->GetID();
            if (!$userId) {
                throw new Exception('Required fields: userId');
            }
            $arFields = [
                'UF_LANG' => $request->get('UF_LANG'),
                'UF_TIMEZONE' => $request->get('UF_TIMEZONE'),
                'UF_DATE_FORMAT' => $request->get('UF_DATE_FORMAT'),
            ];
            $user = new CUser;
            $user->Update($request->get('user'),$arFields);
            if($arFields['UF_LANG'] == 'RU'){
				setcookie('mi_lang', 's2', time()+60*60*24*300, "/");
            }if($arFields['UF_LANG'] == 'EN'){
				setcookie('mi_lang', 's1', time()+60*60*24*300, "/");
            }
            if($user == false){
                throw new Exception($user->LAST_ERROR);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'settings_profile_cover':
        try {
            $userId = $USER->GetID();
            if (!$userId) {
                throw new Exception('Required fields: userId');
            }
            $arFileArray = array(
                "name" => $_FILES["COVER"]["name"],
                "size" => $_FILES["COVER"]["size"],
                "tmp_name" => $_FILES["COVER"]["tmp_name"],
                "type" => $_FILES["COVER"]["type"],
                "MODULE_ID" => "user"
            );
            $FileID = CFile::SaveFile($arFileArray, "user");
            $user = new CUser;
            $user->Update($userId,['UF_COVER' => \CFile::MakeFileArray($FileID)]);
            if($user == false){
                throw new Exception($user->LAST_ERROR);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'delete':
        try {
            $userId = $USER->GetID();
            if (!$userId) {
                throw new Exception('Required fields: userId');
            }else {
                CourseUser::deleteAll($userId);
                ProjectsUser::deleteAll($userId);
                CUser::Delete($userId);
                echo 'true';
            }
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'register':
        global $USER;
        $lang = $_COOKIE['mi_lang'];
        if(!$lang){
            $lang = 's1';
        }
        $arResult = $USER->Register($_POST['REGISTER']['LOGIN'], $_POST['REGISTER']['NAME'], $_POST['REGISTER']['LAST_NAME'], $_POST['REGISTER']['PASSWORD'], $_POST['REGISTER']['CONFIRM_PASSWORD'], $_POST['REGISTER']['EMAIL'],$lang);
        break;
    case 'personal_projects':
        try {
            $userId = $USER->GetID();
            $projectId = $request->get('project');
            $name = $request->get('NAME');
            $email = $request->get('LOGIN');
            if (!$userId && !$projectId) {
                throw new Exception('Required fields: userId, projectId');
            }
            $course = \Bitrix\Iblock\ElementTable::getRowById($projectId);
            if (!$course || $course['IBLOCK_ID'] != PROJECT){
                throw new Exception("Project $projectId not found");
            }
            $params = [
                'UF_USER_ID' => $userId,
                'UF_PROJECT_ID' => $projectId,
                'UF_NAME' => $name,
                'UF_EMAIL' => $email,
            ];
            if(!ProjectsUser::getOne($userId,$projectId)){
                ProjectsUser::add($params);
            }
            echo 'true';
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'get_course':
        try {
            $userId = $USER->GetID();
            $courseId = $request->get('course');

            if (!$userId && !$courseId){
                throw new Exception('Required fields: userId, courseId');
            }

            $courseEntity = \Bitrix\Iblock\Iblock::wakeUp(COURSES)->getEntityDataClass();
            $course = $courseEntity::getRow([
                'select' => [
                    'ID',
                    'IBLOCK_ID',
                    'DUPLICATE_ELEMENT_VALUE' => 'DUPLICATE_ELEMENT.VALUE'
                ],
                'filter' => [
                    'ID' => $courseId,
                    'IBLOCK_ID' => COURSES,
                    'ACTIVE' => 'Y'
                ],
            ]);
            if (!$course){
                throw new Exception("Course $courseId not found");
            }

            if (!CourseUser::getOne($userId, $courseId)){
                CourseUser::add([
                    'UF_USER_ID' => $userId,
                    'UF_COURSE_ID' => $courseId,
                    'UF_DATE_START' => new \Bitrix\Main\Type\DateTime()
                ]);
                if ($course['DUPLICATE_ELEMENT_VALUE']) {
                    CourseUser::add([
                        'UF_USER_ID' => $userId,
                        'UF_COURSE_ID' => intval($course['DUPLICATE_ELEMENT_VALUE']),
                        'UF_DATE_START' => new \Bitrix\Main\Type\DateTime()
                    ]);
                }
            }

            echo 'true';

        } catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }


        break;
    case 'notify_read_user':
        $userId = $USER->GetID();
        $notification = $request->get('notification');
        if($notification){
            NotificationsUser::read($userId,$notification);
        }
        break;
    case 'forgot_password':
        try {
            $lang = $_COOKIE['mi_lang'];
            if(!$lang){
                $lang = 's1';
            }
            $email = $request->get('USER_LOGIN');
            global $USER;
            $arResult = $USER->SendPassword($email, $email,$lang);
            if($arResult["TYPE"] == "OK"){
                echo 'true';
            }else{
                throw new Exception("Login(Email) not found");
            }
        }catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
            echo 'false';
        }
        break;
    case 'subscribe':
        $lang = $_COOKIE['mi_lang'];
        if(!$lang){
            $lang = 's1';
        }
        $email = $request->get('email');
        UnisenderApi::subscribe($email,$lang);
        break;
    case 'module_progress':
        try {
            $userId = $USER->GetID();
            $moduleId = $request->get('module');
            $progress = $request->get('progress');
            if (!$userId || !$progress || !$moduleId){
                throw new Exception('Required fields: userId, progress, moduleId');
            }

            $module = ModuleUser::getOne($userId, $moduleId);
            if (!$module){
                throw new Exception('User module not found');
            }

            $progress = intval($progress * 100);
            if ($progress > 100){
                throw new Exception('Bad progress data');
            }

            if (!$module['UF_COMPLETED'] && $progress > $module['UF_PROGRESS']){
                $moduleEntity = ModuleUser::getEntity();

                if ($progress > 90){
                    $data = [
                        'UF_PROGRESS' => 100,
                        'UF_COMPLETED' => true,
                        'UF_DATE_COMPLETE' => new \Bitrix\Main\Type\DateTime()
                    ];
                } else {
                    $data = [
                        'UF_PROGRESS' => $progress
                    ];
                }
                $res = $moduleEntity::update($module['ID'], $data);
                if ($res->isSuccess()){
                    $iBlockModuleEntity = \Bitrix\Iblock\Iblock::wakeUp(MODULES)->getEntityDataClass();
                    $arModule = $iBlockModuleEntity::getRow([
                        'filter' => ['ID' => $moduleId],
                        'select' => ['DUP_ID' => 'DUPLICATE_ELEMENT.VALUE']
                    ]);
                    if ($arModule){
                        $dupModule = ModuleUser::getOne($userId, intval($arModule['DUP_ID']));
                        if ($dupModule) {
                            $moduleEntity::update($dupModule['ID'], $data);
                        }
                    }
                }
            }

        } catch (Throwable $throwable){
            \Helper\LogHelper::logSiteError($throwable);
        }
        break;
    case 'auth_unlink':
        Loader::requireModule("vayti.hybridauth");

        $userId = $USER->GetID();
        $provider = $request->get('provider');
        if (!$userId || !$provider){
            throw new Exception('Required fields: userId, auth');
        }

        $auth = new \Vayti\HybridAuth\Auth($provider);
        $auth->detach($userId);

        echo 'true';

        break;
}