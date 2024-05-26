<?php 
class MySQLiDatabase {

    public $MySQLi;
    protected $host;
    protected $user;
    protected $password;
    protected $database;

    public function __construct($host, $user, $password, $database){
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }



    protected function connect(){
        $this->MySQLi = new \MySQLi($this->host, $this->user, $this->password, $this->database);
    }

    protected function connectNoDB(){ 
        $this->MySQLi = new \MySQLi("localhost", null, null);
    }

    public function sendQuery($query) {
        return $this->MySQLi->query($query);
    }

    public function fetchArray($result = null) {
        return $result->fetch_array();
    }

    public function createDatabase() {
        if($this->database === null) {
            $purityDB = "CREATE DATABASE kvalitetaZraka";
            $purityUser = "CREATE TABLE users (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                passwrd VARCHAR(30) NOT NULL
            )";
            $purityStations = "CREATE TABLE stations (
                id INT(3) UNSIGNED PRIMARY KEY,
                station VARCHAR(30) NOT NULL
            )";
            $purityType = "CREATE TABLE polutant (
                id INT(3) UNSIGNED PRIMARY KEY,
                polution VARCHAR(30) NOT NULL
            )";
            $this->connectNoDB();
            $this->sendQuery($purityDB);
            $this->sendQuery($purityUser);
            $this->sendQuery($purityStations);
            $this->sendQuery($purityType);
            $this->stationsDB();
        } else return;
    }

    public function stationsDB() {
        $stations = [
            173 => "Kaštel Sućurac",
            307 => "Dubrovnik",
            308 => "Karepovac",
            255 => "Kopački rit",
            161 => "Kutina",
            257 => "Plitvička jezera",
            168 => "Split",
            127 => "Umag",
            121 => "Velika gorica",
            155 => "Zagreb"
        ];
        foreach($stations as $station) {
            $sql = "INSERT INTO stations (id, station)
                VALUES (".$station['id'].", ".$station['station'].")";
            $this->sendQuery($sql); 
        }

    }
}

?>