<?php
class Bootstrap{
  /**
  *
  * This class handles the browser request and creates the controller
  *
  */
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
      if(!class_exists($this->controller)){
          echo "Class named " . $this->controller . " not found."; 
          return;
      }

      $parents = class_parents($this->controller);
      if(!in_array('Controller', $parents)){
          echo "Class named " . $this->controller . " found but base controller class not found."; 
          return; 
      }

      if(!method_exists($this->controller, $this->action)){
          echo "Method " . $this->action . " doesn't exist in class " . $this->controller . "."; 
          return;
      }

      return new $this->controller($this->action, $this->request); 
  }

}