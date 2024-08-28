<?php

use function PHPSTORM_META\type;

class Database{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db_name = DB_NAME;

    private $database;
    private $stmt;

    public function __construct(){
        $dns = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
        
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->database = new PDO($dns, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            echo 'Koneksi gagal: ' . $e->getMessage();;
        }
    }

    public function query($query){
        $this->stmt = $this->database->prepare($query);
    }

    public function bind($param, $value, $type = null){
        if(is_null($type)){
            switch(true){
                case is_int($value) :
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value) :
                    $type = PDO::PARAM_BOOL;
                    break;
                
                case is_null($value) :
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;

            }
        }

        $this->stmt->bindvalue($param, $value, $type);
    }

    public function Execute(){
        $this->stmt->execute();
    }

    public function resultSet(){
        $this->execute();
        $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
