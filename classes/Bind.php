<?php
class Bind{
    /*public function bind_params(){
        if(!$this->params == null){
            for($i=0; $i<count($this->params); $i++){
                $this->bind(($i+1), $this->params[$i]);
            }
        }
    }

    public function bind($num, $param){
        if(is_null($param)){ $this->stmt->bindParam($num, $param, PDO::PARAM_NULL); }
        else if(is_int($param)){ $this->stmt->bindParam($num, $param, PDO::PARAM_INT); }
        else if(is_bool($param)){ $this->stmt->bindParam($num, $param, PDO::PARAM_BOOL); }
        else{ $this->stmt->bindParam($num, $param, PDO::PARAM_STR); }
        
    }*/

    public function bind_execute($stmt, $params){
        if(!$params == null){
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