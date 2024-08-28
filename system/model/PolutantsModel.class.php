<?php 

namespace System\Model\PolutantsModel;
use System\Model\AbstractModel;
class PolutantsModel extends AbstractModel 
{
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
}

?>