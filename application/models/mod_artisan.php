<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_artisan extends CI_Model{
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $artisan_product = 'artisan_product';
	private $article = 'article';
	private $collection = 'collection';
	private $collection_artisan = 'collection_artisan';	
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';
	private $enterprise_artisan = 'enterprise_artisan';
	private $product = 'product';
	private $product_album = 'product_album';

	function get_artisan_details($collection_id=NULL, $artisan_id=NULL){
		$this->db->cache_off();
        $this->db->select('*');
        $this->db->from($this->collection);
        $this->db->join($this->collection_artisan, "{$this->collection_artisan}.collection_id = {$this->collection}.collection_id");
		$this->db->join($this->artisan, "{$this->artisan}.artisan_id = {$this->collection_artisan}.artisan_id");
        $this->db->join($this->article, "{$this->article}.article_id = {$this->artisan}.article_id");
		$this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");        
		$this->db->join($this->artisan_product, "{$this->artisan_product}.artisan_id = {$this->artisan}.artisan_id");        
        $this->db->join($this->product, "{$this->product}.product_id = {$this->artisan_product}.product_id");
        $this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->join($this->enterprise_artisan, "{$this->enterprise_artisan}.artisan_id = {$this->artisan}.artisan_id");
		$this->db->join($this->enterprise, "{$this->enterprise}.enterprise_id = {$this->enterprise_artisan}.enterprise_id");
		$this->db->join($this->enterprise_album, "{$this->enterprise_album}.enterprise_id = {$this->enterprise}.enterprise_id");
		$this->db->where("{$this->collection}.collection_status", 1);
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->enterprise}.enterprise_status", 1);
		$this->db->where("{$this->article}.article_status", 1);
		$this->db->where("{$this->artisan}.artisan_id", $artisan_id);
		$this->db->where("{$this->collection}.collection_id", $collection_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function get_artisan($artisan_id) {
		$this->db->cache_off();
		$this->db->where('artisan_id', $artisan_id);
		$this->db->where('artisan_status', 1);
		
		$query = $this->db->get($this->artisan);		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}	
	
	function artisan_exists($artisan_id, $artisan_name) {
		$this->db->cache_off();		
		$this->db->select('*');
		$this->db->from($this->artisan);
		$this->db->where('artisan_id', $artisan_id);
		$this->db->like('artisan_name', $artisan_name);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
}
