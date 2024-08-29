<?php

include 'AbstractPage.class.php';

class UpdateCityNamePage extends AbstractPage
{
    protected $templateName = 'UpdateCityName';

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