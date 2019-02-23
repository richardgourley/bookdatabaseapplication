<?php
class HomeModel extends Model{
  public function Index(){
    if(isset($_POST['isbn'])){
      $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_STRING);
      $query = "DELETE FROM classics WHERE isbn = ?";
      $params = array($isbn);
      $message = $this->query_get_message($query, $params); //see model base class
      //dont return anything here.
    }

	  $query = "SELECT * FROM classics";
    //no query params for this search
	  $results = $this->query_get_results($query, array()); //see model base class
    return $results;
	}


}

