<?php
abstract class Model{
    protected $conn;
    protected $query;
    protected $stmt;
    protected $params;
    protected $bind_class;

    public function __construct(){
        
    }

    public function set_query($query, $params){
        $this->query = $query;
        $this->params = $params;
    }

    public function get_results(){
        $db_class = new Db();
        $this->conn = $db_class->open_db_connection();
        $this->stmt = $this->conn->prepare($this->query);
        $this->bind_class = new Bind();
        $results = $this->bind_class->bind_execute($this->stmt, $this->params);
        var_dump($results);
    }

    
}

