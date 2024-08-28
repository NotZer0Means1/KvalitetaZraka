<?php

include_once 'AbstractModel.class.php';


class CityModel extends AbstractModel
{

    public function __construct()
    {
        parent::__construct();
    }
    public function insertStation($id, $station, $passwrd) { // model postoja

        $pass = $this->MySQLi->prepared("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        $passRes = $pass->get_result();
        if($passRes->num_rows > 0)
        {
            $insertStation = $this->MySQLi->prepared("INSERT INTO stations (id, station)
            VALUES (?, ?)");
            $insertStation ->bind_param("is", $id, $station);
            $insertStation -> execute();
            $insertStation -> close();
        }     
    }
    public function updateStationName($id, $station, $passwrd) {

        $pass = $this->MySQLi->prepared("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        $passRes = $pass->get_result();
        if($passRes->num_rows > 0)
        {
            $checkname = $this->MySQLi->prepared("SELECT id FROM stations WHERE id = ?");
            $checkname -> bind_param("i", $id);
            $checkname -> execute();
            if($checkname->get_result()) {
                $updatename = $this->MySQLi->prepared("UPDATE stations SET station = ? WHERE id = ?");
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

        $pass = $this->MySQLi->prepared("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        $passRes = $pass->get_result();
        if($passRes->num_rows > 0)
        {
            $checkid = $this->MySQLi->prepared("SELECT id FROM stations WHERE station = ?");
            $checkid -> bind_param("s", $station);
            $checkid -> execute();
            if($checkid->get_result()) {
                $updateid = $this->MySQLi->prepared("UPDATE stations SET id= ? WHERE station = ?");
                $updateid -> bind_param("is", $id, $station);
                $updateid -> execute();
            }
        }
    }
    public function deleteStation($id, $station, $passwrd) {

        $pass = $this->MySQLi->prepared("SELECT passwrd FROM users WHERE passwrd = ?");
        $pass -> bind_param("s", $passwrd);
        $pass->execute();
        $passRes = $pass->get_result();
        if($passRes->num_rows > 0)
        {
            $checkid = $this->MySQLi->prepared("SELECT id FROM stations WHERE id = ?");
            $checkid -> bind_param("i", $id);
            $checkid -> execute();
            if($checkid->get_result()){
                $checkstation = $this->MySQLi->prepared("SELECT station FROM stations WHERE station = ?");
                $checkstation -> bind_param("s", $station);
                $checkstation -> execute();
                if($checkstation->get_result()) {
                    $delete = $this->MySQLi->prepared("DELETE FROM stations WHERE id = ?");
                    $delete -> bind_param("i", $id);
                    $delete -> execute();
                }
            }
        }
    }
    public function getStations() {
        $getdata = "SELECT * FROM stations";
        $sqldef = $this->MySQLi->prepared($getdata);
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
}

?>