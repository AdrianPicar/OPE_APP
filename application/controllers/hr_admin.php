<?php

class Hr_Admin extends CI_Controller{
	
	function redirect_login(){
		if ($this->session->userdata('is_logged_in') != TRUE){
			$message = "You must be logged in to access this page.";
			$this->session->set_flashdata("error_message", $message);
			redirect(base_url("login/view_restricted"));
		}
	}
	
	function check_hr_admin_type(){
		$type = $this->session->userdata('type');
		if ($type != "hr_admin"){
			$message = "You must be logged in as a hr admin to access this page.";
			$this->session->set_flashdata("error_message", $message);
			redirect(base_url("login/view_restricted"));
		}
	}
	
	public function check_existing_user(){
		$this->load->model('m_login');
		$this->form_validation->set_message("check_existing_user", "Username is already in use.");
		$username = $this->input->post("username");
		if($username == $this->input->post("old_username"))
			return true;
		return !($this->m_login->check_valid_user($username));
	}
	
	public function view_admins(){
		$this->redirect_login();
		$this->check_hr_admin_type();
		$this->load->model('m_hr_admin');
		$data['title'] = "View Admins";
		$data2['result'] = $this->m_hr_admin->get_admins();
		
		$this->load->view('templates/header', $data);
		$this->load->view('hr_admin/v_admins_view', $data2);
		$this->load->view('templates/footer');
	}
	
	public function add_admin(){
		$this->redirect_login();
		$this->check_hr_admin_type();
		$this->load->model('m_hr_admin');
		$this->form_validation->set_rules("username", "username", "required|trim|callback_check_existing_user");
		$this->form_validation->set_rules("password", "password", "required|trim");
		$this->form_validation->set_rules("name", "name", "required|trim");
		
		if($this->form_validation->run() == FALSE){
			$this->view_admins();
		}
		else{
			$data = array(
					"username" => $this->input->post("username"),
					"password" => $this->input->post("password"),
					"name" => $this->input->post("name"),
					"type" => "admin",
					"applicant_id" => 0
					);
			$this->m_hr_admin->insert_admin($data);
			$this->session->set_flashdata("success", "Add successful.");
			redirect(base_url("hr_admin/view_admins"));
		}
	}
	
	public function edit_admin($username){
		$this->redirect_login();
		$this->check_hr_admin_type();
		$this->load->model('m_hr_admin');
		$result = $this->m_hr_admin->get_admin_details($username);
		
		foreach($result->result() as $row){
			$data2["username"] = $username;
			$data2["password"] = $row->password;
			$data2["name"] = $row->name;
		}
		
		$data['title'] = "Edit Admin Details";
		$this->load->view('templates/header', $data);
		$this->load->view('hr_admin/v_admin_edit', $data2);
		$this->load->view('templates/footer');
	}
	
	public function update_admin(){
		$this->redirect_login();
		$this->check_hr_admin_type();
		$this->load->model('m_hr_admin');
		$this->form_validation->set_rules("username", "username", "required|trim|callback_check_existing_user");
		$this->form_validation->set_rules("password", "password", "required|trim");
		$this->form_validation->set_rules("name", "name", "required|trim");
		$username = $this->input->post("old_username");
		
		if($this->form_validation->run() == FALSE){
			$this->edit_admin($username);
		}
		else{
			$data = array(
						"username" => $this->input->post("username"),
						"password" => $this->input->post("password"),
						"name" => $this->input->post("name")
						);
			
			$this->m_hr_admin->update_admin_details($username, $data);
			$this->session->set_flashdata("success", "Update successful.");
			redirect(base_url("hr_admin/view_admins"));
		}
	}
	
	function delete_admin(){
		$this->redirect_login();
		$this->check_hr_admin_type();
		$this->load->model('m_hr_admin');
		$this->m_hr_admin->delete_admin($this->input->post("username"));
		$this->session->set_flashdata("success", "Delete successful.");
		redirect(base_url("hr_admin/view_admins"));
	}
}