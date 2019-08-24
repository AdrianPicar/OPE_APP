<?php
class M_Questions extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    
    function search_questions($substring){
    	$this->db->select("*");
    	$this->db->from("questions");
    	$this->db->like('question', $substring);

    	$result['result'] = $this->db->get();
    	$result['num_rows'] = $result['result']->num_rows();
    	
    	return $result;
    }
    
    //for deletion
    function get_questions_test($limit, $offset){
    	$result['num_rows'] = $this->db->get('questions')->num_rows();
    	$this->db->limit($limit, $offset);
    	$result['result'] = $this->db->get('questions');
    	
    	return $result;
    }
    
    function delete_question($id){
    	$tables = array('questions', 'options');
    	$this->db->where('question_id', $id);
		$this->db->delete($tables); 
    }
    
    function get_question_type($id){
    	$this->db->select('type');
    	$this->db->from('questions');
    	$this->db->where('question_id', $id);
    	$result = $this->db->get();
    	foreach($result->result() as $row)
    		return $row->type;
    }
    
    public function get_category_questions($category){
    	$this->load->model('m_categories');
    	
    	$this->db->select('*');
    	$this->db->from('questions');
    	if($category != "All")
    		$this->db->where('category', $category);
    
    	return $this->db->get();
    }
    
    public function get_category_questions_exam($index){
    	$this->load->model('m_categories');
    	   
    	$category = $this->m_categories->get_category_detail($index, 'category');
    	$no_items = $this->m_categories->get_category_detail($index, 'no_items');;
    	
    	$this->db->order_by('question_id', 'random');
    	$this->db->select('*');
   	 	$this->db->from('questions');
   	 	$this->db->where('category', $category);
   	 	$this->db->limit($no_items);
   	 	
        return $this->db->get();
    }
    
    function get_no_questions(){
    	$this->db->select("b.category, count(a.question) as count");
    	$this->db->from("questions a");
    	$this->db->join("categories b", "a.category = b.category", "right");
    	$this->db->group_by("category");
    	
    	return $this->db->get();
    }
    
    public function get_question_options($id){
    	$this->db->where('question_id', $id);
    	return $this->db->get('options');
    }
    
    public function get_question($id){
    	$this->db->where('question_id', $id);
    	return $this->db->get('questions');
    }
    
    public function get_all_questions(){
    	return $this->db->get('questions');
    }
    
    function get_options(){
    	return $this->db->get('options');
    }
    
    function get_options_random(){
    	$this->db->order_by('option_id', 'random');
    	return $this->db->get('options');
    }
    
    function get_option($id){
    	$this->db->where("option_id", $id);
    	foreach($this->db->get("options")->result() as $row)
    		return $row->option;
    }
    
    function update_question($data, $id){
    	$this->db->where('question_id', $id);
		$this->db->update('questions', $data); 
    }
    
    function delete_options($id){
    	$this->db->where('question_id', $id);
		$this->db->delete('options'); 
    }

    function rapmasa($id){
    	
    /*	$this->db->select("question_id");
    	$this->db->from("options");
    	$this->db->where_in("option_id", $id);*/
    //	$result = $this->db->get();
    	
    	$this->db->select('(SELECT question_id FROM options WHERE option_id = ".$id)', FALSE);
    	//$this->db->from("questions");
    	//$this->db->where("question_id", $result);
    	foreach($this->db->get("questions")->result() as $row){
    		echo $row->question_id;
    		echo $row->question;
    	}
    }
}