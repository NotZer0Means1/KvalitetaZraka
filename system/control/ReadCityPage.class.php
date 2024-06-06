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
        $password = $request['password'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $resources = $dbObj->readStation($id, htmlspecialchars($password, ENT_QUOTES, 'UTF-8'));
        $this -> data = [
            'resources' => $resources
        ];
    }
}

$page = new ReadCityPage();

?>