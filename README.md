# PHP Book database application
This is an easy to understand single page application to help any students looking to understand some design patterns. The app demonstrates how to think about using these skills

Basically, it's a single page app where you can add book details to your database.  You can also see all of the books on the same page, and delete any book, all from the same page.

SKILLS COVERED
- MVC - separation of concerns, specifically MODELS (CLASSES) and VIEWS
- Using PDO classes to connect to a MySQL database.
- Displaying database query results, inserting and deleting database items using PDO in PHP.

DESIGN SKILLS (SEE MODEL.PHP)
- Template design pattern used
- Abstract Classes
Our main class is abstract.  Every class we use in the app extends it.  
- Dependency Injection
We insert our database configuration details into the main class. This allows changes to our DB config in the future without affecting the main class.
- Single Responsibility
The classes all have one responsibility in the app. This is the 'S' in solid.
- Interface segregation
- Inheritance - extended classes
- DRY - not repeating code.

NOTES:
MVC is used but our 'Controller' is not a controller in the true sense of routing the user to different views and pages as in Symfony, Zend or ASP.NET.
This app is more to show how you can separate your MODEL (classes) and your VIEWS
Because its a sinle page app, the controller handles form input results before returning data to the view of our single VIEW.PHP page.
The 'controller' just asesses whether we have to instantiate an insert or delete class from our model.
The 'controller' alters the message outputs and passes in the SELECT all query results.

NOTE: A single page app which interracts with a database would probably be better written using AJAX. As mentioned before, this app is really just to consolidate some design patterns and SOLID and MVC concepts I have been looking at.  

I hope this helps a budding developer who is learning how to code with OOP!



