# MVC APPLICATION EXAMPLE - BOOK DATABASE

NOTE: This repository is a work in progress.  The original code in the folder oldVersion can be ignored, it's only a reference!

This app is a reference for anyone looking to create an MVC application.  It's written in PHP with HTML and CSS.

OVERVIEW:
The app is a simple CRUD (create, read, update, delete) application.
This is an example of how to build a PHP MVC application from scratch without frameworks.

## If you are learning and using this as a reference, I recommend building the application step by step in the following order.

1. Start with the .HTACCESS file. 
See the line that starts with index.php?controller=..... This file makes sure that all requests (in the browser) direct to our index.php file. 
This file sets request from the browser to have 1 or 2 parameters eg localhost/books or localhost/books/add.
2. Next, copy the CONFIG.php file that sets the database and app root constants.
3. Next, copy the INDEX.php file but delete the required files.  Add files to INDEX.php as you create them.
4. Next, copy the BOOTSTRAP.php file in the classes folder.
Enter different requests in the browser and follow what is happening.
4. Create the base CONTROLLER.php class.
5. MORE TO FOLLOW.



SKILLS COVERED
* MVC architecture
* Abstract classes
* Inheritance
* PDO database connection
* Session handling in PHP