<?php

class Applicant extends CI_Controller{

	function index(){
		
	}
	
	function redirect_login(){
		if ($this->session->userdata('is_logged_in') != TRUE){
			$message = "You must be logged in to access this page.";
			$this->session->set_flashdata("error_message", $message);
			redirect(base_url("login/view_restricted"));
		}
	}
	
	function check_unique_key(){
		$this->load->model('m_login');
		$this->form_validation->set_message("check_unique_key", "The unique key does not match the email address.");
		$result = $this->m_login->get_unique_key($this->input->post("email_address"));
		//if(count($result) == 0) 2014
		if($result->num_rows == 0) //2019
			return false;
		
		foreach($result->result() as $row){
			if($this->input->post("unique_key")==$row->unique_key)
				return true;
		}
		return false;
	}
	
	function check_existing_user(){
		//checks if valid username
		$this->load->model('m_login');
		$this->form_validation->set_message("check_existing_user", "The email address is already registered.");
		if($this->input->post("email_address")==$this->input->post("email_address_hidden"))
			return true;
		return !($this->m_login->check_valid_user($this->input->post("email_address")));
	}
	
	function check_pass_match(){
		$this->form_validation->set_message("check_pass_match", "Passwords do not match.");
		if($this->input->post("password")==$this->input->post("cpassword"))
			return true;
		return false;
	}
	
	function check_old_pass_match(){
		$this->form_validation->set_message("check_old_pass_match", "Your input does not match your old password.");
		if($this->input->post("old_password")==$this->input->post("old_password_hidden"))
			return true;
		return false;
	}

	function enter_details(){
		$data['title'] = "Enter Details";
		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_enter_details');
		$this->load->view('templates/footer');
	}
	
	function confirm_details(){
		$data['title'] = "Confirm Details";
		
		$this->form_validation->set_rules("unique_key", "unique key", "required|trim|callback_check_unique_key");
		$this->form_validation->set_rules("email_address", "email address", "required|trim|valid_email|callback_check_existing_user");
		$this->form_validation->set_rules("password", "password", "required|trim|callback_check_pass_match");
		$this->form_validation->set_rules("cpassword", "confirm password", "required|trim");
		$this->form_validation->set_rules("first_name", "first name", "required|trim");
		$this->form_validation->set_rules("last_name", "last name", "required|trim");
		$this->form_validation->set_rules("home_address", "address", "required|trim");
		$this->form_validation->set_rules("course", "course", "required|trim");
		$this->form_validation->set_rules("school", "school", "required|trim");
		$this->form_validation->set_rules("position", "position", "required|trim");
		
		if($this->form_validation->run() == FALSE){
			$this->enter_details();
		}
		else{
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$day = $this->input->post('day');
					
			$data2['email_address'] = $this->input->post('email_address');
			$data2['password'] = $this->input->post('password');
			$data2['first_name'] = $this->input->post('first_name');
			$data2['middle_name'] = $this->input->post('middle_name');
			$data2['last_name'] = $this->input->post('last_name');
			$data2['home_address'] = $this->input->post('home_address');
			$data2['birthdate'] = $year."-".$month."-".$day;
			$data2['course'] = $this->input->post('course');
			$data2['school'] = $this->input->post('school');
			$data2['position'] = $this->input->post('position');
			$data2['contact_no'] = $this->input->post('contact_no');
			
			$this->load->view('templates/header', $data);
			$this->load->view('applicant/v_confirm_details', $data2);
			$this->load->view('templates/footer');
		}
	}
	
	function add_details(){
		$this->load->model('m_login');
		$this->load->model('m_exam');
		$this->load->model('m_exam_types');
			
		$data['first_name'] = $this->input->post('first_name');
		$data['middle_name'] = $this->input->post('middle_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['home_address'] = $this->input->post('home_address');
		$data['birthdate'] = $this->input->post('birthdate');
		$data['course'] = $this->input->post('course');
		$data['school'] = $this->input->post('school');
		$data['position'] = $this->input->post('position');
		$data['contact_no'] = $this->input->post('contact_no');
		$result = $this->m_login->insert_applicant_details($data);

		$data2['username'] = $this->input->post('email_address');
		$data2['password'] = $this->input->post('password');
		$data2['name'] = $data['first_name']." ".$data['last_name'];
		$data2['type'] = "applicant";
		$data2['applicant_id'] = $result['id'];
		$result2 = $this->m_login->insert_applicant_user($data2);
		
		$data3["applicant_id"] = $result['id'];
		$data3["type"] = $this->m_exam_types->get_exam_type_email($data2["username"]);
		date_default_timezone_set('Asia/Manila');
		$data3['created_on'] = date('Y-m-d H:i:s');
		$exam_id = $this->m_exam->insert_exam_details($data3, $data2['username']);
		
		$exam_type = $data3["type"];
		$exam_order = 1;
		$cat_index = $this->m_exam_types->get_exam_type_order($exam_type, $exam_order);
			
		if($result['rows'] > 0){
			$this->session->set_userdata('applicant_id', $result['id']);
			$this->session->set_userdata('cat_index', $cat_index);
			$this->session->set_userdata('exam_order', $exam_order);
			$this->session->set_userdata('type', 'applicant');
			$this->session->set_userdata('name', $data2['name']);
			$this->session->set_userdata('exam_id', $exam_id);
			$this->session->set_userdata('exam_type', $data3["type"]);
			$this->session->set_userdata('is_logged_in', TRUE);
			$this->home();
		}
		else
			$this->enter_details();
	}
	
	function view_applicant_info(){
		$this->redirect_login();
		$this->load->model('m_admin');
	
		$data['title'] = "Applicant Information";
		$result = $this->m_admin->get_applicant_details($this->session->userdata('applicant_id'));
		foreach($result->result() as $row){
			$data2["email_address"] = $row->username;
			$data2["password"] = $row->password;
			$data2["first_name"] = $row->first_name;
			$data2["middle_name"] = $row->middle_name;
			$data2["last_name"] = $row->last_name;
			$data2["home_address"] = $row->home_address;
			$data2["birthdate"] = $row->birthdate;
			$data2["school"] = $row->school;
			$data2["position"] = $row->position;
			$data2["course"] = $row->course;
			$data2["contact_no"] = $row->contact_no;
		}
	
		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_applicant_info', $data2);
		$this->load->view('templates/footer');
	}
	
	function edit_applicant_details(){
		$this->redirect_login();
		$this->load->model("m_admin");
		$data['title'] = "Edit Details";
		$id = $this->session->userdata("applicant_id");
		$result = $this->m_admin->get_applicant_details($id);
		foreach($result->result() as $row){
			$data2['first_name'] = $row->first_name;
			$data2['middle_name'] = $row->middle_name;
			$data2['last_name'] = $row->last_name;
			$data2['home_address'] = $row->home_address;
			$date = DateTime::createFromFormat("Y-m-d", $row->birthdate);
			$data2['year'] = $date->format("Y");
			$data2['month'] = $date->format("m");
			$data2['day'] = $date->format("d");
			$data2['course'] = $row->course;
			$data2['school'] = $row->school;
			$data2['position'] = $row->position;
			$data2['contact_no'] = $row->contact_no;
		}

		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_edit_details', $data2);
		$this->load->view('templates/footer');
	}
	
	function update_applicant_details(){
		$this->redirect_login();
		$this->form_validation->set_rules("first_name", "first name", "required|trim");
		$this->form_validation->set_rules("last_name", "last name", "required|trim");
		$this->form_validation->set_rules("home_address", "address", "required|trim");
		$this->form_validation->set_rules("course", "course", "required|trim");
		$this->form_validation->set_rules("school", "school", "required|trim");
		$this->form_validation->set_rules("position", "position", "required|trim");
		
		if($this->form_validation->run() == FALSE){
			$this->edit_applicant_details();
		}
		else{
			$this->load->model("m_login");
			$id = $this->session->userdata("applicant_id");
			
			$year = $this->input->post('year');
			$month = $this->input->post('month');
			$day = $this->input->post('day');
			
			$data['first_name'] = $this->input->post('first_name');
			$data['middle_name'] = $this->input->post('middle_name');
			$data['last_name'] = $this->input->post('last_name');
			$data['home_address'] = $this->input->post('home_address');
			$data['birthdate'] = $year."-".$month."-".$day;
			$data['course'] = $this->input->post('course');
			$data['school'] = $this->input->post('school');
			$data['position'] = $this->input->post('position');
			$data['contact_no'] = $this->input->post('contact_no');
			$this->m_login->update_applicant_details($data, $id);
			
			$data2['name'] = $data['first_name']." ".$data['last_name'];
			$this->m_login->update_applicant_user($data2, $id);
			
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("applicant/view_applicant_info"));
		}
	}
	
	function edit_user_details(){
		$this->redirect_login();
		$this->load->model("m_admin");
		$data['title'] = "Edit Details";
		$id = $this->session->userdata("applicant_id");
		$result = $this->m_admin->get_applicant_details($id);
		foreach($result->result() as $row){
			$data2['email_address'] = $row->username;
			$data2['password'] = $row->password;
		}
		
		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_edit_user', $data2);
		$this->load->view('templates/footer');
	}
	
	function update_user_details(){
		$this->redirect_login();
		$this->form_validation->set_rules("email_address", "email address", "required|trim|valid_email|callback_check_existing_user");
		$this->form_validation->set_rules("old_password", "old password", "required|trim|callback_check_old_pass_match");
		$this->form_validation->set_rules("password", "new password", "required|trim|callback_check_pass_match");
		$this->form_validation->set_rules("cpassword", "confirm password", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_user_details();
		}
		else{
			$this->load->model("m_login");
			$id = $this->session->userdata("applicant_id");
			
			if($this->input->post('email_address') != $this->input->post('email_address_hidden'))
				$data2['username'] = $this->input->post('email_address');
			
			$data2['password'] = $this->input->post('password');
			$this->m_login->update_applicant_user($data2, $id);
			
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("applicant/view_applicant_info"));
		}
	}
	
	function submit_answers(){
		$this->redirect_login();
		$this->load->model('m_exam');
		$exam_id = $this->session->userdata('exam_id');
		$this->m_exam->check_answers($_POST, $exam_id);
		
		$data['title'] = "Exam Results";
		$cat_index = $this->session->userdata('cat_index');
		
		if($this->session->userdata('cat_index')==-1){
			$this->exam_end();
		}
		else{
			redirect(base_url("applicant/view_instructions"));
		}
	}
	
	function exam(){
		$this->redirect_login();
		$this->load->model('m_questions');
		$this->load->model('m_exam');
		$this->load->model('m_categories');
		
		$cat_index = $this->session->userdata('cat_index');
		$data2['result'] = $this->m_questions->get_category_questions_exam($cat_index);
		$data2['rows'] = $data2['result']->num_rows();
		$data2['result2'] = $this->m_questions->get_options_random();
		$data2['time_limit'] = $this->m_categories->get_category_detail($cat_index,'time_limit');
		
		$data2['category'] = $this->m_categories->get_category_detail($cat_index,'category');
		$data['title'] = $data2['category']." Exam";
		
		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_exam', $data2);
		$this->load->view('templates/footer');
	}
	
	function home(){
		$this->redirect_login();
		$this->load->model('m_admin');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row)
			$data2["display_message"] = $row->display_message;
		
		$data['title'] = "Home";
		$this->load->view('templates/header', $data);
		$this->load->view('home', $data2);
		$this->load->view('templates/footer');
	}
	
	function view_instructions(){
		$this->redirect_login();
		$this->load->model('m_categories');
		
		$cat_index = $this->session->userdata('cat_index');
		$result = $this->m_categories->get_category_details($cat_index);
		
		if($result == null){
			$data['title'] = "Exam Completed";
			$this->load->view('templates/header', $data);
			$this->load->view('applicant/v_exam_completed');
			$this->load->view('templates/footer');
		}
		else{
			$data2['category'] = $this->m_categories->get_category_detail($cat_index,'category');
			$data2['instructions'] = $this->m_categories->get_category_detail($cat_index,'instructions');
			$data['title'] = "Instructions";
		
			$this->load->view('templates/header', $data);
			$this->load->view('applicant/v_instructions', $data2);
			$this->load->view('templates/footer');
		}
	}
	
	function exam_end(){
		$this->redirect_login();
		$this->load->model('m_admin');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row)
			$data2["post_exam_message"] = $row->post_exam_message;
		
		$data['title'] = "Exam Completed";
		$this->load->view('templates/header', $data);
		$this->load->view('applicant/v_exam_end', $data2);
		$this->load->view('templates/footer');
		$this->session->sess_destroy();
	}
}
?>