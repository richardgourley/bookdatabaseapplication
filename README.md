# MVC APPLICATION EXAMPLE - BOOK DATABASE

NOTE: This repository is a work in progress. 
This app is a reference for anyone looking to create an MVC application.  It's written in PHP with HTML and CSS.

OVERVIEW:
The app is a simple CRUD (create, read, update, delete) application.
This is an example of how to build a PHP MVC application from scratch without frameworks.

## If you are learning about MVC and PHP, I recommend building the application up step by step in the following order.

1. Start with the .HTACCESS file. (You need to right click and select 'Run as Administrator' when creating it.)
See the line that starts with index.php?controller=..... This file makes sure that all requests (in the browser) direct to our index.php file. 
This file handles request from the browser that can have 1 or 2 parameters eg localhost/books or localhost/books/add.
2. Next, copy the CONFIG.php file that sets the database and app root constants.
3. Next, copy the INDEX.php file but delete the required files for now.  Re-add these required files to INDEX.php as you build up the application.
4. Next, copy the BOOTSTRAP.php file in the classes folder.
5. Copy the BIND, DB, CONTROLLER and MODEL base classes into the classes folder.
6. Great, now you can start adding the controllers/home, models/home and views/home/index files. 

Play around with different requests to see the flow of the application.  
Add in your own MODELS, VIEWS and CONTROLLERS to practice and follow how the app works. 
You can adapt this basic MVC model to any web app you wish to build.

SKILLS COVERED
* MVC architecture
* Abstract classes
* Inheritance
* PDO database connection
* Session handling (can be integrated into the app by creating a users table in the db.)