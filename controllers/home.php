<?php
class Home extends Controller{
	//Called by Controller function execute_action().
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->return_view($viewmodel->Index(), true); //results from Home model Index() passed to return_view (See return_view in base controller and see where varialbe $viewmodel is called in views/home/index.php)
	}

	
}

