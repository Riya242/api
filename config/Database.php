<?php 
class Database{
    private $host="localhost";
    private $dbname="api";
    private $user="root";
    private $password="";
    public $conn;
    public function getConnection(){
        $this->conn=null;
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->user,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->conn;
    }
}