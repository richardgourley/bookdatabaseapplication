<?php
require_once 'model.php';
$message = "";

$select_all = new SelectAll(new DatabaseConfiguration($hn,$db,$un,$pw));
//ALWAYS return $output as it is the array to display ALL books in 'view.php'
$output = $select_all->run_query();

/**
 * CHECK THE $_POST ARRAY to decide which class to instantiate and whether to change $message variable to send to view.php
 * NOTE:
 * Only INPUT VALIDATION performed here.
 * SANITATION OF STRINGS IS PERFORMED within the classes in our model.php file.
 */

if(isset($_POST['delete']) && isset($_POST['isbn']))
{
    $delete_isbn = new DeleteISBN(new DatabaseConfiguration($hn,$db,$un,$pw));
    $isbn = $_POST['isbn'];
    $message = $delete_isbn->run_query(array(array($isbn,'string')));
    //Run query again to SELECT ALL and display books in $output variable.
    $output = $select_all->run_query();
}

if(isset($_POST['author']) && isset($_POST['title']) && isset($_POST['year']) && isset($_POST['isbn']))
{
    $a = $_POST['author'];
    $t = $_POST['title'];
    $y = $_POST['year'];
    $i = $_POST['isbn'];
    
    //Check input is more than 0 in length
    if(check_input_length($a) && check_input_length($t) && check_input_length($y) && check_input_length($i))
    {
        //Check year and isbn are numeric
        if(!is_numeric($y) || !is_numeric($i))
        {
            $message = "Either the year input or isbn input fields were not a number. Please try again";
        }
        else
        {
            //If conditions are met create instance of class and run query, passing in input data as param
            //REMEMBER data sanitation performed as a function inside our class.

            $insert_book_into = new InsertBookInto(new DatabaseConfiguration($hn,$db,$un,$pw));
            //Assign message to the message property of our class stating if successful DB query or not.
            //Pass in multi dimensional array of input and expected type:
            $message = $insert_book_into->run_query(
                array(
                    array($a,'string'),
                    array($t,'string'),
                    array($y,'integer'),
                    array($i,'string')
                )
            );

            //Run query again to SELECT ALL and display books in $output variable.
            $output = $select_all->run_query();
        }
    }
    else
    {
        $message = "One of your input strings was blank. Please try again";
    }
    
}

//Variables $output and $message are now passed into our view.php page to display!
require_once 'view.php';

function check_input_length($str)
{
    return strlen($str)>0;
}