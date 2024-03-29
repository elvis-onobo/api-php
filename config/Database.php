<?php
class Database{
    // DB params
    private $host = 'localhost';
    private $db_name = 'apiphp';
    private $username = 'root';
    private $password = '';
    private $conn;

    // DB Connect method
    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host=' .$this->host .';dbname='. $this->db_name, $this->username, $this->password);
            // get errors whenever they occur
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Connection Error:' .$e->getMessage();
        }

        RETURN $this->conn;
    }
}
