<?php
/*abstract class Model{
    protected $dbh;
    protected $stmt;

    public function __construct(){
        //db details in config file!
        $this->dbh = new PDO(
           "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type=null){
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
                default:
                $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute(){
        $this->stmt->execute();
    }

    public function result_set(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function last_id_insert(){
        return $this->dbh->lastInsertId();
    }

    public function single(){
        $this->execute();
        //fetch instead of fetch all for 1 record!!!
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

}
*/

class Model{
    protected $conn;
    protected $query;
    protected $stmt;
    protected $params;
    protected $bind_class;

    public function __construct($db_class, $query, $params){
        $this->query = $query;
        $this->params = $params;
        $this->conn = $db_class->open_db_connection();
        $this->stmt = $this->conn->prepare($this->query);
    }

    public function print_results(){
        $this->bind_class = new Bind();
        $results = $this->bind_class->bind_execute($this->stmt, $this->params);
        var_dump($results);
        //A bind class needs stmt and params
        //$this->bind_class->bind_params();

        /*$this->bind_class->bind_params();
        $this->stmt->execute();
        $results = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($results);
        var_dump($this->params);*/
    }

    
}

