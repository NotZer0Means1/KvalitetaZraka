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
        // $purityDB = "CREATE DATABASE '$this->database'";
        // $this->sendQuery($purityDB);

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
            $this->stationsDB();
        }

        if($this->checkExistance('polutants')->num_rows == 0)
        {
            $purityType = "CREATE TABLE polutants (
                id INT(3) UNSIGNED PRIMARY KEY,
                polutant VARCHAR(30) NOT NULL
            )";
            $this->sendQuery($purityType);
            $this->typeDB();
        }
                  
        
        
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
    
    public function insertStation($id, $station, $passwrd) {
        $newId = $id;
        $newStation = $station;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        if ($this->sendQuery($check) == true) {
            $sql = "INSERT INTO stations (id, station)
                values ('$newId', '$newStation')";
            $this->sendQuery($sql);
        }        
    }

    public function updateStationName($id, $station, $passwrd) {
        $newId = $id;
        $newStation = $station;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkid = "SELECT id from stations where id ='$newId'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true) {
                $edit = "UPDATE stations SET station='$newStation' where id='$newId'";
                $this->sendQuery($edit);
            }
        }
    }
    public function updateStationId($id, $station, $passwrd) {
        $newId = $id;
        $newStation = $station;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkstation = "SELECT id from stations where station ='$newStation'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkstation) == true) {
                $edit = "UPDATE stations SET id='$newId' where station='$newStation'";
                $this->sendQuery($edit);
            }
        }
    }
    public function deleteStation($id, $station, $passwrd) {
        $newId = $id;
        $newStation = $station;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkid = "SELECT id from stations where id ='$newId'";
        $checkstation = "SELECT station from stations where station = '$newStation'";
        
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true && $this->sendQuery($checkstation) == true) {
                $delete = "DELETE FROM stations where id='$newId'";
                $this->sendQuery($delete);
            }
        }
    }
    public function getStations() {
        $getdata = "SELECT * FROM stations";
        $data = $this->sendQuery($getdata);
        $stations = [];
        while($stations = $data->fetch_row()) {
            $stations[] = $stations;
        }
        return $stations;
    }

    public function insertPolutants($id, $polutant, $passwrd) {
        $newId = $id;
        $newPolutant = $polutant;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        if ($this->sendQuery($check) == true) {
            $sql = "INSERT INTO polutants (id, polutant)
                values ('$newId', '$newPolutant')";
            $this->sendQuery($sql);
        }        
    }

    public function updatePolutantName($id, $polutant, $passwrd) {
        $newId = $id;
        $newPolutant = $polutant;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkid = "SELECT id from polutants where id ='$newId'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true) {
                $edit = "UPDATE polutants SET polutant='$newPolutant' where id='$newId'";
                $this->sendQuery($edit);
            }
        }
    }
    public function updatePolutantId($id, $polutant, $passwrd) {
        $newId = $id;
        $newPolutant = $polutant;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkpolutant = "SELECT id from polutants where polutant ='$newPolutant'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkpolutant) == true) {
                $edit = "UPDATE polutants SET id='$newId' where polutant='$newPolutant'";
                $this->sendQuery($edit);
            }
        }
    }
    public function deletePolutant($id, $polutant, $passwrd) {
        $newId = $id;
        $newPolutant = $polutant;
        $newPasswrd = $passwrd;
        $check = "SELECT passwrd from users where passwrd='$newPasswrd'";
        $checkid = "SELECT id from polutants where id ='$newId'";
        $checkpolutant = "SELECT polutant from polutants where polutant = '$newPolutant'";
        
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true && $this->sendQuery($checkpolutant) == true) {
                $delete = "DELETE FROM polutants where id='$newId'";
                $this->sendQuery($delete);
            }
        }
    }
    public function getPolutant() {
        $getdata = "SELECT * FROM polutants";
        $data = $this->sendQuery($getdata);
        $polutants = [];
        while($polutants = $data->fetch_row()) {
            $polutants[] = $polutants;
        }
        return $polutants;
    }
}

?>
