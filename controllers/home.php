<?php
class Home extends Controller{
	//Called by Controller function execute_action().
	protected function Index(){
		//Instantiate HomeModel
		$viewmodel = new HomeModel();
        //Pass in Index() from our home model into the return_view function.
		$this->return_view($viewmodel->Index(), true);
	}
}
