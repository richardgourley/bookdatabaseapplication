<?php

//Our LOGIN.PHP file includes the database login details.
//Modify this to your database hostname, database name, username and password for your WAMP or XAMP server.

require_once 'login.php';

/*
* The Database Configuration class is kept separate because we might want to change it later.
* We are applying the 'S' in SOLID here. One class has one responsibility.
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
 * PDO
 * We use the PDO class to query the database.
 * PDO properties and methods are found in our main class.
 * Methods used with $conn or $stmt or with the word PDO are all built in PDO methods or classes.
 */


/**
 * MAIN CLASS
 * Here we apply DEPENDENCY INJECTION.  The MainClass depends on the database configuration class.
 * We 'inject' an instance ($db_config) of our database configuration class (in our CONSTRUCT method) and store it in a property $db_config.
 * The properties $conn and $stmt will work together and store details for implementing our query with the database.
 * If we perform a SELECT query with data to show, we store it in $content_out.
 * If we perform an INSERT or DELETE query we store a message in the $message property.
 * The METHODS are a broken down version of a PDO class instance that interracts with the database.
 * The METHODS can be overriden as required by classes that EXTEND this MainClass.
 * Specifically the methods QUERY_PREPARE and PREPARE_BIND_QUERY_PARAMS will be altered by EXTENDED CLASSES as required.
*/

/** 
 * The TEMPLATE DESIGN PATTERN is used.
 * The idea is that we use INHERITANCE and create EXTENDED classes that use some parts of the main class but 
 * importantly, the extended classes 'fill in the blanks' or change the METHODS for a desired result.
 * The MainClass is our tempplate - it is never instantiated but we extend it and modify it through extension!
 */


abstract class MainClass
{
    protected $db_config;
    protected $content_out;
    protected $message;
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
    
    function query_prepare()
    {
        $query = "";
        $this->stmt = $this->conn->prepare($query);
    }
    
    function prepare_bind_query_pararms($data_in)
    {
        //Filled in by the extended class.
    }

    function execute()
    {
        try{
            $this->stmt->execute();
            $this->message = "Succsess! Database query sucsessfully performed.";
        }catch(PDOException $e){
            
            //We check to see if the exception error $e contains the word "Duplicate".
            //If yes, we set $content_out to a specific 'duplicate entry' message.
            //If no, we set $content_out to a generic message:

            if(is_int(strpos($e,"Duplicate"))) $this->message = "Duplicate ISBN number. Record already exists. Please check";
            else $this->message = "Sorry, we couldn't complete the database query. Please try again.";
        }
        
    }

    function create_content_out()
    {
        //Used by SELECT query classes to get the results and store them in $content_out as an associative array.
        $this->stmt->setFetchMode(PDO::FETCH_NUM);
        $this->content_out = $this->stmt->fetchAll();
        
    }
    
    function close_stmt_conn()
    {
        $this->conn = null;
        $this->stmt = null;
    }

    function get_content()
    {
        return $this->content_out;
    }

    function get_message()
    {
        return $this->message;
    }

    /**
     * SANITATION AND TYPE CHECKING
     * 
     */

    function sanitize_data_in_array($data_in)
    {
        $sanitized_arr;
        
        //$data_in has an array for each piece of data.
        //Element '0' is the input to go into our query.
        //Element '1' is the expected type. 

        for($j=0; $j<count($data_in); ++$j){
            //$j is for each array, containing element '0' (input) and element '1' = expected type - string, integer, bool etc.
            //Assign $new_str to sanitized element '0'
            $new_str = $this->sanitize_string($data_in[$j][0]);

            //Check that element '0' matches type of element '1'. If so, pass into $sanitized_arr.
            //If not, assign $new_str to the correct type, then pass into $sanitized_arr.
            
            if(gettype($data_in[$j][0])==$data_in[$j][1]){$sanitized_arr[] = $new_str;}
            else{$new_str = $this->check_cast_string($new_str,$data_in[$j][1]); $sanitized_arr[] = $new_str;}
        }
        
        return $sanitized_arr;
    }

    function sanitize_string($str)
    {
        $str = filter_var($str,FILTER_SANITIZE_STRING);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    function check_cast_string($str,$expected){
        $new_str;
        if(gettype($str) == $expected){
            $new_str = $str;
            return $new_str;
        }else{
            if($expected=='integer') $new_str = (int)$str; return $new_str;
            if($expected=='bool') $new_str = (bool)$str; return $new_str;
            if($expected=='float') $new_str = (float)$str; return $new_str;
            if($expected=='double') $new_str = (double)$str; return $new_str;
            if($expected=='object') $new_str = (object)$str; return $new_str;
            if($expected=='array') $new_str = (array)$str; return $new_str;
        }
    }

    
    
}

//THESE INTERFACES WILL MAKE SURE THAT THE VARIOUS DB INTERRACTION CLASSES HAVE SPECIFIC METHODS INCLUDED
//INTERFACE SEGREGATION PRINCIPLE STATES THAT YOU SHOULDN'T BIND A CLASS TO AN INTERFACE UNLESS IT NEEDS ALL THE METHODS
//WE HAVE A SEARCH INTERFACE AND A GENERAL DATABASE INTERRACTION INTERFACE

/**
 * INTERFACES
 * These interfaces will make sure that the various extended classes have the specific methods included.
 * INTERFACE SEGREGATION PRINCIPLE states that you shouldn't bind a class to an interface unless it specifically
 * needs to have those methods.
 * 
 */

interface DatabaseInterractionSearch
{
    function query_prepare();
    function run_query();
}

interface DatabaseInterraction
{
    function query_prepare();
    function prepare_bind_query_pararms($data_in);
    function run_query($data_in);
}

//=====================================

/**
 * EXTENDED CLASSES
 * Here we have two extended classes below that do two things:
 * 1. They implement the relevant INTERFACE - this ensures a class you create has the correct methods defined.
 * 2. They EXTEND the MainClass.
 * The example classes below have both similar and different requirements.
 * The SelectAll class doesn't insert user input into the query so doesn't extend or even call the PREPARE BIND QUERY PARAMS method.
 * The InsertBookInto class uses user inputs so we have to bind the parameters and sanitize strings carefully.
 */

class SelectAll extends MainClass implements DatabaseInterractionSearch
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

class InsertBookInto extends MainClass implements DatabaseInterraction
{

    function query_prepare(){
        $query = "INSERT INTO classics(author,title,year,isbn)
                 VALUES(?,?,?,?)";
        $this->stmt = $this->conn->prepare($query);
    }

    function prepare_bind_query_pararms($data_in){
        
        //sanitize and type check each element in array
        $sanitized_data = $this->sanitize_data_in_array($data_in);

        $this->stmt->bindValue(1,$sanitized_data[0],PDO::PARAM_STR);
        $this->stmt->bindValue(2,$sanitized_data[1],PDO::PARAM_STR);
        $this->stmt->bindValue(3,$sanitized_data[2],PDO::PARAM_INT);
        $this->stmt->bindValue(4,$sanitized_data[3], PDO::PARAM_STR);
    }

    function run_query($data_in)
    {
        //This function sets out the order that the methods are called to perform the query.
        
        if($this->create_connection())
        {
            $this->query_prepare();
            $this->prepare_bind_query_pararms($data_in);
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
 * Further classes which require ANY input going into the query will be similar to our INSERTBOOKINTO class.
 * Now we can EXTEND our INSERTBOOKINTO class.
 * We won't have to write run_query for any similar classes that add data to our queries.
 */

class DeleteISBN extends InsertBookInto
{
    function query_prepare(){
        $query = "DELETE FROM classics WHERE isbn = ?";
        $this->stmt = $this->conn->prepare($query);
    }

    function prepare_bind_query_pararms($data_in){
        
        //sanitize and type check each element in array
        $sanitized_data = $this->sanitize_data_in_array($data_in);

        $this->stmt->bindValue(1,$sanitized_data[0],PDO::PARAM_STR);
    }
}




