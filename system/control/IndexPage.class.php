<?php

include 'AbstractPage.class.php';

class IndexPage extends AbstractPage
{
    protected $templateName = 'Index';

    public function execute()
    {
        $resources = [
            1 => [
                'url' => 'Api',
                'method' => '?page=Api&postaja=307&polutant=1&tipPodatka=0&vrijemeOd=20.05.2024&vrijemeDo=03.06.2024',
                'description' => 'Dohvacivanje api podataka'
            ],
            2 => [
                'url' => 'AddCity',
                'method' => '?page=DeleteCity&id=777&postaja=INOT&password=1234',
                'description' => 'Dodvanje grada u bazu podataka'
            ],
            3 => [
                'url' => 'UpdateCityId',
                'method' => '?page=UpdateCityId&id=777&postaja=INOT&password=1234',
                'description' => 'Promjena Id-a grada'
            ],
            4 => [
                'url' => 'UpdateCityName',
                'method' => '?page=UpdateCityName&id=777&postaja=INOT&password=1234',
                'description' => 'Promjena naziva grada'
            ],
            5 => [
                'url' => 'DeleteCity',
                'method' => '?page=DeleteCity&id=777&postaja=INOT&password=1234',
                'description' => 'Brisanje grada'
            ],
            6 => [
                'url' => 'ReadCity',
                'method' => '?page=ReadCity&id=777&password=1234',
                'description' => 'Ucitavanje API podata vezanih za grad iz baze'
            ]
        ];

        $this -> data = [
            'resources' => $resources
        ];
    }
}

$page = new IndexPage();

?>