<?php

class Model {

    private $connect;
    public $statement;

    function __construct() {
        try{
            $this->connect = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        } catch(PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

    function fetchDB($sql) {
        try {
            $this->statement = $this->connect->prepare($sql);
            $this->statement->execute();
            if (!$this->statement->execute() || $this->statement->errorCode() != '0000') {
                $error = $this->statement->errorInfo();
                throw new PDOException("Database error {$error[0]} : {$error[2]},driver error code is {$error[1]}");
                exit;
            }
             $results = $this->statement->fetchAll(PDO::FETCH_ASSOC);
             return $results[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function InsertDB($table, $data) {
        $fieldNames = implode('`,`', array_keys($data));
        $fieldValues = ':' . implode(',:', array_keys($data));

        try {
            $this->statement = $this->connect->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");
            foreach ($data as $key => $value) {
                $this->statement->bindValue(":$key", $value);
            }

            if (!$this->statement->execute() || $this->statement->errorCode() != '0000') {
                $error = $this->statement->errorInfo();
                throw new PDOException("Database error {$error[0]} : {$error[2]},driver error code is {$error[1]}");
                exit;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function updateDB($table, $data = [], $where){
        try{
            ksort($data);
            $this->parameters = NULL;
            foreach($data as $key=> $value) {
                $this->parameters .= "`$key`=:$key,";
            }

            $this->parameters = rtrim($this->parameters, ',');
            $this->statement = $this->connect->prepare("UPDATE $table SET $this->parameters WHERE $where");
            
            foreach ($data as $key => $value) {
                $this->statement->bindValue(":$key", $value);
            }
            
            $this->statement->execute();
            if (!$this->statement->execute() || $this->statement->errorCode() != '0000') {
                $error = $this->statement->errorInfo();
                throw new PDOException("Database error {$error[0]} : {$error[2]},driver error code is {$error[1]}");
                exit;
            }
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function deleteDB($table, $data = []){
        try{
            ksort($data);

            $key = array_keys($data)[0];
            $values = $data[$key];
            $values = implode(',', $values);

            $this->statement = $this->connect->prepare("DELETE FROM $table WHERE $key IN ({$values})");
                $this->statement->execute();
                if (!$this->statement->execute() || $this->statement->errorCode() != '0000') {
                    $error = $this->statement->errorInfo();
                    throw new PDOException("Database error {$error[0]} : {$error[2]},driver error code is {$error[1]}");
                    exit;
                }
        }catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

}