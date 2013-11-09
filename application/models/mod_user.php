<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_user extends CI_Model{
	
	private $user = 'user';
	
	function getUser($email, $password = NULL, $is_member = NULL){
		$this->db->where('user_email', $email);
		
		if(!is_null($password)){
			$this->db->where('user_password', $password);
		}
		
		if(!is_null($is_member)){
			$this->db->where('user_type', 4);
		}
		
		$this->db->cache_off();
		$query = $this->db->get($this->user);
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function create_user($data){
		$this->db->insert($this->user, $data);
		
		return $this->db->insert_id();
	}
	
	
	function update_user($id, $data){
		$this->db->where('user_id', $id);
		
		return $this->db->update($this->user, $data);		
	}
	
	function checkOldPassword($id, $password){
		$this->db->where('user_id', $id);
		
		$this->db->cache_off();
		$query = $this->db->get($this->user);
		
		if($query->num_rows() > 0) {
			if($query->row()->user_password == $this->encrypt->sha1($password))
				return TRUE;
		}
		
		return FALSE;		
	}
	
	function getUserDetails($email){
		$this->db->where('user_email', $email);
		
		$this->db->cache_off();
		$query = $this->db->get($this->user);
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	
}