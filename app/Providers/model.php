<?php

class Model {

    private $connect;
    public $statement;

    function __construct() {
        $this->connect = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
    }

    function fetchQuery($sql) {
        try {
            $this->statement = $this->connect->prepare($sql);
            $this->statement->execute();
            if (!$this->statement->execute() || $this->statement->errorCode() != '0000') {
                $error = $this->statement->errorInfo();
                throw new PDOException("Database error {$error[0]} : {$error[2]},driver error code is {$error[1]}");
                exit;
            }
            //return $this->statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function InsertQuery($table, $data) {
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

}