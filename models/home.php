<?php
class HomeModel extends Model{
	public function Index(){
		$query = "SELECT * FROM classics WHERE author = ?";
		$params = array('Janines book');
		$this->set_query($query, $params);
		$results = $this->get_results();
		var_dump($results);
		return;
	}
}

