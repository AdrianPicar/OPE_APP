<?php

class M_Exam_Types extends CI_Model{

	public function index(){

	}
	
	function get_exam_types(){
		$this->db->select("*");
		$this->db->from("exam_types a");
		$this->db->join("categories b", "a.category_no = b.category_no");
		return $this->db->get();
	}
	
	function get_distinct_exam_types(){
		$this->db->distinct();
		$this->db->select("type");
		return $this->db->get("exam_types");
	}
	
	function get_exam_types_taken($applicant_id){
		$this->db->where("applicant_id", $applicant_id);
		return $this->db->get("exams");
	}
	
	function get_exam_type_email($email){
		$this->db->where("email_address", $email);
		foreach($this->db->get("unique_key")->result() as $row)
			return $row->exam_type;
	}
	
	function get_exam_type_user($id){
		$this->db->where("exam_id", $id);
		foreach($this->db->get("exams")->result() as $row)
			return $row->type;
	}
	
	function get_exam_type_order($type, $order){
		$this->db->where("type", $type);
		$this->db->where("order", $order);
		foreach($this->db->get("exam_types")->result() as $row)
			return $row->category_no;
	}
	
	function update_exam_type($data){
		$type = $data["exam_type"];
		$this->db->where("type", $type);
		$this->db->delete("exam_types");
		
		foreach($data[$type."_checkbox"] as $category_no){
			$data2 = array(
					"type" => $type,
					"order" => $data[$type."_".$category_no."_exam_order"],
					"category_no" => $category_no 
					);
			$sql = $this->db->insert_string('exam_types', $data2);
			$this->db->query($sql);
		}
	}
}