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
   
   //Returns desired html view. $viewmodel comes from model. $fullview is a bool that directs to main page view (full) or view specific to this model.
   protected function return_view($viewmodel, $fullview){
      //Create a variable that contains the link to the view created for this action.
      $view = 'views/' . get_class($this) . '/' . $this->action . '.php';
      //Full view logic.
      if($fullview){
         return ('views/main.php');
      }else{
         return $view;
      }
   }
}