<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_feedback extends CI_Model{	
	private $feedback = 'feedback';
	
	function create_feedback($data){		
		$this->db->insert($this->feedback, $data);
		
		return $this->db->insert_id();
	}
	
	function get_feedbacks(){
		$this->db->cache_off();
		$this->db->order_by('date_added','desc');
		
		$query = $this->db->get($this->feedback);
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
}