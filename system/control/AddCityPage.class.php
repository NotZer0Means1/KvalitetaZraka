<?php
// primjer open-closed principa
include 'AbstractPage.class.php';
use System\Model\CityModel\CityModel;

class AddCityPage extends AbstractPage
{
    protected $templateName = 'AddCity';

    protected static $dbObj = null;

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
