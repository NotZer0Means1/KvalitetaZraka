<?php



class DeleteCityPage extends AbstractPage
{
    protected $templateName = 'DeleteCity';

    protected static $dbObj = null;

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