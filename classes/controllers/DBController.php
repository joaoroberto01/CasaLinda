<?php

    abstract class DBController {
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

        public function selectSingle($fields, $predicate = "", $params = []){
            $query = "SELECT $fields FROM $this->table $predicate";
            $statement = $this->execute($query, $params);

            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function select($fields, $predicate = "", $params = []){
            $query = "SELECT $fields FROM $this->table $predicate";
            $statement = $this->execute($query, $params);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update($dict, $where = "", $whereParams = []){
            $fields = implode('= ?,', array_keys($dict)) . '= ?'; // "nome = ?, idade = ?"
            
            $values = array_merge(array_values($dict), $whereParams);

            $query = "UPDATE $this->table SET $fields $where";

            $this->execute($query, $values);
        }

        

        public function delete($where, $params){
            $this->execute("DELETE FROM $this->table $where", $params);
        }

        public function rawSelect($query = "", $params = []){
            $statement = $this->execute($query, $params);

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        public function raw($query = "", $params = []){
            $statement = $this->execute($query, $params);
        }

    }
?>