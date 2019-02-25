<?php
class Bind{
   
    /**
    *
    * Each param in $params array - looped and loop number and type used to bind to $stmt.
    * @ return: $stmt returned with $params bound to it.
    */

    public function bind_params($stmt, $params){
        if(!$params == null || !count($params) == 0){
            for($i=0; $i<count($params); $i++){
                if(is_null($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_NULL); }
                else if(is_int($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_INT); }
                else if(is_bool($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_BOOL); }
                else{ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_STR); }
            }
        }

        return $stmt;
    }

}