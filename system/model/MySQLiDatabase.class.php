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

    public function sendQuery($request)
    {
        return $this->MySQLi->query($request);
    }

    public function prepared($query) {
        return $this->MySQLi->prepare($query);
    }

    public function sendInternalQuery($query) 
    {
        return $this->MySQLi->query($query);
    }

    protected function checkExistance($name)
    {
        $query = "SHOW TABLES LIKE '$name'";
        $result = $this->sendInternalQuery($query);
        return $result;
    }

    public function fetchArray($result = null) 
    {
        return $result->fetch_array();
    }

    private function createDatabase() 
    {
        // $purityDB = "CREATE DATABASE '$this->database'";
        // $this->sendInternalQuery($purityDB);

        if($this->checkExistance('users')->num_rows == 0)
        {
            $purityUser = "CREATE TABLE users (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(30) NOT NULL,
                passwrd VARCHAR(30) NOT NULL
            )";
            $this->sendInternalQuery($purityUser);
        }

        if($this->checkExistance('stations')->num_rows == 0)
        {
            $purityStations = "CREATE TABLE stations (
                id INT(3) UNSIGNED PRIMARY KEY,
                station VARCHAR(30) NOT NULL
            )";
            $this->sendInternalQuery($purityStations);
            $this->stationsDB();
        }

        if($this->checkExistance('polutants')->num_rows == 0)
        {
            $purityType = "CREATE TABLE polutants (
                id INT(3) UNSIGNED PRIMARY KEY,
                polutant VARCHAR(30) NOT NULL
            )";
            $this->sendInternalQuery($purityType);
            $this->typeDB();
        }

        if($this->checkExistance('purityData')->num_rows == 0)
        {
            $purityData = "CREATE TABLE purityData (
                id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                id_station INT(3) UNSIGNED,
                id_polutant INT(3) UNSIGNED,
                vrijednost VARCHAR(255) NOT NULL,
                mjernaJedinica VARCHAR(10) NOT NULL,
                vrijeme VARCHAR (13)NOT NULL,
                FOREIGN KEY (id_station) REFERENCES stations(id),
                FOREIGN KEY (id_polutant) REFERENCES polutants(id)
            )";
            $this->sendInternalQuery($purityData);
        }
    }

    private function stationsDB() // u controller / ali bolje kreirat posebni model za grad
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
            $this->sendInternalQuery($sql);
        }
    }

    private function typeDB() // isto posebni model // dio grada
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
            $this->sendInternalQuery($sql);
        }
    }
}

?>
