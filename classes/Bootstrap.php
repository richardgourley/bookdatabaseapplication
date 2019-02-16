<?php
class Bootstrap{
  private $request;
  private $controller;
  private $action;

  public function __construct($request){
     //$request parameter is an associative array based on $_GET taken from browser input. 'application/controller/action/id'
     $this->request = $request;
     //test if controller is blank, if so set controller property to 'home'.
     if($this->request['controller'] == ""){
        $this->controller = 'home';
     }else{
        $this->controller = $this->request['controller'];
     }
  }
  
  public function test(){
    print_r($this->request);
    echo "<br>" . $this->controller . "<br>" . $this->action;
  }

}