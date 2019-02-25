<?php
class Db{
	/**
	*
	* This class is used by classes/Model.php to open and close database connections.
	*
	*/
    public function open_db_connection(){
        $lh = 'localhost'; $db = 'publications'; $un = 'root'; $pw = '';
        return new PDO("mysql:host=" . $lh . ";dbname=" . $db,$un,$pw);
    }

    public function close_db_connection($conn){
        $conn = null;
    }
}