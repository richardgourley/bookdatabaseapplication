<?php
require_once 'model.php';

$a = $_POST['author'];
$t = $_POST['title'];
$y = $_POST['year'];
$i = $_POST['isbn'];

echo <<<END
<!DOCTYPE html>
<html>
    <head>
        <title>Book database application</title>
    </head>
    <body>
        
        <h2>Add a book to the database</h3>
        <form action="controller.php" method="post">
        Author: <input type="text" name="author" value="$a">
        Title: <input type="text" name="title" value="$t">
        Year: <input type="text" name="year" value="$y">
        ISBN: <input type="text" name="isbn" value="$i">
        <input type="submit" value="SUBMIT BOOK ENTRY">
        </form>
END;

$db_updated_message = "<h3 style='color:red;'>" . $message . "</h3>";
if(strlen($message) > 0) echo $db_updated_message;

echo <<<END
        <h2>Delete a book</h2>
        <p>Click the DELETE button below to delete an entry</p>

END;
        
foreach($books_array as $arr)
{
    echo "Author: $arr[0]. Title: $arr[1].<br> Year: $arr[2]. ISBN: $arr[3]<br>";

    echo <<<_END
<form action="controller.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="isbn" value="$arr[3]">
<input type="submit" value="DELETE RECORD">
</form>
_END;
}

echo <<<_END
    </body>
</html>
_END;

