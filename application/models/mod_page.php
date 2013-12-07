<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_page extends CI_Model{
	private $page = 'page';
	
	function get(){
		$query = $this->db->get_where($this->page, array('page_status' => 1));
		
		if($query->num_rows() > 0) return $query->result();
		
		return FALSE;
	}
	
	function getBody($slug){
		$query = $this->db->get_where($this->page, array('page_uri' => $slug, 'page_status' => 1));
		
		if($query->num_rows() > 0) return $query->row();
		
		return FALSE;
	}
}