<?php
class Db{
    public function open_db_connection(){
        $lh = 'localhost'; $db = 'publications'; $un = 'root'; $pw = '';
        return new PDO("mysql:host=" . $lh . ";dbname=" . $db,$un,$pw);
    }
}