<?php

class M_Admin extends CI_Model{

	public function index(){

	}
	
	function get_exam_results($exam_id){
		$this->db->where("exam_id", $exam_id);
		return $this->db->get("exams_results");
	}
	
	function search_applicants_category($substring, $cat){
		$this->db->select("*");
		$this->db->from("applicants a");
		$this->db->join('exams b', 'a.applicant_id = b.applicant_id');
		
		switch($cat){
			case "name":
				$this->db->like('a.first_name', $substring);
				$this->db->or_like('a.middle_name', $substring);
				$this->db->or_like('a.last_name', $substring);
				break;
			default:
				$this->db->like('a.'.$cat, $substring);
				break;
		}
		$this->db->order_by('b.exam_id', "desc");
		
		$result['result'] = $this->db->get();
		$result['num_rows'] = $result['result']->num_rows();
		return $result;
	}
	
	function search_applicants_date($date_from, $date_to){
		$this->db->select("*");
		$this->db->from("applicants a");
		$this->db->join('exams b', 'a.applicant_id = b.applicant_id');
		$this->db->where('b.created_on >=', $date_from);
		$this->db->where('b.created_on <=', $date_to);
		$this->db->order_by('b.exam_id', "desc");
		
		$result['result'] = $this->db->get();
		$result['num_rows'] = $result['result']->num_rows();
		return $result;
	}
	
	function get_remark($exam_id){
		$this->db->select('remark');
		$this->db->from('exams');
		$this->db->join('exams_results', 'exams.exam_id = exams_results.exam_id');
		$this->db->where('exams.exam_id', $exam_id);
		$result = $this->db->get();
		
		foreach($result->result() as $row){
			if($row->remark == "FAILED")
				return "FAILED";
		}
		$this->load->model("m_login");
		$this->load->model("m_exam_types");
		$type = $this->m_exam_types->get_exam_type_user($exam_id);
		
		$this->db->where("type", $type);
		$result2 = $this->db->get("exam_types");
		
		if($result->num_rows() < $result2->num_rows())
			return "";
		return "PASSED";
	}
	
	function get_applicant_id($exam_id){
		$this->db->select("applicant_id");
		$this->db->from("exams");
		$this->db->where("exam_id", $exam_id);
		foreach($this->db->get()->result() as $row)
			return $row->applicant_id;
	}
	
	function get_exam_details($exam_id){
		$this->db->select('*');
		$this->db->from('applicants a');
		$this->db->join('users b', 'a.applicant_id=b.applicant_id');
		$this->db->join('exams c', 'a.applicant_id=c.applicant_id');
		$this->db->where('c.exam_id', $exam_id);
	
		return $this->db->get();
	}
	
	function get_applicant_details($applicant_id){
		$this->db->select('*');
		$this->db->from('applicants');
		$this->db->join('users', 'applicants.applicant_id=users.applicant_id');
		$this->db->where('users.applicant_id', $applicant_id);
		
		return $this->db->get();
	}
	
	function get_applicants(){
		$data['result'] = $this->db->get('applicants');
		$data['num_rows'] = $data['result']->num_rows();
		
		return $data;
	}
	
	function get_applicant_exam_questions($exam_id, $category){
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
		return $data["unique_key"];
	}
	
	function insert_new_exam($data){
		$sql = $this->db->insert_string('exams', $data);
		$this->db->query($sql);
	}
}