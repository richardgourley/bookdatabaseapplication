<?php
class BookModel extends Model{
   public function Add(){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if(isset($post['title'])){
         if($this->validate_year($post['year']) && $this->validate_int($post['isbn'])){ //see validate_year() and validate_int() in classes/Model.php
            $query = "INSERT INTO classics (title, author, year, isbn) VALUES(?,?,?,?)";
            $params = array($post['title'], $post['author'], $post['year'], $post['isbn']);
            $message = $this->query_get_message($query, $params); //see query_get_message() in classes/Model.php
            if($message) return "You have successfully added a book.";
            else return "Sorry, there was a problem, please try again";
         }else{
            return "Sorry, please make sure your year is valid and that your isbn is up to a 13 digit number.";
         }
      }else{
         return;
      }
   }

   public function Edit(){
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if(isset($post['current_isbn'])){
         if($this->validate_year($post['year']) && $this->validate_int($post['isbn']) && $this->validate_int($post['current_isbn'])){ //see validate_year() and validate_int() in classes/Model.php
            $query = "UPDATE classics SET title = ?, author = ?, year = ?, isbn = ? WHERE isbn = ?";
            $params = array($post['title'], $post['author'], $post['year'], $post['isbn'], $post['current_isbn']);
            $message = $this->query_get_message($query, $params); //see query_get_message() in classes/Model.php
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