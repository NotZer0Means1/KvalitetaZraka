<?php


include "AbstractPage.class.php";

class ApiPage extends AbstractPage
{
    protected $templateName = "Api";
    protected $dbObj = null;

    public function execute()
    {
        $request = $_GET;

        $postaja = $request['postaja'];
        $polutant = $request['polutant'];
        $tipPodatka = $request['tipPodatka'];
        $vrijemeOd = $request['vrijemeOd'];
        $vrijemeDo = $request['vrijemeDo'];
        $method = $request['method'];

        //http://localhost/KvalitetaZraka/?page=Api&postaja=307&polutant=1&tipPodatka=0&vrijemeOd=20.05.2024&vrijemeDo=03.06.2024&method=json
        //http://localhost/KvalitetaZraka/?page=Api&postaja=255&polutant=32&tipPodatka=0&vrijemeOd=20.05.2024&vrijemeDo=03.06.2024&method=xml
        $apiUrl = "https://iszz.azo.hr/iskzl/rs/podatak/export/{$method}?postaja={$postaja}&polutant={$polutant}&tipPodatka={$tipPodatka}&vrijemeOd={$vrijemeOd}&vrijemeDo={$vrijemeDo}";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            $resources = json_decode($response, true);
        }

        // Close cURL session
        curl_close($ch);

        $this -> data = [
            'resources' => $resources
        ];

        $purity = new PurityModel();

        foreach($this->data['resources'] as $key => $resource)
        {
            $purity->insertData($postaja, $polutant, $resource['vrijednost'], $resource['mjernaJedinica'], $resource['vrijeme']);
        }
    }

}

$page = new ApiPage();

?>
