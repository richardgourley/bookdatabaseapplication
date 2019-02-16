<?php
class Bootstrap{
  private $request;

  public function __construct($request){
     $this->request = $request;   
  }
  
  public function test(){
    if($this->request['controller'] == '') echo "Controller is empty";
    echo $this->request['controller'] . "<br>";
    echo $this->request['action'] . "<br>";
    if($this->request['id'] == '') echo "Id is empty";
    echo $this->request['id'] . "<br>";
  }

}