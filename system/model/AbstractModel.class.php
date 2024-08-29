<?php

abstract class AbstractModel
{
    protected $MySQLi;

    public function __construct()
    {
        require_once("system/AppCore.class.php");
        $this->MySQLi = AppCore::getDB();
    }

}


?>