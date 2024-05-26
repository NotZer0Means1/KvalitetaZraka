<?php

class AppCore
{
    protected static $dbObj = null;


    public function __construct()
    {
        $this->initDB();

        require_once('util/RequestHandler.class.php');
        RequestHandler::handle();
    }

    protected function initDB()
    {
        $dbHost = $dbUser = $dbPassword = $dbName = '';
        require_once('config.inc.php');

        require_once('model/MySQLiDatabase.class.php');
        self::$dbObj = new MySQLiDatabase($dbHost, $dbUser, $dbPassword, $dbName);

    }

    protected static final function getDB()
    {
        return self::$dbObj;
    }
}

?>