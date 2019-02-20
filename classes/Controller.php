<?php
//abstract class. (Base controller class)  All controller instances extend from this.
abstract class Controller{
   protected $action;
   protected $request;

   public function __construct($action, $request){
      $this->action = $action;
      $this->request = $request;
   }

   //Executes the method named $this->action in our extended Controller classes.
   public function execute_action(){
      return $this->{$this->action}();
   }
   
   //Returns desired html view. $viewmodel comes from model. $fullview is a bool
   protected function return_view($viewmodel, $fullview){
      
      $view = 'views/' . get_class($this) . '/' . $this->action . '.php'; //Var with link to the VIEW for this ACTION
      if($fullview){
         return ('views/main.php'); //Alternative main.php used if $fullview = true
      }else{
         return $view;
      }
   }
}