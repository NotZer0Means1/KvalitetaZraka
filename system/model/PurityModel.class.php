<?php

class PurityModel extends AbstractModel
{
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
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $finalres = [];
            foreach($data as $row){
                $finalres[] = [
                    'vrijednost' => htmlspecialchars($row['vrijednost']),
                    'mjernaJedinica' => htmlspecialchars($row['mjernaJedinica']),
                    'vrijeme'=> htmlspecialchars($row['vrijeme'])
                ];
            }
            return $finalres;

        }
    }
}
?>