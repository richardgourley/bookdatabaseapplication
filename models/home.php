<?php
class HomeModel extends Model{
  /**
    *
    * Check delete form (delete button) has been filled in (isset($post['isbn']))
    * Sanitize $_POST['isbn'] and assign to $isbn.
    * Pass in $query and $params array to query_get_message() (see Model base class). 
    * echo a message if $message is either true or false.
    *
    * @ return - array of results from 'SELECT * FROM classics' returned.
    *
    */
  public function Index(){
    if(isset($_POST['isbn'])){
      $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_STRING);
      $query = "DELETE FROM classics WHERE isbn = ?";
      $params = array($isbn);
      $message = $this->query_get_message($query, $params); 
      if($message){
         echo "You have deleted a book with ISBN number " . $isbn;
      }else{
         echo "Something went wrong, your book has not been deleted.";
      }
    }

	  $query = "SELECT * FROM classics";
    //no query params for this search
	  $results = $this->query_get_results($query, array()); //see model base class
    return $results;
	}


}

