<?php

class DB {
    const HOST = 'localhost';
    const DB_NAME = 'test';
    const DB_USER = 'root';
    const DB_PASSWORD = '';

    private $table;
    private $connection;

    public function __construct($table = null){
        $this->table = $table;

        $this->createConnection();
    }

    private function createConnection(){
        try{
            $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME,
                self::DB_USER, self::DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('DB ERROR: '.$e->getMessage());
        }
    }

    public function execute($query,$params = []){
        try{
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        }catch(PDOException $e){
            die('DB ERROR: '.$e->getMessage());
        }
    }

    public function insert($values){
        $fields = implode(',', array_keys($values));
        $binds  = array_pad([], count($fields), '?');
        $binds = implode(',', $binds);

        $query = "INSERT INTO $this->table ($fields) VALUES ($binds)";

        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId();
    }

    public function select($fields = '*', $where = [], $order = null, $limit = null){
        $clause = !empty($where) ? "WHERE ${where['clause']}" : '';
        $order = !empty($order) ? "ORDER BY $order" : '';
        $limit = !empty($limit) ? "LIMIT $limit" : '';

        $query = "SELECT $fields FROM $this->table $clause $order $limit";

        if (array_key_exists("values", $where))
            $statement = $this->execute($query, $where['values']);
        else{
            echo "$query";
            $statement = $this->execute($query);
        }

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function selectAll($fields = '*', $order = null, $limit = null){
        $order = !empty($order) ? "ORDER BY $order" : '';
        $limit = !empty($limit) ? "LIMIT $limit" : '';

        $query = "SELECT $fields FROM $this->table $order $limit";

        return $this->execute($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($where, $values){
        $fields = implode('= ?,', array_keys($values)) . "= ?";

        $values = array_merge(array_values($values), $where['values']);

        $query = "UPDATE $this->table SET $fields WHERE ${$where['clause']}";

        $this->execute($query, $values);
    }

    public function delete($where){
        $this->execute("DELETE FROM $this->table WHERE $where");
    }

}

?>