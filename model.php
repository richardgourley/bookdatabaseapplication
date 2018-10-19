<?php

require_once 'login.php';

/*
* The Database Configuration class is kept separate because we might want to change it later.
* 'S' in SOLID applied - one class has one responsibility.
*/

class DatabaseConfiguration
{
    protected $hn;
    protected $db;
    protected $un;
    protected $pw;

    function __construct($hn,$db,$un,$pw)
    {
        $this->hn = $hn;
        $this->db = $db;
        $this->un = $un;
        $this->pw = $pw;
    }
    
    //Provide get methods to allow MAIN CLASS to get properties and open a connection.
    
    function get_hn()
    {
        return $this->hn;
    }

    function get_db()
    {
        return $this->db;
    }

    function get_un()
    {
        return $this->un;
    }

    function get_pw()
    {
        return $this->pw;
    }
}

/** 
 * The TEMPLATE DESIGN PATTERN is used.
 * We can extend the main abstract class
 */


abstract class MainClass
{
    //db config class passed in constructor - DEPENDENCY INJECTION
    protected $db_config;
    //array of data to display
    protected $content_out;
    //any messages to display after query
    protected $message;
    //$conn and $stmt work with our PDO instance for database interraction
    protected $conn;
    protected $stmt;

    function __construct($db_config)
    {
        $this->db_config = $db_config;
    }
    
    function create_connection()
    {
        //get database variables from db_config class instance
        try
        {
            $hn = $this->db_config->get_hn();
            $db = $this->db_config->get_db();
            $un = $this->db_config->get_un();
            $pw = $this->db_config->get_pw();
            //connect to DB
            $this->conn = new PDO("mysql:host=$hn;dbname=$db",$un,$pw);
            //set ERRMODE attribute to ERRMODE_EXCEPTION to catch any errors and read error message.
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return true;
        }catch(PDOException $e){
            $this->message = "Sorry. We could not connect to the database";
            return false;
        }
        
        
    }
    
    //To be overriden by extended classes
    function query_prepare()
    {
        $query = "";
        $this->stmt = $this->conn->prepare($query);
    }
    
    function prepare_bind_query_params($data_in)
    {
        //Filled in by the extended class.
    }

    function execute()
    {
        try{
            $this->stmt->execute();
            $this->message = "Sucsess! Database query sucsessfully performed.";
        }catch(PDOException $e)
        {
            //Check if 'Duplicate' appears in error message - if so, we can tell user its a duplicate entry!
            if(is_int(strpos($e,"Duplicate"))) $this->message = "Duplicate ISBN number. Record already exists. Please check";
            else
            {
                $this->message = "Sorry, we couldn't complete the database query. Please try again.";
                
            }
        }
        
    }

    function create_content_out()
    {
        //SELECT query classes use to get and store assoc array in $content_out
        $this->stmt->setFetchMode(PDO::FETCH_NUM);
        $this->content_out = $this->stmt->fetchAll();
    }
    
    //close $conn and $stmt after query
    function close_stmt_conn()
    {
        $this->conn = null;
        $this->stmt = null;
    }
    
    //returns content for SEARCH query classes
    function get_content()
    {
        return $this->content_out;
    }

    function get_message()
    {
        return $this->message;
    }
    
}

/**
 * INTERFACES
 * Interface segregation - $prepare_bind_query_params must be declared in 
 * any DatabaseInsertDelete classes
 * 
 */

interface DatabaseSearch
{
    function query_prepare();
    function run_query();
}

interface DatabaseInsertDelete
{
    function query_prepare();
    function prepare_bind_query_params($data_in);
    function run_query($data_in);
}

//=====================================

/**
 * EXTENDED CLASSES
 * Here we have two extended classes below that do two things:
 * 1. They implement the relevant INTERFACE - this ensures a class you create has the correct methods defined.
 * 2. They EXTEND the MainClass.
 * NOTE the differences between SelectAll and InsertBookInto class
 */

class SelectAll extends MainClass implements DatabaseSearch
{
    function query_prepare()
    {
        $query = "SELECT * FROM classics";
        $this->stmt = $this->conn->prepare($query);
    }

    function run_query()
    {
        //This function sets out the order that the methods are called to perform the query.

        if($this->create_connection())
        {
            $this->query_prepare();
            $this->execute();
            $this->create_content_out();
            $this->close_stmt_conn();
            return $this->get_content();
        }
        else
        {
            return $this->get_message();
        }
        
    }
}

class InsertBookInto extends MainClass implements DatabaseInsertDelete
{

    function query_prepare()
    {
        $query = "INSERT INTO classics(author,title,year,isbn)
                 VALUES(?,?,?,?)";
        $this->stmt = $this->conn->prepare($query);
    }

    function prepare_bind_query_params($data_in)
    {
        $a = $data_in[0]; $t = $data_in[1]; $y = $data_in[2]; $i = $data_in[3];
        $this->stmt->bindValue(1, $a, PDO::PARAM_STR);
        $this->stmt->bindValue(2, $t, PDO::PARAM_STR);
        $this->stmt->bindValue(3, $y, PDO::PARAM_INT);
        $this->stmt->bindValue(4, $i, PDO::PARAM_STR);
        
    }

    function run_query($data_in)
    {
        //This function sets out the order that the methods are called to perform the query.
        
        if($this->create_connection())
        {
            $this->query_prepare();
            $this->prepare_bind_query_params($data_in);
            $this->execute();
            $this->close_stmt_conn();
            return $this->get_message();
        }
        else
        {
            return $this->get_message();
        }
    }

}

/**
 * FURTHER EXTENDED CLASSES
 * All further DELETE and INSERT classes can extend InsertBookInto rather than main class.
 * NOTE: No neeed to re-write run_query function in InsertBookInto
 */

class DeleteISBN extends InsertBookInto 
{
    function query_prepare(){
        $query = "DELETE FROM classics WHERE isbn = ?";
        $this->stmt = $this->conn->prepare($query);
    }

    function prepare_bind_query_params($data_in)
    {
        $i = $data_in[0];
        $this->stmt->bindValue(1, $i, PDO::PARAM_STR);
        
    }

}




