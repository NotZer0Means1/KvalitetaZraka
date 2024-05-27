<?php 
class MySQLiDatabase 
{

    public $MySQLi;
    protected $host;
    protected $user;
    protected $password;
    protected $database;

    public function __construct($host, $user, $password, $database)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
        $this->createDatabase();
    }

    protected function connect()
    {
        $this->MySQLi = @new MySQLi($this->host, $this->user, $this->password, $this->database);
    }

    public function sendQuery($query) 
    {
        return $this->MySQLi->query($query);
    }

    protected function checkExistance($name)
    {
        $query = "SHOW TABLES LIKE '$name'";
        $result = $this->sendQuery($query);
        return $result;
    }

    public function fetchArray($result = null) 
    {
        return $result->fetch_array();
    }

    private function createDatabase() 
    {

        //$purityDB = "CREATE DATABASE " . $this->database;

        if($this->checkExistance('users')->num_rows == 0)
        {
            $purityUser = "CREATE TABLE users (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                passwrd VARCHAR(30) NOT NULL
            )";
            $this->sendQuery($purityUser);
        }

        if($this->checkExistance('stations')->num_rows == 0)
        {
            $purityStations = "CREATE TABLE stations (
                id INT(3) UNSIGNED PRIMARY KEY,
                station VARCHAR(30) NOT NULL
            )";
            $this->sendQuery($purityStations);
        }

        if($this->checkExistance('polutants')->num_rows == 0)
        {
            $purityType = "CREATE TABLE polutants (
                id INT(3) UNSIGNED PRIMARY KEY,
                polutant VARCHAR(30) NOT NULL
            )";
            $this->sendQuery($purityType);
        }
                  
        //$this->sendQuery($purityDB);

        $this->stationsDB();
        $this->typeDB();
    }

    private function stationsDB() 
    {
        $stations = [
            173 => "Kastel Sucurac",
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
        foreach($stations as $key => $value) {
            $sql = "INSERT INTO stations (id, station)
                VALUES ('$key', '$value')";
            $this->sendQuery($sql);
        }
    }

    private function typeDB()
    {
        $polutants = [
            1 => "Dušikov dioksid",
            2 => "Sumporov dioksid",
            3 => "Ugljikov monoksid",
            4 => "Sumporovodik",
            5 => "Lebdeće čestice"
        ];
        foreach($polutants as $key => $value) {
            $sql = "INSERT INTO polutants (id, polutant)
                VALUES ('$key', '$value')";
            $this->sendQuery($sql);
        }
    }
}

?>
