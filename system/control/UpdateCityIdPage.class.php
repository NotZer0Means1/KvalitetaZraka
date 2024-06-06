<?php

include 'AbstractPage.class.php';

class UpdateCityIdPage extends AbstractPage
{
    protected $templateName = 'UpdateCityId';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $dbObj->updateStationId($id, htmlspecialchars($postaja, ENT_QUOTES, 'UTF-8'), htmlspecialchars($password, ENT_QUOTES, 'UTF-8'));


    }
}

$page = new UpdateCityIdPage();

?>