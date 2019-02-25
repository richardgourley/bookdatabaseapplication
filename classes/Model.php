<?php
abstract class Model{
    protected $conn;
    protected $db;
    protected $bind;

    public function __construct(){
       $this->db = new Db();
       $this->bind = new Bind();
       $this->conn = $this->db->open_db_connection(); //see db class
    }

    public function query_get_results($query, $params){
       $stmt = $this->conn->prepare($query);
       $stmt = $this->bind->bind_params($stmt, $params); //see bind class
       $stmt->execute();
       $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
       return $results;
    }

    public function query_get_message($query, $params){
       $stmt = $this->conn->prepare($query);
       $stmt = $this->bind->bind_params($stmt, $params);
       $message = $stmt->execute(); //$message will return a true bool if succsseful db operation.
       return $message;
    }

    public function validate_year($str){
       if(strlen($str) == 4 && is_numeric($str)){
          return true;
       }else{
          return false;
       }
    }

    public function validate_int($str){
       if(strlen($str) <= 13 && is_numeric($str)){
          return true;
       }else{
          return false;
       }
    }
    
}

