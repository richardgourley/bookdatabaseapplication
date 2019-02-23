<?php
class BookModel extends Model{
   public function Add(){
      if(isset($_POST['title'])){
         if($this->validate($_POST['title'], 'string') &&
            $this->validate($_POST['author'], 'string') &&
            $this->validate($_POST['year'], 'integer') &&
            $this->validate($_POST['isbn'], 'integer')){
            $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
            $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
            $year = filter_var($_POST['year'], FILTER_SANITIZE_STRING);
            $isbn = filter_var($_POST['isbn'], FILTER_SANITIZE_STRING);
            $query = "INSERT INTO classics (title, author, year, isbn) VALUES(?,?,?,?)";
            $params = array($title, $author, $year, $isbn);
            $message = $this->query_get_message($query, $params);
            if($message) return "You have successfully added a book.";
            else return "Sorry, there was a problem, please try again";
         }else{
            return "Please check your inputs. There was an error";
         }
         
      }
   }

   public function Edit(){
      if(isset($_POST['current_isbn'])){
      $title = $this->validate_sanitize($_POST['title'], 'string');
      $author = $this->validate_sanitize($_POST['author'], 'string');
      $year = $this->validate_sanitize($_POST['year'], 'integer');
      $isbn = $this->validate_sanitize($_POST['isbn'], 'integer');
      $current_isbn = $this->validate_sanitize($_POST['current_isbn']);
      $query = "UPDATE classics SET title = ?, author = ?, year = ?, isbn = ? WHERE isbn = ?";
      $params = array($title, $author, $year, $isbn, $current_isbn);
      $message = $this->query_get_message($query, $params); //see model base class
      //dont return anything here.
      }

      $query = "SELECT * FROM classics";
      //no query params for this search
      $results = $this->query_get_results($query, array()); //see model base class
      return $results;
   }


}