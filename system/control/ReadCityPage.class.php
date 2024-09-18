<?php

include 'AbstractPage.class.php';

class ReadCityPage extends AbstractPage
{
    protected $templateName = 'ReadCity';

    public function execute()
    {
        $request = $_GET;
        $id = $request['id'];
        $password = $request['password'];
        $method = $request['method'];

        $city = new PurityModel();

        $resources = $city->readStation($id, $password);
        
        // fake test
        // $fakeresources = $city->readFakeStation();

        if ($method == 'json')
            $resources = $this->printJSON($resources);
        else
            $resources = $this->printXML($resources);
        $this -> data = [
            'resources' => $resources
        ];

        // fake ispis
        // $this->data = [
        //     'resources' => $fakeresources
        // ];
    }

    public function printJSON($data)
    {
        return json_encode($data);
    }

    public function printXML($data)
    {

    }
}

$page = new ReadCityPage();

?>