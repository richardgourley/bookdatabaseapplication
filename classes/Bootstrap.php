<?php
class Bootstrap{
  private $request;
  private $controller;
  private $action;

  public function __construct($request){
     $this->request = $request;

     if($this->request['controller'] == ""){
        $this->controller = 'home';
     }else{
        $this->controller = $this->request['controller'];
     }

     if($this->request['action'] == ""){
        $this->action = 'index';
     }else{
        $this->action = $request['action'];
     }
     

  }
  
  /*
  * 
  * @ return = returns either a new instance of a controller based on controller name and action OR...
  * ... prints an error message and returns if controller OR action does not exist.
  */
  public function create_controller(){
     if(class_exists($this->controller)){ 
        //Get array of classes that class named $this->controller extends from.
        $parents = class_parents($this->controller); 
        //Check 'Controller' base class exists and is extended from by class named $this->controller.
        if(in_array('Controller', $parents)){ 
           if(method_exists($this->controller, $this->action)){ 
              return new $this->controller($this->action, $this->request); 
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