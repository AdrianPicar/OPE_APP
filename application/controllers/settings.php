<?php

class Settings extends CI_Controller{
		
	function index(){
		
	}
	
	
	function redirect_login(){
		if ($this->session->userdata('is_logged_in') != TRUE){
			$message = "You must be logged in to access this page.";
			$this->session->set_flashdata("error_message", $message);
			redirect(base_url("login/view_restricted"));
		}
	}
	
	function check_admin_type(){
		$type = $this->session->userdata('type');
		if (!($type != "admin" || $type != "super_admin")){
			$message = "You must be logged in as an admin to access this page.";
			$this->session->set_flashdata("error_message", $message);
			redirect(base_url("login/view_restricted"));
		}
	}
	
	function check_existing_user_key(){
		//checks if email has already a unique key
		$this->load->model('m_login');
		$result = $this->m_login->get_unique_key($this->input->post("email_address"));
		if($result->num_rows() > 0){ 
			foreach($result->result() as $row)
				return $row->unique_key;
		}
		return null;
	}
	
	function check_valid_username(){
		//checks if valid username
		$this->load->model('m_login');
		$this->form_validation->set_message("check_valid_username", "The email address is already registered.");
		return !($this->m_login->check_valid_user($this->input->post("email_address")));
	}
	
	function check_valid_exam_type(){
		//checks if user has not taken that exam type yet
		$this->load->model("m_login");
		$this->load->model("m_exam_types");
		$this->form_validation->set_message("check_valid_exam_type", "The applicant has already taken this exam.");
		$email_address = $this->input->post("email_address");
		$applicant_id = $this->m_login->get_applicant_id($email_address);
		$result = $this->m_exam_types->get_exam_types_taken($applicant_id);
		$type = $this->input->post("exam_type");
		foreach($result->result() as $row){
			if($row->type == $type)
				return false;
		}
		return true;
	}
	
	function check_existing_user(){
		//checks if existing user
		$this->load->model('m_login');
		$this->form_validation->set_message("check_existing_user", "The email address is not registered.");
		return $this->m_login->check_valid_user($this->input->post("email_address"));
	}
	
	function check_pass_match(){
		$this->form_validation->set_message("check_pass_match", "Passwords do not match.");
		if($this->input->post("email_password")==$this->input->post("email_cpassword"))
			return true;
		return false;
	}
	
	function check_no_items(){
		$this->load->model("m_questions");
		$this->form_validation->set_message("check_no_items", "The number of items cannot be greater than the number of items available in the questions pool.");
		$result = $this->m_questions->get_no_questions();
		foreach($result->result() as $row){
			if($this->input->post("category")==$row->category){
				if($this->input->post("no_items") <= $row->count)
					return true;
			}	
		}
		return false;
	}
	
	function check_empty_array(){
		$this->form_validation->set_message("check_empty_array", "You must select at least one category.");
		
		$type = $this->input->post("exam_type");
		if($this->input->post($type."_checkbox") == null)
			return false;
		return true;
	}
	
	function edit_display_message(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row){
			$data2["display_message"] = $row->display_message;
		}
	
		$data['title'] = "Edit Settings";
		$data2['categories'] = $this->m_categories->get_categories();
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_edit_display_message', $data2);
		$this->load->view('templates/footer');
	}
	
	function edit_post_exam(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row){
			$data2["post_exam_message"] = $row->post_exam_message;
		}
	
		$data['title'] = "Edit Settings";
		$data2['categories'] = $this->m_categories->get_categories();
	
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_edit_post_exam', $data2);
		$this->load->view('templates/footer');
	}

	function edit_category_settings($category_no){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		
		if($category_no == "update_category_settings")
			$this->update_category_settings();
		
		else{
			$result = $this->m_admin->get_category_details($category_no);
			foreach($result->result() as $row){
				$data2['category'] = $row->category;
				$data2['time_limit'] =$row->time_limit;
				$data2['no_items'] = $row->no_items;
				$data2['passing_score'] = $row->passing_score;
				$data2['instructions'] = $row->instructions;
			}
			$data2['category_no'] = $category_no;
			$data2['categories'] = $this->m_categories->get_categories();
					
			$data['title'] = "Edit Settings";
			$this->load->view('templates/header', $data);
			$this->load->view('admin/v_settings_category', $data2);
			$this->load->view('templates/footer');
		}
	}
	
	function update_category_settings(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$category_no = $this->input->post("category_no");
		$this->form_validation->set_rules("instructions", "instructions", "required|trim");
		$this->form_validation->set_rules("no_items", "number of items", "callback_check_no_items");
		if($this->form_validation->run() == FALSE){
			$this->edit_category_settings($category_no);
		}
		else{
			$details = array(
					'category' => $this->input->post("category"),
					'time_limit' => $this->input->post("time_limit"),
					'no_items' => $this->input->post("no_items"),
					'passing_score' => $this->input->post("passing_score"),
					'instructions' => $this->input->post("instructions")
			);
			$this->m_admin->update_category_settings($details, $details['category']);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_category_settings/".$category_no));
		}
	}
	
	function update_display_message(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$this->form_validation->set_rules("display_message", "display message", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_display_message();
		}
		else{
			$details = array(
					'display_message' => $this->input->post("display_message")
			);
			$this->m_admin->update_general_settings($details);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_display_message"));
		}
	}
	
	function update_post_exam(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$this->form_validation->set_rules("post_exam_message", "post-exam message", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_post_exam();
		}
		else{
			$details = array(
					'post_exam_message' => $this->input->post("post_exam_message")
			);
			$this->m_admin->update_general_settings($details);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_post_exam"));
		}
	}
	
	function edit_email_password(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row){
			$data['email_address'] = $row->email_address;
			$data['email_password'] = $row->email_password;
		}
		
		$data['title'] = "Edit Settings";
		$data2['categories'] = $this->m_categories->get_categories();
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_email', $data2);
		$this->load->view('templates/footer');
	}

	function generate_unique_key(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_categories');
		$this->load->model('m_exam_types');
		$data2['categories'] = $this->m_categories->get_categories();
		$data2['exam_types'] = $this->m_exam_types->get_distinct_exam_types();
		$data['title'] = "Edit Settings";
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_unique_key');
		$this->load->view('templates/footer');
	}
	
	function create_unique_key(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->form_validation->set_rules("email_address", "email address", "required|trim|valid_email|callback_check_valid_username");
		if($this->form_validation->run() == FALSE){
			$this->generate_unique_key();
		}
		else{
			$this->load->model('m_admin');
			if($this->check_existing_user_key() != null)
				$unique_key = $this->check_existing_user_key();
			
			else{
				$data['email_address'] = $this->input->post("email_address");
				$data['exam_type'] = $this->input->post("exam_type");
				$data['unique_key'] = substr(md5(uniqid()), 0, 15);
				$unique_key = $this->m_admin->insert_unique_key($data);
			}
			
			$this->session->set_flashdata("unique_key", $unique_key);
			$this->session->set_flashdata("success", "Success.");
			redirect(base_url("settings/generate_unique_key"));
		}	
	}
	
	function add_new_exam(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_categories');
		$this->load->model('m_exam_types');
		$data2['categories'] = $this->m_categories->get_categories();
		$data2['exam_types'] = $this->m_exam_types->get_distinct_exam_types();
		$data['title'] = "Edit Settings";
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_new_exam');
		$this->load->view('templates/footer');
	}
	
	function insert_new_exam(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->form_validation->set_rules("email_address", "email address", "required|trim|valid_email|callback_check_existing_user");
		$this->form_validation->set_rules("exam_type", "exam type", "callback_check_valid_exam_type");
		if($this->form_validation->run() == FALSE){
			$this->add_new_exam();
		}
		else{
			$this->load->model('m_admin');
			$this->load->model('m_login');
			
			$email_address = $this->input->post("email_address");
			$data['applicant_id'] = $this->m_login->get_applicant_id($email_address);
			date_default_timezone_set('Asia/Manila');
			$data['created_on'] = date('Y-m-d H:i:s');
			$data['type'] = $this->input->post("exam_type");
			$this->m_admin->insert_new_exam($data);
			
			$this->session->set_flashdata("success", "Add successful.");
			redirect(base_url("settings/add_new_exam"));
		}
	}
	
	function edit_exam_type(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_categories');
		$this->load->model('m_exam_types');
		$data2['categories'] = $this->m_categories->get_categories();
		$data2['exam_types'] = $this->m_exam_types->get_distinct_exam_types();
		$data2['exam_types_details'] = $this->m_exam_types->get_exam_types();
		$data['title'] = "Edit Settings";
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_exam_type');
		$this->load->view('templates/footer');
	}
	
	function update_exam_type(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_exam_types');
		$type = $this->input->post("exam_type");
		
		$this->form_validation->set_rules($type."_checkbox", "checkbox", "callback_check_empty_array");

		if($this->form_validation->run() == FALSE){
			$this->edit_exam_type();
		}
		else{
			$this->m_exam_types->update_exam_type($_POST);
			$this->session->set_flashdata("success", "Update successful.");
			
			redirect(base_url("settings/edit_exam_type"));
		}
	}
	
	function edit_email_passed(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row){
			$data['subject_passed'] = $row->subject_passed;
			$data['message_passed'] = $row->message_passed;
		}
		
		$data['title'] = "Edit Settings";
		$data2['categories'] = $this->m_categories->get_categories();
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_email_passed', $data2);
		$this->load->view('templates/footer');
	}
	
	function edit_email_failed(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$result = $this->m_admin->get_general_settings();
		foreach($result->result() as $row){
			$data['subject_failed'] = $row->subject_failed;
			$data['message_failed'] = $row->message_failed;
		}
	
		$data['title'] = "Edit Settings";
		$data2['categories'] = $this->m_categories->get_categories();
		
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_settings_sidebar', $data2);
		$this->load->view('admin/v_settings_email_failed', $data2);
		$this->load->view('templates/footer');
	}
	
	function update_email_password(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->form_validation->set_rules("email_address", "email address", "required|trim|valid_email");
		$this->form_validation->set_rules("email_password", "password", "required|trim|callback_check_pass_match");
		$this->form_validation->set_rules("email_cpassword", "confirm password", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_email_password();
		}
		else{
			$details = array(
					'email_address' => $this->input->post("email_address"),
					'email_password' => $this->input->post("email_password")
			);
			$this->m_admin->update_email_settings($details);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_email_password"));
		}
	}
	
	function update_email_passed(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->form_validation->set_rules("email_subject", "subject", "required|trim");
		$this->form_validation->set_rules("email_message", "message", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_email_passed();
		}
		else{
			$details = array(
					'subject_passed' => $this->input->post("email_subject"),
					'message_passed' => $this->input->post("email_message")
			);
			$this->m_admin->update_email_settings($details);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_email_passed"));
		}
	}
	
	function update_email_failed(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->form_validation->set_rules("email_subject", "subject", "required|trim");
		$this->form_validation->set_rules("email_message", "message", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->edit_email_failed();
		}
		else{
			$details = array(
					'subject_failed' => $this->input->post("email_subject"),
					'message_failed' => $this->input->post("email_message")
			);
			$this->m_admin->update_email_settings($details);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("settings/edit_email_failed"));
		}
	}
}