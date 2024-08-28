<?php



abstract class AbstractModel
{
    protected $MySQLi;

    public function __construct()
    {
        require_once("AppCore.class.php");
        $this->MySQLi = AppCore::getDB();
    }

    public function sendQuery($request)
    {
        $this->MySQLi->sendQuery($request);
    }

}


?>