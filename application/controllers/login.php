<?php

class Login extends CI_Controller{
	
	function __construct()
	{
		parent:: __construct();
		$this->clear_cache();
	}
	
	public function index(){
		if($this->session->userdata('is_logged_in')==TRUE)
			redirect(base_url().$this->session->userdata('type')."/home");
		else{
			$data['title'] = "Login";
			$this->load->view('templates/header', $data);
			$this->load->view('v_login');
			$this->load->view('templates/footer');	
		}
	}
	
	function clear_cache(){
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
		$this->output->set_header("Pragma: no-cache");
	}
	
	public function check_user(){
		//checks if valid username
		$this->load->model('m_login');
		$this->form_validation->set_message("check_user", "Invalid username");
		return $this->m_login->check_valid_user($this->input->post("username"));
	}
	
	public function check_user_pass(){
		$this->load->model('m_login');
		$this->form_validation->set_message("check_user_pass", "Username and password don't match.");
		return $this->m_login->login($this->input->post("username"), $this->input->post("password"));
	}
	
	public function login_validation(){
		//checks if valid username and password
		$this->load->model('m_login');
		$this->load->model('m_exam_types');
		
		$this->form_validation->set_rules("username", "username", "required|trim|callback_check_user|callback_check_user_pass");
		$this->form_validation->set_rules("password", "password", "required|trim");
		if($this->form_validation->run() == FALSE){
			$this->index();
		}
		
		else{
			$uname = $this->input->post("username");
			$pword = $this->input->post("password");

			if ($this->check_user_pass()){
				$sess_data = $this->m_login->get_login_info($uname, $pword);
				$this->session->set_userdata('username', $sess_data['username']);
				$this->session->set_userdata('name', $sess_data['name']);
				$this->session->set_userdata('type', $sess_data['type']);
				$this->session->set_userdata('is_logged_in', TRUE);

				if($this->session->userdata('is_logged_in')){
					if($this->session->userdata('type')=="applicant"){
						$this->session->set_userdata('applicant_id', $sess_data['applicant_id']);
						$exam_id = $this->m_login->get_exam_id($sess_data['applicant_id']);
						$this->session->set_userdata('exam_id', $exam_id);
						
						$exam_order = $this->m_login->get_exam_order($exam_id)+1;
						$this->session->set_userdata('exam_order', $exam_order);
							
						$exam_type = $this->m_exam_types->get_exam_type_user($exam_id);
						$this->session->set_userdata('exam_type', $exam_type);
							
						$cat_index = $this->m_exam_types->get_exam_type_order($exam_type, $exam_order);
						$this->session->set_userdata('cat_index', $cat_index);
					
						redirect("applicant/home");
					}
						
					else
						redirect("admin/home");
				}
				
				else{
					$this->view_restricted();
				}
			}
			else{
				$this->index();
			}
		} 	
	}
	
	public function logout(){
		$this->session->sess_destroy();
		$page = base_url();
		header("Refresh: 1; url=$page");
		redirect(base_url());
		
		//$this->clear_cache();
	}

	public function view_restricted(){
		$data['title'] = "Restricted Page";
		$this->load->view('templates/header', $data);
		$this->load->view('restricted');
		$this->load->view('templates/footer');
	}
}