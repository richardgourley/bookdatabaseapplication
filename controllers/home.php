<?php
class Home extends Controller{
	
	/**
    *
    * execute_action() in Controller base class calls all functions here.
    *
    */

    /**
    *
    * Creates HomeModel instance
    * Calls Index() function of HomeModel and passes results as parameter to be used in our view.
    * Index() in HomeModel returns results of 'SELECT * FROM books' query returning all books to the VIEW. 
    * See views/home/index.php
    *
    */
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->return_view($viewmodel->Index(), true); 
	}

	
}

