<?php

class DbConnection {
    public $host = "localhost";
    public $user = "root";
    public $pwd = "";
    public $dbName = "planet";

    public function connect() {
        try{
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbName;
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
         }
         catch(PDOException $e){
             echo "Error: " . $e->getMessage();
           }
    }

    public function __destruct() {
            $this->pdo = NULL;
    }
}