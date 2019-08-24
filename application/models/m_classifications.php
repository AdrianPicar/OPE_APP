<?php

class M_Classifications extends CI_Model{

	public function index(){

	}
	function get_classifications(){
		return $this->db->get("classifications");
	}
}