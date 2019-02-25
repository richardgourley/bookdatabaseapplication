<?php
class Book extends Controller{
	protected function Index(){
		return;
	}
    
    /**
    *
    * Creates BookModel instance.
    * Calls Add() function and passes results as parameter to be used in our view.
    *
    */
	protected function Add(){
		$viewmodel = new BookModel();
		$this->return_view($viewmodel->Add(), true); 
	}

    //as above but passes results of Edit() function to be used in our view.
	protected function Edit(){
		$viewmodel = new BookModel();
		$this->return_view($viewmodel->Edit(), true);
	}
}