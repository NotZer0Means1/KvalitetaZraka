<?php

include 'AbstractPage.class.php';

class IndexPage extends AbstractPage
{
    protected $templateName = 'Index';

    public function execute()
    {
        $resources = [
            1 => [
                'url' => 'Index',
                'method' => 'GET',
                'description' => 'API documentation and instructions'
            ],
            2 => [
                'url' => 'GetData',
                'method' => 'GET',
                'description' => 'Get data from database. Supported parameters: id, date, limit'
            ],
            3 => [
                'url' => 'AddCity',
                'method' => 'POST',
                'description' => 'Adds new city to the database. Required parameters: name, country'
            ]
        ];

        $this -> data = [
            'resources' => $resources
        ];
    }
}

$page = new IndexPage();

?>