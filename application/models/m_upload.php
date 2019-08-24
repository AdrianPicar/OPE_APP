<?php

class M_Upload extends CI_Model {
	
	function upload_excel_file(){
		$this->load->library('upload');
		$config['upload_path'] = realpath(APPPATH).'\uploads\files\\';
		//$config['file_name'] = "data.xlsx";
		$config['allowed_types'] = 'xls|xlsx';
		$config['max_size']	= '0';
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		$data['title'] = "Upload";
		$this->load->view('templates/header', $data);
		
		return $this->upload->do_upload();
	}
	
	function read_excel_file($file){
		//load library phpExcel
		$this->load->library("Excel");
		//reader MS Excel 2007
		$objReader = PHPExcel_IOFactory::createReader('Excel2007');
		//set to read only
		$objReader->setReadDataOnly(true);
		//load excel file
		$objPHPExcel = $objReader->load($file);
		$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
		//$objWorksheet->getStyle('E')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		
		for($i=1; $i<=$objWorksheet->getHighestRow(); $i++){
			$row = $objWorksheet->getRowIterator($i)->current();
			$cellIterator = $row->getCellIterator();
			$cellIterator->setIterateOnlyExistingCells(false);
			$col_no = 0;
			$values[] = array();
			
			foreach ($cellIterator as $cell){
				switch($col_no){
					case 0:
						$values[$i-1]['question'] = $cell->getValue();
						break;	
					case 1:
						$values[$i-1]['category'] = $cell->getValue();
						break;
					case 2:
						$values[$i-1]['type'] = $cell->getValue();
						break;
					default:
						if($cell->getFormattedValue() == "")
							$values[$i-1][] = " ";
						else{
						if($col_no%2 == 1)
							$values[$i-1][] = $cell->getValue();
						else
							$values[$i-1][] = $cell->getFormattedValue();
						}
						break;
				}
				$col_no++;
			}
			//put a blank cell to make the last option-score pair if needed
			if($col_no%2 == 0)
				$values[$i-1][] = " ";
		}
		return $values;
	}
	
	function check_values($questions){
		$error="";
		for($i=0; $i<count($questions); $i++){
			$current_error = "";
			//question validation
			if($questions[$i]['question']==null)
				$current_error.="A".($i+1)." - No question.<br> ";
			//category validation
			if($questions[$i]['category']==null)
				$current_error.="B".($i+1)." - No category.<br> ";
			else{
				$invalid_cat = true;
				$categories = "";
				foreach($this->db->get('categories')->result() as $row){
					if($questions[$i]['category'] == $row->category)
						$invalid_cat = false;
					else
						$categories .= $row->category.", ";
				}
				if($invalid_cat) $current_error .= "B".($i+1)." - Invalid category. Valid categories: ".substr($categories,0,-2)."<br> ";
			}
			//type validation
			if($questions[$i]['type']==null)
				$current_error.= "C".($i+1)." - No type.<br>";
			else{
				$invalid_type = true;
				$types = "";
				foreach($this->db->get('question_types')->result() as $row){
					if($questions[$i]['type'] == $row->type)
						$invalid_type = false;
					else
						$types .= $row->type.", ";
				}
				if($invalid_type) $current_error .= "C".($i+1)." - Invalid type. Valid types: ".substr($types,0,-2)."<br> ";
			}
			//trim leading blank cells per row
			$trim = true;
			$ctr = count($questions[$i])-4;
			
			while($trim && $ctr>0){
				if($questions[$i][$ctr] == " " && $questions[$i][$ctr-1] == " ")
					$ctr -= 2;
				else
					$trim = false;		
			}
			//option validation
			for($j=0; $j<$ctr+1; $j+=2){
				if($questions[$i][$j] == " ")
					$current_error .= strtoupper(chr($j + 100)).($i+1).$questions[$i][$j]." - No option. <br>";
				
				if($questions[$i][$j+1] == " ")
					$current_error .= strtoupper(chr($j + 101)).($i+1)." - No score. <br>";
				else if(!is_numeric($questions[$i][$j+1]))
					$current_error .= strtoupper(chr($j + 101)).($i+1)." - Score must be an integer. <br>";	
			}
			//check if there are only two options (T and F only) in the True or False question
			$true_false_error = false;
			if($questions[$i]['type']=="True or False"){
				if($ctr > 3)
					$true_false_error = true;
				else if(!(($questions[$i][0] == "T" && $questions[$i][2] == "F") || ($questions[$i][2] == "T" && $questions[$i][0] == "F")))
					$true_false_error = true;
			}
			else if($questions[$i]['type']=="Fill in the Blanks"){
				if($ctr <= 0)
					$current_error .= "There must be at least one option. <br>";
			}
			else if($ctr <= 3){
				$current_error .= "There must be at least two options. <br>";
			}	
			
			if($true_false_error)
				$current_error .= "There must only be two options (T and F) in the True or False question. <br>";
			
			if($current_error != "")
				$current_error = "Row ".($i+1).":<br>".$current_error."<br>";

			$error .= $current_error;
		}
		if($error != "")
			$error = "Please check your file for the following errors:<br><br>".$error;
		return $error;
	}
	
	function insert_questions($questions){
		for($i=0; isset($questions[$i]['question']); $i++){
			$question = array(
					'question' => "<p>".$questions[$i]['question']."</p>",
					'category' => $questions[$i]['category'],
					'type' => $questions[$i]['type']
					);
			$this->db->insert('questions',$question);
			$question_id = intval($this->db->insert_id());
			$type = $questions[$i]['type'];
			
			
			for($j=0; isset($questions[$i][$j]); $j+=2){
				if($questions[$i][$j] != " "){
					$answer=array(
							'question_id' => $question_id,
							'score' => $questions[$i][$j+1]
						);
					if($type == "True or False")
						$answer['option'] = ($questions[$i][$j]=="T")? "True":"False";
					else if($type == "Fill in the Blanks")
						$answer['option'] = $questions[$i][$j];
					else
						$answer['option'] = "<p>".$questions[$i][$j]."</p>";
					
					$this->db->insert('options', $answer);
				}	
			}
		}
	}
}