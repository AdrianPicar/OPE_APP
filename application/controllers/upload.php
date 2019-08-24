<?php

class Upload extends CI_Controller {

	function index()
	{
		$data['title'] = "Upload Questions";
		$data2['table'] = null;
		$data2['error'] = null;
		if(isset($this->success)) $data2['success'] = $this->success;
		$this->load->view('templates/header', $data);
		$this->load->view('v_upload', $data2);
		$this->load->view('templates/footer');
	}
	
	function redirect_login(){
		if ($this->session->userdata('is_logged_in') != TRUE){
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
	
	function add_data($datauser){
		//model dapat
		$this->db->insert('users',$datauser);
		return $this->db->insert_id();
	}
	
	function initial_upload(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_upload');
		$is_success = $this->m_upload->upload_excel_file();
		
		$data['title'] = "Upload";
		$data2['error'] = $this->upload->display_errors();
		if (!$is_success){
			$data2['table'] = false;
		}
		else{
			$this->load->library('table');
			$upload_data = $this->upload->data();
			$this->session->set_userdata('file', $upload_data['full_path']);
			$data2['questions'] = $this->m_upload->read_excel_file($this->session->userdata('file'));
			$data2['error'] = $this->m_upload->check_values($data2['questions']);
			$data2['table'] = true;
		}
		$this->load->view('v_upload', $data2);
		$this->load->view('templates/footer');
	}
	
	function commit_upload(){
		$this->redirect_login();
		$this->check_admin_type();
		if ($this->form_validation->run() === FALSE && $this->input->post('submit')){
			$this->load->model('m_upload');
			$questions = $this->m_upload->read_excel_file($this->session->userdata('file'));
			$this->m_upload->insert_questions($questions);
			$this->session->unset_userdata('file');
			$this->session->set_flashdata("success", "Upload successful.");
		}
		redirect(base_url("upload"));
	}
	
	/*function delete(){
		unlink('C:\xampp\htdocs\workspace\ope_app\uploads\aw.xlsx');
	}*/
}
?>