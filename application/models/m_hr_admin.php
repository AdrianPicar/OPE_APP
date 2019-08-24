<?php

class M_Hr_Admin extends CI_Model{

	public function index(){

	}
	function get_admins(){
		$this->db->where("type", "admin");
		return $this->db->get("users");
	}
	
	function get_admin_details($username){
		$this->db->where("username", $username);
		return $this->db->get("users");
	}
	
	function insert_admin($data){
		$sql = $this->db->insert_string('users', $data);
		$this->db->query($sql);
	}
	
	function update_admin_details($username, $data){
		$this->db->where('username', $username);
		$this->db->update('users', $data);
	}
	
	function delete_admin($username){
		$this->db->where("username", $username);
		$this->db->delete("users");
	}
	
	function get_remark($id){
		$this->db->select('remark');
		$this->db->from('exams');
		$this->db->join('exams_results', 'exams.exam_id = exams_results.exam_id');
		$this->db->where('applicant_id', $id);
		$result = $this->db->get();
		
		$remark = "";
		if($result->num_rows()==3 /*number of categories*/){
			foreach($result->result() as $row){
				$remark = "PASSED";
				if($row->remark == "FAILED"){
					$remark = "FAILED";
					break;
				}
			}
		}	
		return $remark;
	}
	
	function get_applicant_details($id){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->join('users', 'applicants.applicant_id=users.applicant_id');
		$this->db->where('users.applicant_id', $id);
		
		return $this->db->get();
	}
	
	function get_exam_date($id){
		$this->db->where('applicant_id', $id);
		foreach($this->db->get('exams')->result() as $row)
			return $row->created_on;
	}
	
	function get_applicants(){
		$data['result'] = $this->db->get('applicants');
		$data['num_rows'] = $data['result']->num_rows();
		
		return $data;
	}
	
	function get_applicant_exam_questions($id, $category){
		$this->db->select("exam_id");
		$this->db->from("exams");
		$this->db->where("applicant_id", $id);
		foreach($this->db->get()->result() as $row)
			$exam_id = $row->exam_id;
		
		$this->db->where("exam_id", $exam_id);
		$this->db->where("category", $category);
		return $this->db->get("exams_answers_questions");
	}
	
	function get_applicant_exam_options(){
		return $this->db->get("exams_answers_options");
	}
	
	function update_category_settings($data, $category){
		$data['category'] = $category;
		$this->db->where('category', $category);
		$this->db->update('categories', $data);
	}
	
	function update_general_settings($data){
		$this->db->where('no', 0);
		$this->db->update('settings', $data);
	}
	
	function get_category_details($category_no){
		$this->db->where('category_no', $category_no);
		return $this->db->get('categories');
	}
	
	function get_category($index){
		$result = $this->db->get('categories');
		foreach($result->result() as $row){
			$data[] = $row->category;  
		}
		return $data[$index];
	}
	
	function get_questions(){
		return $this->db->get('questions');	
	}
	
	function get_question_types(){
		$this->db->order_by('type_no');
		return $this->db->get('question_types');
	}
	
	function insert_question($data){
		$sql = $this->db->insert_string('questions', $data);
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	
	function insert_question_answer($data){
		$sql = $this->db->insert_string('options', $data);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}
	
	function insert_questions($data){
		$sql = $this->db->insert_string('questions', $data);		
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	function get_general_settings(){
		return $this->db->get('settings');
	}
	
	function update_email_settings($data){
		$this->db->where('no', 0);
		$this->db->update('settings', $data);
	}
	
	function update_sent_email($id){
		$data["is_sent_email"] = "1";
		$this->db->where('applicant_id', $id);
		$this->db->update('applicants', $data);
	}
	
	function insert_unique_key($data){
		$sql = $this->db->insert_string('unique_key', $data);
		$this->db->query($sql);
	}
}