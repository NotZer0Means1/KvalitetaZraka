<?php

include_once 'AbstractPage.class.php';

class DeleteCityPage extends AbstractPage
{
    protected $templateName = 'DeleteCity';

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        $city = new CityModel();

        $city->deleteStation($id, $postaja, $password);
    }
}

$page = new DeleteCityPage();

?>