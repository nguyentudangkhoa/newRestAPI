<?php
class DB{
    private $host = "localhost";
    private $userName = "root";
    private $pwd="";
    private $dbName = "phpoop";
    public function Connect(){
        try {
            $dns = "mysql:host=$this->host;dbname=$this->dbName";
            // set the PDO error mode to exception
            $pdo = new PDO($dns,$this->userName,$this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
        catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
