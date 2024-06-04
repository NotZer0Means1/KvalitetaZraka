<?php

include "AbstractPage.class.php";

class ApiPage extends AbstractPage
{
    protected $templateName = "Api";

    public function execute()
    {
        $request = $_GET;

        $postaja = $request['postaja'];
        $polutant = $request['polutant'];
        $tipPodatka = $request['tipPodatka'];
        $vrijemeOd = $request['vrijemeOd'];
        $vrijemeDo = $request['vrijemeDo'];

        //http://localhost/KvalitetaZraka/?page=Api&postaja=307&polutant=1&tipPodatka=0&vrijemeOd=20.05.2024&vrijemeDo=03.06.2024

        // API endpoint
        $apiUrl = "https://iszz.azo.hr/iskzl/rs/podatak/export/json?postaja={$postaja}&polutant={$polutant}&tipPodatka={$tipPodatka}&vrijemeOd={$vrijemeOd}&vrijemeDo={$vrijemeDo}";

        // Initialize cURL session
        $ch = curl_init();

        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if(curl_errno($ch)) {
            echo 'cURL error: ' . curl_error($ch);
        } else {
            // Decode the JSON response
            $resources = json_decode($response, true);

            // Process the data
            if ($resources === null) {
                echo 'Error decoding JSON response';
            }
        }

        // Close cURL session
        curl_close($ch);

        $this -> data = [
            'resources' => $resources
        ];
    }

}

$page = new ApiPage();

?>
