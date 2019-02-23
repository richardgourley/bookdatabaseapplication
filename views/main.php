<!DOCTYPE html>
<html>
<head>
	<title>Book database application</title>
</head>
<body>
    <h1>Hello welcome to your book database application.</h1>
    <ul>
    	<li><a href="<?php echo ROOT_URL; ?>">Home</a></li>
    	<li><a href="<?php echo ROOT_URL . "/book/add"; ?>">Add a book</a></li>
    	<li><a href="<?php echo ROOT_URL . "/book/edit"; ?>">Edit a book</a></li>
    </ul>
    <?php require_once($view); ?>
</body>
</html>

