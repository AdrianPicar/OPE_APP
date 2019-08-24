<?php

class M_Login extends CI_Model{

	public function index(){
	
	}
	
	function get_exam_order($exam_id){
		$this->db->select("*");
		$this->db->from("exams_results a");
		$this->db->join("exams b", "a.exam_id = b.exam_id");
		$this->db->where("b.exam_id", $exam_id);
		$result = $this->db->get();
		foreach($result->result() as $row){
			if($row->remark == "FAILED")
				return -1;
		}
		return $result->num_rows();
	}
	
	function get_exam_id($id){
		$this->db->where('applicant_id', $id);
		$this->db->order_by("created_on", "desc");
		$this->db->limit(1);
		foreach($this->db->get('exams')->result() as $row)
			return $row->exam_id;
	}
	
	public function insert_applicant_details($data){
		$sql = $this->db->insert_string('applicants', $data);
		$this->db->query($sql);
		$data['rows'] = $this->db->affected_rows();
		$data['id'] = $this->db->insert_id();
		return $data;
	}
	
	public function insert_applicant_user($data){
		$sql = $this->db->insert_string('users', $data);
		$this->db->query($sql);
		return $this->db->affected_rows();
	}

	public function check_valid_user($uname){
		$this->db->where("username", $uname);
		$result = $this->db->get("users");
		if($result->num_rows() > 0)
			return true;
		else
			return false;
	}

	public function get_login_info($uname, $pword){
		$this->db->where("username", $uname);
		$this->db->where("password", $pword);
		$result = $this->db->get("users");

		if($result->num_rows() > 0){
			foreach($result->result() as $row){
				$data['username'] = $row->username;
				$data['name'] = $row->name;
				$data['type'] = $row->type;
				$data['applicant_id'] = $row->applicant_id;
			}
			return $data;
		}
		else
			return null;
	}
	
	function get_applicant_id($email_address){
		$this->db->select("applicant_id");
		$this->db->from("users");
		$this->db->where("username", $email_address);
		foreach($this->db->get()->result() as $row)
			return $row->applicant_id;
	}
	
	public function login($uname, $pword){
		$this->db->where("username", $uname);
		$this->db->where("password", $pword);
		$result = $this->db->get("users");
	
		if($result->num_rows() > 0){
			return true;
		}
		else
			return false;
	}
	
	function update_applicant_details($data, $id){
		$this->db->where('applicant_id', $id);
		$this->db->update('applicants', $data);
	}
	
	function update_applicant_user($data, $id){
		$this->db->where('applicant_id', $id);
		$this->db->update('users', $data);
	}
	
	function get_unique_key($email_address){
		$this->db->where('email_address', $email_address);
		$this->db->select('unique_key');
		$this->db->from('unique_key');
		return $this->db->get();
	}
}