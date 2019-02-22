<?php
class Bind{
   
    public function bind_execute($stmt, $params){
        if(!$params == null || !count($params) == 0){
            for($i=0; $i<count($params); $i++){
                if(is_null($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_NULL); }
                else if(is_int($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_INT); }
                else if(is_bool($params[$i])){ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_BOOL); }
                else{ $stmt->bindParam($i+1, $params[$i], PDO::PARAM_STR); }
            }
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}