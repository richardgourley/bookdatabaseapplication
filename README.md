# MVC APPLICATION EXAMPLE - BOOK DATABASE

NOTE: This repository is a work in progress. 
This app is a reference for anyone looking to create an MVC application.  It's written in PHP with HTML and CSS.

OVERVIEW:
The app is a simple CRUD (create, read, update, delete) application.
This is an example of how to build a PHP MVC application from scratch without frameworks.

## If you are learning and using this as a reference, I recommend building the application step by step in the following order.

1. Start with the .HTACCESS file. 
See the line that starts with index.php?controller=..... This file makes sure that all requests (in the browser) direct to our index.php file. 
This file sets request from the browser to have 1 or 2 parameters eg localhost/books or localhost/books/add.
2. Next, copy the CONFIG.php file that sets the database and app root constants.
3. Next, copy the INDEX.php file but delete the required files for now.  Re-add these required files to INDEX.php as you create and test them below.
4. Next, copy the BOOTSTRAP.php file in the classes folder.
Enter different requests in the browser and follow what is happening.
4. Create the base CONTROLLER.php class.
5. Create the home.php file in the folder controllers.
6. Create the Index() function in the Home class in controllers/home.php, adding a test echo command.

With the above steps, you should be able to see how the app operates inside the INDEX.php file by creating an instance of the BOOTSTRAP class with the BROWSER request as a parameter. (CONTROLLER, ACTION strings)
Then we call the function CREATE_CONTROLLER inside the bootstrap class which uses the CONTROLLER to look for the corresponding CONTROLLER CLASS from our required files in INDEX.php.
Then the CONTROLLER we have created executes its ACTION, (ACTION string from the original browser request) all coming from the BROWSER request.

Next, start adding the Model classes and see how they are created inside of the controller classes.

SKILLS COVERED
* MVC architecture
* Abstract classes
* Inheritance
* PDO database connection
* Session handling in PHP