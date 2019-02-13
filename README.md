# MVC APPLICATION EXAMPLE - BOOK DATABASE

NOTE: This repository is a work in progress.  The original code in the folder oldVersion can be ignored, it's only a reference!

This app is a reference for anyone looking to create an MVC application.  It's written in PHP with HTML and CSS.

OVERVIEW:
The app is a simple CRUD (create, read, update, delete) application.
This is an example of how to build a PHP MVC application from scratch without frameworks.

## If you are learning and using this as a reference, I recommend building the application step by step in the following order.

1. Start with the .HTACCESS file. 
See the line that starts with index.php?controller=..... This file makes sure that all requests (in the browser) direct to our index.php file. 
Every browser request can have one or two parameters eg localhost/books or localhost/books/add.
2. Next, copy the INDEX.php and CONFIG files.
3. Next, copy and play around with BOOTSTRAP file in the classes folder.  From index.php, the bootstrap class creates the necessary controller.
4. Then create the CONTROLLER and MODEL files in the classes folder.  They contain abstract classes from where our models and controllers inherit from.
5. MORE TO FOLLOW.



SKILLS COVERED
* MVC architecture
* Abstract classes
* Inheritance
* PDO database connection
* Session handling in PHP