<?php

include 'AbstractPage.class.php';

use System\Model\PurityModel\PurityModel;
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

        $city = new PurityModel();

        $resources = $city->readStation($id, $password);
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