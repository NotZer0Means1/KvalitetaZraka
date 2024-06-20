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
        $method = $request['method'];

        require_once("system/AppCore.class.php");
        $dbObj = AppCore::getDB();

        $resources = $dbObj->readStation($id, $password);
        if ($method == 'json')
            $resources = $this->printJSON($resources);
        else
            $resources = $this->printXML($resources);
        $this -> data = [
            'resources' => $resources
        ];
    }
}

$page = new ReadCityPage();

?>