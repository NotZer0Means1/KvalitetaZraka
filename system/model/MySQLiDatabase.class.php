<?php 
class MySQLiDatabase {

    public $mySQLi;
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

  
}

?>