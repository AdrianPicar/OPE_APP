<?php

class Admin extends CI_Controller{
		
	function index(){
		$this->redirect_login();
		$data['title'] = "Home";
		$this->load->view('templates/header', $data);
		$this->load->view('home');
		$this->load->view('templates/footer');
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
	
	/*
	 *  APPLICANTS
	 */
	
	function ajax_applicants(){
		$this->redirect_login();
		$this->check_admin_type();
		$result = $this->create_table_applicants();
		echo $result['table'];
	}
	
	function create_table_applicants(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$search_cat = $this->input->post("search_cat");
		
		if($search_cat == "exam_date"){
			$date_from = $this->input->post("year_from")."-";
			$date_from .= $this->input->post("month_from")."-";
			$date_from .= $this->input->post("day_from");
			$date_to = $this->input->post("year_to")."-";
			$date_to .= $this->input->post("month_to")."-";
			$date_to .= $this->input->post("day_to");
			$result = $this->m_admin->search_applicants_date($date_from, $date_to);
		}	
		else{
			if ($search_cat=="") $search_cat = "name";
			$search_input = $this->input->post("search_input");
			$result = $this->m_admin->search_applicants_category($search_input, $search_cat);
		}
			 
		$string =  '<table border=0 cellpadding=0 cellspacing=10 table-layout=fixed width=100%>';
		$string .=  "<tr class='heading'>";
		$string .=  "<th><input type=checkbox id=check_all /></th>";
		$string .=  "<th align=center>Name</th>";
		$string .=  "<th align=center>Course</th>";
		$string .=  "<th align=center>School</th>";
		$string .=  "<th align=center>Position</th>";
		$string .=  "<th align=center>Exam Type</th>";
		$string .=  "<th align=center>Exam Taken On</th>";
		$string .=  "</tr>";
		$string .= "<p>".$this->input->post("date_from")."</p>";
		$i=0;
		$j=0;
		$class=1;
		foreach($result['result']->result() as $row){
			$checkbox = "<input class='applicant_checkbox' type=checkbox value=".$row->applicant_id." name=checkbox_".$i." />";
			$full_name = $row->first_name." ".$row->middle_name." ".$row->last_name;
			$applicant_link = "<a href=".base_url()."admin/view_applicant_details/".$row->exam_id.">".$full_name."</a>";
			$color="white";
			$remark = $this->m_admin->get_remark($row->exam_id);
			$display = true;
			$is_taken = true;
			switch($remark)
			{
				case "PASSED": $color="66FFFF";
				if(!$this->input->post("check_passed")) $display = false;
				break;
				case "FAILED": $color="FFCCCC";
				if(!$this->input->post("check_failed")) $display = false;
				break;
				default: $color="white";
				$is_taken = false;
				if(!$this->input->post("check_not_yet")) $display = false;
			}
			switch($row->type)
			{
				case "ENG": 
					if(!$this->input->post("check_eng")) $display = false;
					break;
				case "MPT":
					if(!$this->input->post("check_mpt")) $display = false;
					break;
				case "RNF":
					if(!$this->input->post("check_rnf")) $display = false;
					break;
			}
			
			if($j%5 == 0 && $j>0)
				$class++;
			
			if($display){
				$string .=  "<tr bgcolor=".$color." class=".$class.">";
				if(!($is_taken && $row->is_sent_email == "0")) 
					$checkbox = "";
				$string .=  "<td bgcolor=#FAFAFA>".$checkbox."</td>";
				$string .=  "<td>".$applicant_link."</td>";
				$string .=  "<td>".$row->course."</td>";
				$string .=  "<td>".$row->school."</td>";
				$string .=  "<td>".$row->position."</td>";
				$string .=  "<td align=center>".$row->type."</td>";
				$string .=  "<td>".$row->created_on."</td>";
				$string .=  "</tr>";
				$j++;
			}
			$i++;
		}
		$string .= "</table>";
		
		if(($j/5) > 1){
			for($k=1; $k<=ceil($j/5); $k++){
				$string .= "<a href=# class=page id=".$k.">".$k."</a>";
				$string .= " | ";
			}
		}
		$data['num_rows'] = $result['num_rows'];
		$data['table'] = $string;
		return $data;
	}
	
	function view_applicants(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->library('pagination');
		$settings = array(
				'base_url' => site_url('admin/view_applicants'),
				'total_rows' => 3,
				'per_page' => 10,
				'url_segment' => 3
		);
		$this->pagination->initialize($settings);
		$data2['pagination'] = $this->pagination->create_links();
		//$data2['applicants'] = $result['result'];
		//$data['num_rows'] = $result['num_rows'];
		
		$result = $this->create_table_applicants();
		$data2['num_rows'] = $result['num_rows'];
		$data2['table'] = $result['table'];
		
		$data['title'] = "View Applicants";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_applicants_view', $data2);
		$this->load->view('templates/footer');
	}
	
	function view_applicant_details($exam_id){
		$this->redirect_login();
		$this->check_admin_type();
		if (!isset($exam_id))
			redirect("admin/view_applicants");
		
		$this->load->model('m_admin');
		$this->load->model('m_questions');
	
		$applicant_id = $this->m_admin->get_applicant_id($exam_id);
		$data2['details'] = $this->m_admin->get_exam_details($exam_id);
		$data2['result'] = $this->m_admin->get_exam_results($exam_id);
		
		$data['title'] = "View Applicant Details";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_applicant_detail', $data2);
		$this->load->view('templates/footer');
	}
	
	function print_applicant_details($exam_id){
		$this->redirect_login();
		$this->check_admin_type();
		if (!isset($exam_id))
			redirect("admin/view_applicants");
	
		$this->load->model('m_admin');
		$this->load->model('m_questions');
	
		$applicant_id = $this->m_admin->get_applicant_id($exam_id);
		$data2['details'] = $this->m_admin->get_exam_details($exam_id);
		$data2['result'] = $this->m_admin->get_exam_results($exam_id);
	
		$data['title'] = "Print Applicant Details";
		$this->load->view('admin/v_applicant_print_details', $data2);
	}
	
	function view_applicant_exam($exam_id, $category){
		$this->redirect_login();
		$this->check_admin_type();
		if (!isset($exam_id))
			redirect("admin/view_applicants");
	
		$this->load->model('m_admin');
	
		$data2['result'] = $this->m_admin->get_applicant_exam_questions($exam_id, $category);
		$data2['result2'] = $this->m_admin->get_applicant_exam_options();
		$data2['category'] = $category;
		$applicant_id = $this->m_admin->get_applicant_id($exam_id);
		foreach($this->m_admin->get_applicant_details($applicant_id)->result() as $row)
			$data2['full_name'] = $row->first_name." ".$row->middle_name." ".$row->last_name;
		
		$data['title'] = "View Exam";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_applicant_exam', $data2);
		$this->load->view('templates/footer');
	}
	
	function print_exam(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$exam_id = $this->session->userdata("exam_id");
		$category = $this->session->userdata("category");
		foreach($this->m_admin->get_exam_details($exam_id)->result() as $row){
			$full_name = $row->first_name." ".$row->middle_name." ".$row->last_name;
			$data2['full_name'] = $full_name;
			$data2['category'] = $category;
			$data2['course'] = $row->course;
			$data2['school'] = $row->school;
			$data2['birthdate'] = $row->birthdate;
			$data2['position'] = $row->position;
			$data2['contact_no'] = $row->contact_no;
			$data2['home_address'] = $row->home_address;
			$data2['exam_date'] = $row->created_on;
		}
		$data2['result'] = $this->m_admin->get_applicant_exam_questions($exam_id, $category);
		$data2['result2'] = $this->m_admin->get_applicant_exam_options();
			
		$this->load->view('admin/v_exam_printable', $data2);
	}
	
	function edit_applicant_details($applicant_id){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model("m_admin");
		$data['title'] = "Edit Applicant Details";
		$result = $this->m_admin->get_applicant_details($applicant_id);
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
		$this->session->set_flashdata("applicant_id", $applicant_id);
		$data2['id'] = $applicant_id;
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_applicant_edit_details', $data2);
		$this->load->view('templates/footer');
	}
	
	function update_applicant_details(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->form_validation->set_rules("first_name", "first name", "required|trim");
		$this->form_validation->set_rules("last_name", "last name", "required|trim");
		$this->form_validation->set_rules("home_address", "address", "required|trim");
		$this->form_validation->set_rules("course", "course", "required|trim");
		$this->form_validation->set_rules("school", "school", "required|trim");
		$this->form_validation->set_rules("position", "position", "required|trim");
		$applicant_id = $this->session->flashdata("applicant_id");
		
		if($this->form_validation->run() == FALSE){
			$this->edit_applicant_details($applicant_id);
		}
		else{
			$this->load->model("m_login");
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
			$this->m_login->update_applicant_details($data, $applicant_id);
				
			$data2['name'] = $data['first_name']." ".$data['last_name'];
			$this->m_login->update_applicant_user($data2, $applicant_id);
				
			$this->session->set_flashdata("success", "Update successful.");
			$exam_id = $this->session->userdata("exam_id");
			redirect(base_url("admin/view_applicant_details/".$exam_id));
		}
	}
	
	/*
	 *  QUESTIONS
	*/
	
	function ajax_questions(){
		$this->redirect_login();
		$this->check_admin_type();
		$result = $this->create_table_questions();
		echo $result['table'];
	}
	
	function create_table_questions(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->helper('inflector');
		$this->load->model('m_questions');
		$result = $this->m_questions->search_questions($this->input->post("question_search"));
		$i=0;
		$string = "";
		
		foreach($result['result']->result() as $row){
			$check_category = $this->input->post("check_".$row->category);
			$check_type = $this->input->post("check_".str_replace(" ", "_", $row->type));
			
			if($check_category && $check_type){
				if($i%15 == 0){
					if($i>0)
						$string .= "</div>";
					$string .= "<div id=questions".(($i/15)+1)." class=questions>";
				}
				
				$checkbox = "<input type=checkbox value=".$row->question_id." name=checkbox_".$i." />";
				$edit_link = "<a href=".base_url()."admin/edit_question/".$row->question_id.">Edit</a>";
				$delete_link = "<a class=delete id=".$row->question_id." href=#>Delete</a>";
				
				//$string .= "<br>";
				$string .= "<td>".$checkbox."</td>";
				$string .= $row->question;
				//$string .= "<div class=question_details>";
				
				$string .= "Category: ".$row->category."<br>";
				$string .= "Type: ".$row->type."<br>";
				$string .= $edit_link." | ".$delete_link."<br>";
				$string .= "<hr>";
				//$string .= "</div>";
				$i++;
			}	
		}
		$string .= "</div>";
		if(($i/15) > 1){
			for($j=1; $j<=ceil($i/15); $j++){
				$string .= "<a href=# class=page id=".$j.">".$j."</a>";
				$string .= " | ";
			}
		}
		
		$data['num_rows'] = $result['num_rows'];
		$data['table'] = $string;
		return $data;	
	}
	
	function view_questions(){
		$this->redirect_login();
		$this->check_admin_type();
		
		$this->load->model('m_questions');
		$data2['number'] = $this->m_questions->get_no_questions();

		$result = $this->create_table_questions();

		$data2['num_rows'] = $result['num_rows'];
		$data2['table'] = $result['table'];
		
		$data['title'] = "View Questions";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_question_view', $data2);
		$this->load->view('templates/footer');
	}
	
	function delete_question(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_questions');
		$this->m_questions->delete_question($this->input->post("question_id"));
		$this->session->set_flashdata("success", "Delete successful.");
		redirect(base_url("admin/view_questions"));
	}
	
	function delete_questions(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_questions');
		for($i=0; $i<$this->input->post('num_rows'); $i++){
			$this->m_questions->delete_question($this->input->post('checkbox_'.$i));
		}
		$this->session->set_flashdata("success", "Delete successful.");
		redirect(base_url("admin/view_questions"));
	}
	
	function enter_question(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		
		$data2['categories'] = $this->m_categories->get_categories();
		$data2['question_types'] = $this->m_admin->get_question_types();
		
		$data['title'] = "Add Question";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_question_add', $data2);
		$this->load->view('templates/footer');
	}
	
	function add_question(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$type = $this->input->post("type");
		$this->form_validation->set_rules("question", "question", "required|trim");
		for($i=0; $i<=$this->input->post($type."-index"); $i++){
			$this->form_validation->set_rules($type."-answer_".$i, "option ".($i+1), "required|trim");
		}
		
		if($this->form_validation->run() == FALSE){
			$this->enter_question();
		}
		else{
			$question = array(
					'question' => $this->input->post("question"),
					'category' => strval($this->input->post("category")),
					'type' => str_replace('_', ' ',$type)
			);
			$id = $this->m_admin->insert_question($question);
			
			for($i=0; $this->input->post($type."-answer_".$i); $i++){
				$answer = array(
						'question_id' => $id,
						'option' => $this->input->post($type."-answer_".$i),
						'score' => $this->input->post($type."-score_".$i)
				);
				
				$this->m_admin->insert_question_answer($answer);
				$this->session->set_flashdata("success", "Add successful.");
			}
			
			if($this->input->post("submit")=="Save")
				redirect(base_url("admin/view_questions"));
			else
				redirect(base_url("admin/enter_question"));
		}
	}
	
	function edit_question($id){
		$this->redirect_login();
		$this->check_admin_type();
		if (!isset($id))
			redirect("admin/view_questions");
		
		$this->load->model('m_admin');
		$this->load->model('m_categories');
		$this->load->model('m_questions');
	
		$data2['categories'] = $this->m_categories->get_categories();
		$data2['question_types'] = $this->m_admin->get_question_types();
		
		foreach($this->m_questions->get_question($id)->result() as $row){
			$data2['id'] = $row->question_id;
			$data2['question'] = $row->question;
			$data2['category'] = $row->category;
			$data2['type'] = $row->type;
		}		
		$data2['options'] = $this->m_questions->get_question_options($id);
		
		$data['title'] = "Edit Question";
		$this->load->view('templates/header', $data);
		$this->load->view('admin/v_question_edit', $data2);
		$this->load->view('templates/footer');
	}
	
	function update_question(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_questions');
		$this->load->model('m_admin');
		$type = $this->input->post("type");
		
		$this->form_validation->set_rules("question", "question", "required|trim");
		for($i=0; $i<=$this->input->post($type."-index"); $i++){
			$this->form_validation->set_rules($type."-answer_".$i, "option ".($i+1), "required|trim");
		}
		
		if($this->form_validation->run() == FALSE){
			$this->edit_question($this->input->post('id'));
		}
		else{
			$question = array(
					'question' => $this->input->post("question"),
					'category' => $this->input->post("category"),
					'type' => str_replace('_',' ',$this->input->post("type")) 
					);

			$id = $this->input->post('id');
			$this->m_questions->update_question($question, $id);
			$this->m_questions->delete_options($id);
			
			$type = $this->input->post("type");
			for($i=0; $this->input->post($type."-answer_".$i); $i++){
				$answer = array(
						'question_id' => $id,
						'option' => $this->input->post($type."-answer_".$i),
						'score' => $this->input->post($type."-score_".$i)
				);
			
				$this->m_admin->insert_question_answer($answer);
				$this->session->set_flashdata("success", "Update successful.");
			}
		redirect(base_url("admin/view_questions"));
		}
	}
	
	function print_questions($category){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_questions');
	
		$data2['result'] = $this->m_questions->get_category_questions($category);
		$data2['result2'] = $this->m_questions->get_options();
		$data2['category'] = $category;
		$this->load->view('admin/v_question_printable', $data2);
	}
	
	function home(){
		$this->redirect_login();
		$data['title'] = "Home";
		$this->load->view('templates/header', $data);
		$this->load->view('home');
		$this->load->view('templates/footer');
	}

	function send_email(){
		$this->redirect_login();
		$this->check_admin_type();
		$this->load->model('m_admin');
		$settings = $this->m_admin->get_general_settings();
		foreach($settings->result() as $row){
			$data['subject_passed'] = $row->subject_passed;
			$data['message_passed'] = $row->message_passed;
			$data['subject_failed'] = $row->subject_failed;
			$data['message_failed'] = $row->message_failed;
			$data['email_address'] = $row->email_address;
			$data['email_password'] = $row->email_password;
		}
		
		$this->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_user'] = $data['email_address']; 
		$config['smtp_pass'] = $data['email_password'];
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$config['validate'] = TRUE;
		$config['smtp_timeout'] = "300";
		
		$this->email->initialize($config);
		//echo $this->email->print_debugger();
		
		for($i=0; $i<$this->input->post('num_rows'); $i++){
			$result = $this->m_admin->get_applicant_details($this->input->post('checkbox_'.$i));
			
			foreach($result->result() as $row){
				$this->email->from($data['email_address'], 'OPE Exam Result');
				//$list = array('picar.adrian@gmail.com');
				$this->email->to($row->username);
				$remark = $this->m_admin->get_remark($row->applicant_id);
				if($remark == "PASSED"){
					$this->email->subject($data['subject_passed']);
					$this->email->message($data['message_passed']);
				}
				else{
					$this->email->subject($data['subject_failed']);
					$this->email->message($data['message_failed']);
				}
				if($this->email->send()){ 
					$this->m_admin->update_sent_email($row->applicant_id);
					$this->session->set_flashdata("success", "Send successful.");
				}
			}	
		}
		redirect(base_url("admin/view_applicants"));
	}
}
?>