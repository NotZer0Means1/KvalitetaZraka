<?php
require_once('core.functions.php');
class AppCore
{
    protected static $dbObj = null;

    protected static $num = 0;

    public function __construct()
    {
        $this->initDB();

        require_once('util/RequestHandler.class.php');
        RequestHandler::handle();
    }
    static function exceptionHandle()
    {
        AppCore::$num++;
    
        if(AppCore::$num<=1)
        {
            $message = "FATAL ERROR exceptionHandle";
            require_once('view/Error.tpl.php');
            header("HTTP/1.1 404 NOT FOUND FATAL ERROR exceptionHandle");
        }
        else
        {

        }
      
    }
    public static function errorExceptionHandle()
    {
        $message = "ERROR WARNING errorExceptionHandle";
        AppCore::sendError($message);
        require_once('view/Error.tpl.php');
        header("HTTP/1.1 405 ERROR WARNING errorExceptionHandle");
    }

    protected function initDB()
    {
        $dbHost = $dbUser = $dbPassword = $dbName = '';
        require_once('config.inc.php');

        require_once('model/MySQLiDatabase.class.php');
        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);

    }

    public static final function getDB()
    {
        return self::$dbObj;
    }

    //fake test
    private static function sendError($msg)
    {
        //mail("vshevalev@aspira.hr","ERROR: ",$msg);
           
    }
}


?>