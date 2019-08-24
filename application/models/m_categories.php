<?php

class M_Categories extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function get_categories(){
    	$this->db->order_by('category_no');
    	return $this->db->get('categories');
    }
    
    function get_category_detail($index, $detail){
    	$this->db->where('category_no', $index);
    	$result = $this->db->get('categories');
    	foreach($result->result() as $row){
    		return $row->$detail;
    	}
    }
    
    function get_category_details($index){
    	$category=array();
    	$this->db->where('category_no', $index);
    	$result = $this->db->get('categories');
    	foreach($result->result() as $row){
    		$category['category'] = $row->category;
    		$category['category_no'] = $row->category_no;
    		$category['time_limit'] = $row->time_limit;
    		$category['no_items'] = $row->no_items;
    		$category['passing_score'] = $row->passing_score;
    		$category['instructions'] = $row->instructions;
    	}
    	return $category;
    }
}