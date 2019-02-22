<?php
class HomeModel extends Model{
	public function Index(){
		$query = "SELECT * FROM classics";
		$params = array();
		$this->set_query($query, $params);
		$results = $this->get_results();
		//var_dump($results);
		return $results;
	}
}

