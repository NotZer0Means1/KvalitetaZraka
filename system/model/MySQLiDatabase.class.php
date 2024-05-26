<?php 
class MySQLiDatabase {

    public $MySQLi;
    protected $host;
    protected $user;
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

    public function sendQuary($quary) {
        return $this->MySQLi->quary($quary);
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
            $this->sendQuary($purityDB);
            $this->sendQuary($purityUser);
            $this->sendQuary($purityStations);
            $this->sendQuary($purityType);
        } else return;
    }

    public function stationsDB() {

    }
}

?>