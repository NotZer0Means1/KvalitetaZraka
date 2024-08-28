<?php

include 'AbstractPage.class.php';

use System\Model\CityModel\CityModel;

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

        $city = new CityModel();

        $city->updateStationName($id, $postaja,$password);
        
    }
}

$page = new UpdateCityNamePage();

?>