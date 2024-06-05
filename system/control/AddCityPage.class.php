<?php

include 'AbstractPage.class.php';
include 'AppCore.class.php';

class CityPage extends AbstractPage
{
    protected $templateName = 'AddCity';

    protected static $dbObj = null;

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        $dbObj = AppCore::getDB();
        
        $dbObj->insertStation($id, $postaja, $password);

    }
}

?>