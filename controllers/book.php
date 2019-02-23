<?php
class Book extends Controller{
	protected function Index(){
		return;
	}

	protected function Add(){
		$viewmodel = new BookModel();
		$this->return_view($viewmodel->Add(), true); 
	}

	protected function Edit(){
		$viewmodel = new BookModel();
		$this->return_view($viewmodel->Edit(), true);
	}
}