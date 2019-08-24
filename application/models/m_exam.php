<?php

class M_Exam extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function check_per_item($answer, $id){
		$this->load->model('m_questions');
		
		if($this->m_questions->get_question_type($id)=="Fill in the Blanks"){
			foreach($this->m_questions->get_question_options($id)->result() as $row){
				if(strcasecmp($answer, $row->option) == 0)
					return $row->score;
				else
					return 0;
			}
		}
		else{
			$this->db->where('option_id', $answer);
			foreach($this->db->get('options')->result() as $row)
				return $row->score;
		}
	}
	
	function insert_exam_details($data, $email){
		$this->db->where("email_address", $email);
		$this->db->delete('unique_key');
		
		$sql = $this->db->insert_string('exams', $data);
		$this->db->query($sql);
		return $this->db->insert_id();
	}

	function check_answers($answers, $exam_id){
		$this->load->model('m_categories');
		$this->load->model('m_questions');
		$this->load->model('m_exam_types');
		
		$score=0;
		for($i=1; ($i-1)<$answers['rows']; $i++){
			if(is_array($answers["answer_".$i])){
				foreach($answers["answer_".$i] as $answer)
					$score += $this->check_per_item($answer, $answers["question_".$i]);
			}
			else
				$score += $this->check_per_item($answers["answer_".$i], $answers["question_".$i]);

			$result = $this->m_questions->get_question($answers["question_".$i]);
			foreach($result->result() as $row){
				$data['exam_id'] = $exam_id;
				$data['question'] = $row->question;
				$data['category'] = $row->category;
				$data['type'] = $row->type;
			}
			
			$sql = $this->db->insert_string('exams_answers_questions', $data);
			$this->db->query($sql);
			$item_id = $this->db->insert_id();

			$fill_in_answer = false;
			for($j=1; $this->input->post("option_".$i."_".$j) != ""; $j++){
				$data2['item_id'] = $item_id;
				$data2['option'] = $this->input->post("option_".$i."_".$j);
				$data2['score'] = $this->input->post("score_".$i."_".$j);
				$data2['is_answer'] = 0;
			
				if(is_array($this->input->post("answer_".$i))){
					foreach($this->input->post("answer_".$i) as $answer){
						$option = $this->m_questions->get_option($answer);
						if($option==$data2['option'])
							$data2['is_answer'] = 1;
					}
				}
				else{
					$option = $this->m_questions->get_option($this->input->post("answer_".$i));
					if($option==$data2['option'] || $this->input->post("answer_".$i)==$data2['option']){
						$data2['is_answer'] = 1;
						$fill_in_answer = true;
					}
				}
				$sql = $this->db->insert_string('exams_answers_options', $data2);
				$this->db->query($sql);
			}
			
			if($data['type']=="Fill in the Blanks" && !$fill_in_answer){
				$data2['item_id'] = $item_id;
				$data2['option'] = $this->input->post("answer_".$i);
				$data2['score'] = 0;
				$data2['is_answer'] = 1;
				$sql = $this->db->insert_string('exams_answers_options', $data2);
				$this->db->query($sql);
			}
		}
		$cat_index = $this->session->userdata('cat_index');
		$category = $this->m_categories->get_category_detail($cat_index, 'category');
		$this->db->select("*");
		$this->db->where('category', $category);
	
		$result = $this->db->get('categories');
		foreach($result->result() as $row){
			$passing_score = $row->passing_score;
			$no_items = $row->no_items;
		}
		
		$this->db->order_by("percentage");
		$result = $this->db->get('classifications');
		$percentage = ($score / $no_items)*100;
		foreach($result->result() as $row){
			if($percentage >= $row->percentage)
				$classification = $row->classification;
		}
			
		$data2=array(
				'exam_id' => $exam_id,
				'category' => $category,
				'score' => $score,
				'percentage' => $percentage,
				'classification' => $classification,
				'remark' => ($score<$passing_score)? "FAILED":"PASSED"
		);
		$sql = $this->db->insert_string('exams_results', $data2);
		$this->db->query($sql);
		
		$exam_type = $this->session->userdata("exam_type");
		$exam_order = $this->session->userdata("exam_order")+1;
		$result = $this->m_exam_types->get_exam_type_order($exam_type, $exam_order);
		$this->session->unset_userdata('cat_index');
		//$result = $this->m_categories->get_category_detail($cat_index+1, 'category');
		//$this->session->unset_userdata('cat_index');
		if(strlen($result) == 0){
			$this->session->set_userdata('cat_index', -1);
		}
		else if($data2['remark'] == "FAILED"){
			$result2 = $this->m_exam_types->get_exam_types();
			foreach($result2->result() as $row){
				if($row->order >= $exam_order && $row->type == $exam_type){
					$data2=array(
							'exam_id' => $exam_id,
							'category' => $row->category,
							'score' => null,
							'percentage' => null,
							'classification' => null,
							'remark' => null
					);
					$sql = $this->db->insert_string('exams_results', $data2);
					$this->db->query($sql);
				}
			}
			$this->session->set_userdata('cat_index', -1);
		}
		else{
			$this->session->unset_userdata("exam_order");
			$this->session->set_userdata("exam_order", $exam_order);
			$this->session->set_userdata('cat_index', $result);
		}
			
	}
}