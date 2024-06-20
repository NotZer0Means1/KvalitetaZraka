<?php

include 'AbstractPage.class.php';

class AddCityPage extends AbstractPage
{
    protected $templateName = 'AddCity';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $dbObj->insertStation($id, $postaja, $password);
    }
}
?>
