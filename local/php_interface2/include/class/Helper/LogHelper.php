<?

namespace Helper;

class LogHelper
{

    /**
     * Add error to log
     * @param string $errorTypeId
     * @param \Throwable $throwable
     */
    public static function addThrowable(string $errorTypeId, \Throwable $throwable)
    {
        \CEventLog::Add(array(
            "SEVERITY" => "ERROR",
            "AUDIT_TYPE_ID" => $errorTypeId ?: "HELPER_ERROR",
            "MODULE_ID" => "main",
            "DESCRIPTION" => $throwable->getMessage() . ' --- ' . $throwable->getFile() . ':' . $throwable->getLine(),
        ));
    }

    /**
     * Add message to logFile
     * @param mixed $text
     * @param string $logPath
     */
    public static function addLogMessage($text, string $logPath = '_logs/test.txt'){
        static::createPath($logPath);
        \Bitrix\Main\Diag\Debug::writeToFile(
            $text,
            date("H:i:s"),
            $logPath
        );
    }

    /**
     * Add error to log
     * @param \Throwable $throwable
     */
    public static function logSiteError(\Throwable $throwable)
    {
        $logPath = "_logs/error/" . date("Y_m_d") . ".log";
        static::createPath($logPath);
        \Bitrix\Main\Diag\Debug::writeToFile(
            $throwable->getFile() . ':' . $throwable->getLine() . '
' . $throwable->getTraceAsString(),
            date('H:i:s') . ': ' . $throwable->getMessage(),
            $logPath
        );
    }

    /**
     * Creating folders & file from path
     * @param string $path
     */
    protected static function createPath(string $path){
        $arPath = explode('/', $path);
        $countPaths = count($arPath);
        $rootPath = $_SERVER['DOCUMENT_ROOT'];
        $arCurPath = [];

        foreach ($arPath as $keyPath => $pathItem) {
            $arCurPath[] = $pathItem;
            $curPath = $rootPath . '/' . implode('/', $arCurPath);
            if (!file_exists($curPath)) {
                if (($keyPath + 1) == $countPaths){
                    $fp = fopen($curPath, 'w');
                    fwrite($fp, '');
                    fclose($fp);
                } else {
                    mkdir($curPath, 0700);
                }
            }
        }
    }

    public static function logEvent($text, string $eventName, string $prefix = ''){
        $logPath = '_logs/events/Sale/'
            . $eventName . '/'
            . ($prefix ? $prefix . '_' : '')
            . date('Y_m_d') . '.log';

        static::addLogMessage($text, $logPath);
    }

    /**
     * Delete date.log files in dir or date-dir
     * @param string $logDir absolute path
     * @param bool $workWithDir work with date-dir or date.log
     * @param int $logStorageTime count days for save
     * @param string $dateFormat php date format
     * @param array $saveFile
     */
    public static function deleteOldLogFiles($logDir, $workWithDir = false, $logStorageTime = 5, $dateFormat = 'Y-m-d', $saveFile = [0 => '.', 1 => '..']){
        if ($workWithDir){
            $cntLogs = static::getCountDirInDir($logDir);
            if($cntLogs > $logStorageTime){
                $logFiles = scandir($logDir);
                for ($i = 0; $i < $logStorageTime; $i++) {
                    $saveFile[] = date($dateFormat, strtotime('-'.$i.' day'));
                }
                foreach ($logFiles as $logFile){
                    if(!in_array($logFile,$saveFile) && is_dir($logDir.$logFile)){
                        static::deleteDirWithContent($logDir.$logFile.'/');
                    }
                }
            }
        }else{
            $cntLogs = static::getCountFilesInDir($logDir);
            if($cntLogs > $logStorageTime){
                $logFiles = scandir($logDir);
                for ($i = 0; $i < $logStorageTime; $i++)
                {
                    $saveFile[] = date($dateFormat, strtotime('-'.$i.' day')).'.log';
                }
                foreach ($logFiles as $logFile){
                    if(!in_array($logFile,$saveFile) && !is_dir($logDir.$logFile)){
                        unlink($logDir.$logFile);
                    }
                }
            }
        }
    }

    /**
     * Get count files in dir
     * @param string $dir
     */
    public static function getCountFilesInDir($dir)
    {
        $dir = opendir($dir);
        $count = 0;
        while($file = readdir($dir))
        {
            if($file == '.' || $file == '..' || is_dir($dir . $file))
            {
                continue;
            }
            $count++;
        }
        return $count;
    }

    /**
     * Get count dir in dir
     * @param string $dir
     */
    public static function getCountDirInDir($dir)
    {
        $count = 0;
        $subDirs = scandir($dir);
        foreach ($subDirs as $subDir)
        {
            if($subDir == '.' || $subDir == '..' ) {
                continue;
            }
            if (is_dir($dir . $subDir)){
                $count++;
            }
        }
        return $count;
    }

    /**
     * Delete dir with all content
     * @param string $dir
     */
    public static function deleteDirWithContent($dir)
    {
        $d=opendir($dir);
        while(($entry=readdir($d))!==false)
        {
            if ($entry != "." && $entry != "..") {
                if (is_dir($dir."/".$entry)) {
                    static::deleteDirWithContent($dir."/".$entry);
                }
                else {
                    unlink ($dir."/".$entry);
                }
            }
        }
        closedir($d);
        rmdir ($dir);
    }

    /**
     * Add message to logFile
     * @param $text
     * @param string $logPath
     * @throws \Exception
     */
    public static function addLogMessageWithTrace($text, string $logPath = '_logs/test.txt'){
        static::createPath($logPath);
        $d = new \DateTime();

        $throwable = new \Exception;

        \Bitrix\Main\Diag\Debug::writeToFile(
            $throwable->getFile() . ':' . $throwable->getLine() . '
' . $throwable->getTraceAsString(),
            $d->format('H:i:s.u') . ': ' . $text,
            $logPath
        );
    }
}