<?php 

class CreateDB {

    public $MySQLi2;
    protected $host = "localhost";
    protected $user = "username";
    protected $password = "password";
    protected $database;
    public function __construct($host, $user, $password) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;

        $this->createDatabase();
    }

    protected function connectNoDB(){ 
        $this->MySQLi2 = new \MySQLi("localhost", "username", "password");
    }

    public function sendQuery2($query) {
        return $this->MySQLi2->query($query);
    }

    private function createDatabase() {
        $this->connectNoDB();

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

        $purityType = "CREATE TABLE polutants (
            id INT(3) UNSIGNED PRIMARY KEY,
            polutant VARCHAR(30) NOT NULL
        )"; 
                  
        $this->sendQuery2($purityDB);
        $this->sendQuery2($purityUser);
        $this->sendQuery2($purityStations);
        $this->sendQuery2($purityType);
        $this->stationsDB();
        $this->typeDB();

    }

    private function stationsDB() {
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
            $this->sendQuery2($sql); 
        }

    }
    private function typeDB(){
        $polutants = [
            1 => "Dušikov dioksid",
            2 => "Sumporov dioksid",
            3 => "Ugljikov monoksid",
            4 => "Sumporovodik",
            5 => "Lebdeće čestice"
        ];
        foreach($polutants as $polutant) {
            $sql = "INSERT INTO polutants (id, polutant)
                VALUES (".$polutant['id'].", ".$polutant['polutant'].")";
            $this->sendQuery2($sql); 
        }
    } 
}

?>