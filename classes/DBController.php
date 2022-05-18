<?php

    class DBController {
        const HOST = 'localhost';
        const DB_NAME = 'casa_linda';
        const DB_USER = 'root';
        const DB_PASSWORD = ''; 

        private $table;
        private $connection;
        
        public function __construct($table) {
            $this->table = $table;
            $this->createConnection();
        }

        private function createConnection(){
            try {
                $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME, self::DB_USER, self::DB_PASSWORD);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("DB CONNECTION ERROR: " . $e->getMessage());
            }
        }

        private function execute($query, $params = []){
            try {
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }catch(PDOException $e){
                die('DB QUERY ERROR: '.$e->getMessage());
            }
        }

        public function insert($dict){
            $keys = array_keys($dict);
            $fields = implode(',', $keys); //retorna string "a,b,c"
            $values = array_pad([], count($keys), "?"); //retorna vetor [?, ?, ?]
            $values = implode(',', $values); //retorna string "?,?,?"
            
            $query = "INSERT INTO $this->table ($fields) VALUES($values)";
            
            $this->execute($query, array_values($dict));

            return $this->connection->lastInsertId();
        }
    }
?>