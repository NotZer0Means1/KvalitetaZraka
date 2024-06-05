<?php

include 'AbstractPage.class.php';

class ReadCityPage extends AbstractPage
{
    protected $templateName = 'ReadCity';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $dbObj->readStation($id, $postaja, $password);

    }
}

?>