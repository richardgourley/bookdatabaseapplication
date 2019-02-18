<?php
class Bootstrap{
  private $request;
  private $controller;
  private $action;

  public function __construct($request){
     $this->request = $request;

     //If request is blank ie. site home page, $controller = 'home', $action = 'index'
     if($this->request['controller'] == ""){
        $this->controller = 'home';
     }else{
        $this->controller = $this->request['controller'];
     }

     //If request['action'] is blank, set to index. Eg 'bookdatabaseapplication/books' = $controller = 'books', $action = 'index'
     if($this->request['action'] == ""){
        $this->action = 'index';
     }else{
        $this->action = $request['action'];
     }

  }
  
  /*
  * @ return = returns either a new instance of a controller based on controller name and action OR...
  * ... prints an error message and returns if controller OR action does not exist.
  *
  */
  public function create_controller(){
     if(class_exists($this->controller)){ 
        //Next 2 lines - Gets classes $this->controller extends from (array). Then we check 'Controller' base class exists and $this->controller extends from it.
        $parents = class_parents($this->controller); 
        if(in_array('Controller', $parents)){ 
           if(method_exists($this->controller, $this->action)){ 
              return new $this->controlller($this->action, $this->request); 
           }else{
              echo "Method " . $this->action . " doesn't exist in class " . $this->controller . "."; 
           }
        }else{
           echo "Class named " . $this->controller . " found but base controller class not found."; 
           return;
        }
     }else{
        echo "Class named " . $this->controller . " not found."; 
        return;
     }
  }

}