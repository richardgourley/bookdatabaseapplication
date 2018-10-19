<?php
require_once 'model.php';

//2 variables to populate and send to view depending on POST array
$message = "";
$books_array;

//Instantiate SelectAll instance because we need to display all books in any condiitonal situation below
$select_all = new SelectAll(new DatabaseConfiguration($hn,$db,$un,$pw));

//Check which keys are set in post array
$result = check_post_array($_POST);

if($result == "delete")
{
    $i = sanitize_string($_POST['isbn']);
    $fail = "";
    //concatenate either blank string or message to $fail
    $fail .= validate_int($i, "isbn");
    //if $fail isnt blank, assign return concatenated message/s to $message
    if(!($fail == ""))
    { 
        $message = $fail;
        //run query on SelectAll instance and set to $books_array
        $books_array = $select_all->run_query();

        //return $message and $books_array to viewBlank.php - add books fields are blank
        require_once 'viewBlank.php';
    }
    else
    {
        //instantiate DeleteISBN class
        $delete_isbn = new DeleteISBN(new DatabaseConfiguration($hn,$db,$un,$pw));
        //run_query returns success or fail message
        $message = $delete_isbn->run_query(array($i));
        //run UPDATED SelectAll class query returning new list of books, set to $books_array.
        $books_array = $select_all->run_query();

        //return $message and $books_array to viewBlank.php - add books fields are blank
        require_once 'viewBlank.php';
    }
}
else if($result == "insert")
{
    $a = sanitize_string($_POST['author']);
    $t = sanitize_string($_POST['title']);
    $y = sanitize_string($_POST['year']);
    $i = sanitize_string($_POST['isbn']); 

    $fail = "";
    //concatenate message or "" to $fail var
    $fail .= validate_string($a, "author");
    $fail .= validate_string($t, "title");
    $fail .= validate_int($y, "year");
    $fail .= validate_int($i, "isbn");

    //if $fail isnt blank, it means there is a problem.  Assign $fail to $messages
    if(!($fail == ""))
    {
        $message = $fail; 
        //run query on SelectAll instance and set to $books_array
        $books_array = $select_all->run_query();

        //return $message and $books_array to viewFilled.php - fields filled = user can modify input error, not type all again.
        require_once 'viewFilled.php';
    } 
    else
    {
        $y = (int)$y;
        //instantiate InsertBookInto class
        $insert_book_into = new InsertBookInto(new DatabaseConfiguration($hn,$db,$un,$pw));
        //run_query returns success or fail message
        $message = $insert_book_into->run_query(array($a,$t,$y,$i));
        //run UPDATED SelectAll class query returning new list of books, set to $books_array.
        $books_array = $select_all->run_query();

        //return $message and $books_array to viewBlank.php - add books fields are blank
        require_once 'viewBlank.php';

    }
    
}
else
{
    $message = "";
    $books_array = $select_all->run_query();
    //return $message and $books_array to viewBlank.php - add books fields are blank
    require_once 'viewBlank.php';

}

/**
 * FUNCTIONS
 */

function validate_string($str, $field_name)
{
    return ($str == "") ? "No $field_name was entered<br>" : "";
}

function validate_int($str, $field_name)
{
    if($str == ""){ return "No $field_name was entered<br>"; }
    else if(preg_match("/[^0-9]/", $str)){ return "$field_name can only contain numbers 0-9<br>";}
    else{ return ""; }
}

function check_post_array($arr)
{
    if(isset($arr['delete']) && isset($arr['isbn']))
    {
        return "delete";
    }
    else if(isset($arr['author']) && isset($arr['title']) 
    && isset($arr['year']) && isset($arr['isbn']))
    {
        return "insert";
    }
    else
    {
        return "";
    }
}

function sanitize_string($str)
{
    $str = filter_var($str,FILTER_SANITIZE_STRING);
    $str = strip_tags($str);
    $str = htmlspecialchars($str);
    return $str;
}

function check_string($str,$expected){
    $new_str;
    if(gettype($str) == $expected){
        $new_str = $str;
        return $new_str;
    }else
    {
        cast_string($str, $expected);
    }
}



