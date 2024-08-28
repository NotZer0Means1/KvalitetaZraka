<?php

class CityModel extends AbstractModel
{
    public function insertStation($id, $station, $passwrd) { // model postoja

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
}

?>