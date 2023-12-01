<?php

class Database {
    public $pdo;

    public function __construct($db = "sys", $user="root", $pwd="M@hmet2005", $host="localhost"){
        try{
            $this->pdo = new PDO ( "mysql: host=$host ; dbname=$db", $user, $pwd);
            $this->pdo->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "connected to Database $db"; 
        }catch (PDOExecption $e){
            echo "connection failed" . $e->getMessage();
        }
    }
}
?>