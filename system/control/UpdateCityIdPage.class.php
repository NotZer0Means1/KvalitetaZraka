<?php

include 'AbstractPage.class.php';

class UpdateCityIdPage extends AbstractPage
{
    protected $templateName = 'UpdateCityId';

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        $city = new CityModel();

        $city->updateStationId($id, $postaja, $password);

    }
}

$page = new UpdateCityIdPage();

?>