<?php
// primjer open-closed principa
include_once 'AbstractPage.class.php';

class AddCityPage extends AbstractPage
{
    protected $templateName = 'AddCity';

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $postaja = $request['postaja'];
        $password = $request['password'];

        $city = new CityModel();
        $city->insertStation($id, $postaja, $password);
        
    }
}

$page = new AddCityPage();
?>
