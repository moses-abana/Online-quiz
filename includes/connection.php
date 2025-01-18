<?php

class Connection{
    private $dsn = "mysql:host=localhost;dbname=csc102";
    private $dbname = "root";
    private $dbpassword = "";

    public function connect(){
        try {
            $pdo = new PDO($this->dsn,$this->dbname,$this->dbpassword);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         } catch (PDOException $th) {
             echo "Connection failed" . $th->getMessage();
         }
    
         return $pdo;
    }

}