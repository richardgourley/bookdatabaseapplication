<?php
class BookModel extends Model{
   /**
    *
    * $post - we sanitize all strings in the $_POST array (form input) and assign to $post
    * we check if $post['title'] is set, eg. form has been filled in.
    * we validate the year and isbn numbers (see Model base class)
    * pass the $post array members to $params
    * pass the $query and $params to query_get_message() to perform query.
    * @ return - a success or failure message depending if $message is true or false
    *
    */
   public function Add(){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if(isset($post['title'])){
         if($this->validate_year($post['year']) && $this->validate_int($post['isbn'])){ 
            $query = "INSERT INTO classics (title, author, year, isbn) VALUES(?,?,?,?)";
            $params = array($post['title'], $post['author'], $post['year'], $post['isbn']);
            $message = $this->query_get_message($query, $params); 
            if($message) return "You have successfully added a book.";
            else return "Sorry, there was a problem, please try again";
         }else{
            return "Sorry, please make sure your year is valid and that your isbn is up to a 13 digit number.";
         }
      }else{
         return;
      }
   }
   
   /**
    *
    * Sanitize $_POST array, assign to $post.
    * Check edit form has been filled in (isset($post['current_isbn']))
    * Assign $post array members to $params.
    * Pass in $query and $params to query_get_message() (see Model base class). 
    * echo a message if $message is either true or false.
    *
    * @ return - array of results from 'SELECT * FROM classics' returned.
    *
    */
   public function Edit(){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if(isset($post['current_isbn'])){
         if($this->validate_year($post['year']) && $this->validate_int($post['isbn']) && $this->validate_int($post['current_isbn'])){ 
            $query = "UPDATE classics SET title = ?, author = ?, year = ?, isbn = ? WHERE isbn = ?";
            $params = array($post['title'], $post['author'], $post['year'], $post['isbn'], $post['current_isbn']);
            $message = $this->query_get_message($query, $params); 
            if($message) echo "You have successfully updated a book.";
         }else{
            echo "Sorry, please make sure your year is valid and that your isbn is up to a 13 digit number.";
         }
      }

      $query = "SELECT * FROM classics";
      //no query params for this search
      $results = $this->query_get_results($query, array()); //see model base class
      return $results;
   }


}