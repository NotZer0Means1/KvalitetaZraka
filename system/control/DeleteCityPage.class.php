<?php

include 'AbstractPage.class.php';

class DeleteCityPage extends AbstractPage
{
    protected $templateName = 'DeleteCity';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $dbObj->deleteStation($id, $postaja, $password);


    }
}

$page = new DeleteCityPage();

?>