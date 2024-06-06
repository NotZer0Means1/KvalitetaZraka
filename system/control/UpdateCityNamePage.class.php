<?php

include 'AbstractPage.class.php';

class UpdateCityNamePage extends AbstractPage
{
    protected $templateName = 'UpdateCityName';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $dbObj->updateStationName($id, htmlspecialchars($postaja, ENT_QUOTES, 'UTF-8'), htmlspecialchars($password, ENT_QUOTES, 'UTF-8'));
        
    }
}

$page = new UpdateCityNamePage();

?>