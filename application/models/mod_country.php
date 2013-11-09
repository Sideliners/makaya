<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_country extends CI_Model{
	
	private $country = 'country';
	
	function get_countries(){		
		$this->db->cache_off();
		$query = $this->db->get($this->country);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
}