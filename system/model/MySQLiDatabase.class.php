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
            $this->sendQuery($purityData);
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

        $pass = $this->MySQLi->prepare("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        if($pass->get_result())
        {
            $insertStation = $this->MySQLi->prepare("INSERT INTO stations (id, station)
            VALUES (?, ?)");
            $insertStation ->bind_param("is", $id, $station);
            $insertStation -> execute();
            $insertStation -> close();
        }     
    }

    public function updateStationName($id, $station, $passwrd) {

        $pass = $this->MySQLi->prepare("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        if($pass->get_result())
        {
            $checkname = $this->MySQLi->prepare("SELECT id FROM stations WHERE id = ?");
            $checkname -> bind_param("i", $id);
            $checkname -> execute();
            if($checkname->get_result()) {
                $updatename = $this->MySQLi->prepare("UPDATE stations SET station = ? WHERE id = ?");
                $updatename -> bind_param("si", $station, $id);
                $updatename -> execute();
            }
        }

        $check = "SELECT passwrd from users where passwrd='$passwrd'";
        $checkid = "SELECT id from stations where id ='$id'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true) {
                $edit = "UPDATE stations SET station='$station' where id='$id'";
                $this->sendQuery($edit);
            }
        }
    }
    public function updateStationId($id, $station, $passwrd) {

        $pass = $this->MySQLi->prepare("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        if($pass->get_result())
        {
            $checkid = $this->MySQLi->prepare("SELECT id FROM stations WHERE station = ?");
            $checkid -> bind_param("s", $station);
            $checkid -> execute();
            if($checkid->get_result()) {
                $updateid = $this->MySQLi->prepare("UPDATE stations SET id= ? WHERE station = ?");
                $updateid -> bind_param("is", $id, $station);
                $updateid -> execute();
            }
        }
    }
    public function deleteStation($id, $station, $passwrd) {

        $pass = $this->MySQLi->prepare("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        if($pass->get_result())
        {
            $checkid = $this->MySQLi->prepare("SELECT id FROM stations WHERE id = ?");
            $checkid -> bind_param("i", $id);
            $checkid -> execute();
            if($checkid->get_result()){
                $checkstation = $this->MySQLi->prepare("SELECT station FROM stations WHERE station = ?");
                $checkstation -> bind_param("s", $station);
                $checkstation -> execute();
                if($checkstation->get_result()) {
                    $delete = $this->MySQLi->prepare("DELETE FROM stations WHERE id = ?");
                    $delete -> bind_param("i", $id);
                    $delete -> execute();
                }
            }

        }
    }
    public function getStations() {
        $getdata = "SELECT * FROM stations";
        $sqldef = $this->MySQLi->prepare($getdata);
        $sqldef -> execute();
        $data = $sqldef -> get_result();
        $stations = [];
        while($stations = $data->fetch_assoc()) {
            $xssdef = array_map(function($station) {
                return htmlspecialchars($station, ENT_QUOTES, 'UTF-8');
            }, $stations);
            $stations[] = $xssdef;
        }
        return $stations;
    }

    public function insertPolutants($id, $polutant, $passwrd) {

        $check = "SELECT passwrd from users where passwrd='$passwrd'";
        if ($this->sendQuery($check) == true) {
            $sql = "INSERT INTO polutants (id, polutant)
                values ('$id', '$polutant')";
            $this->sendQuery($sql);
        }        
    }

    public function updatePolutantName($id, $polutant, $passwrd) {

        $check = "SELECT passwrd from users where passwrd='$passwrd'";
        $checkid = "SELECT id from polutants where id ='$id'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true) {
                $edit = "UPDATE polutants SET polutant='$polutant' where id='$id'";
                $this->sendQuery($edit);
            }
        }
    }
    public function updatePolutantId($id, $polutant, $passwrd) {

        $check = "SELECT passwrd from users where passwrd='$passwrd'";
        $checkpolutant = "SELECT id from polutants where polutant ='$polutant'";
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkpolutant) == true) {
                $edit = "UPDATE polutants SET id='$id' where polutant='$polutant'";
                $this->sendQuery($edit);
            }
        }
    }
    public function deletePolutant($id, $polutant, $passwrd) {

        $check = "SELECT passwrd from users where passwrd='$passwrd'";
        $checkid = "SELECT id from polutants where id ='$id'";
        $checkpolutant = "SELECT polutant from polutants where polutant = '$polutant'";
        
        if ($this->sendQuery($check) == true) {
            if ($this->sendQuery($checkid) == true && $this->sendQuery($checkpolutant) == true) {
                $delete = "DELETE FROM polutants where id='$id'";
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

    public function insertData ($station, $polutant, $val, $mesurements, $seconds) {
        
        $inserting = $this->MySQLi->prepare("INSERT INTO purityData (id_station, id_polutant, vrijednost, mjernaJedinica, vrijeme)
            VALUES (?, ?, ?, ?, ?)");
        $inserting->bind_param("iisss", $station, $polutant, $val, $mesurements, $seconds);
        $inserting->execute();
        $inserting->close();

    }
    public function getData() {
        $getData = "SELECT * FROM purityData";
        $data = $this->sendQuery($getData);
        $fullData = [];
        while($fullData = $data->fetch_row()) {
            $fullData[] = $fullData;
        }
        return $fullData;
    }

    public function readStation ($station, $passwrd) 
    {
        $pass = $this->MySQLi->prepare("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        if($pass->get_result())
        {
            $check = $this->MySQLi->prepare("SELECT vrijednost, mjernaJedinica, vrijeme FROM purityData WHERE id_station = ?");
            $check->bind_param("i", $station);
            $check->execute();
            $result = $check->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }
}

?>
