<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_product extends CI_Model{	
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $artisan_product = 'artisan_product';
	private $article = 'article';
	private $collection = 'collection';
	private $collection_product = 'collection_product';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';
	private $enterprise_artisan = 'enterprise_artisan';	
	private $product = 'product';
	private $product_album = 'product_album';
	
	function get_highlighted_product() {
		$this->db->cache_off();
		$this->db->from($this->collection);
        $this->db->join($this->collection_product, "{$this->collection_product}.collection_id = {$this->collection}.collection_id");
        $this->db->join($this->product, "{$this->product}.product_id = {$this->collection_product}.product_id");
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->product}.is_highlighted", 1);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function get_product_details($collection_id=NULL, $product_id=NULL){
		$this->db->cache_off();
        $this->db->select('*');
        $this->db->from($this->collection);
        $this->db->join($this->collection_product, "{$this->collection_product}.collection_id = {$this->collection}.collection_id");
        $this->db->join($this->product, "{$this->product}.product_id = {$this->collection_product}.product_id");
        $this->db->join($this->article, "{$this->article}.article_id = {$this->product}.article_id");
        $this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->join($this->artisan_product, "{$this->artisan_product}.product_id = {$this->product}.product_id");
        $this->db->join($this->artisan, "{$this->artisan}.artisan_id = {$this->artisan_product}.artisan_id");
        $this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");
		$this->db->join($this->enterprise_artisan, "{$this->enterprise_artisan}.artisan_id = {$this->artisan}.artisan_id");
		$this->db->join($this->enterprise, "{$this->enterprise}.enterprise_id = {$this->enterprise_artisan}.enterprise_id");
		$this->db->join($this->enterprise_album, "{$this->enterprise_album}.enterprise_id = {$this->enterprise}.enterprise_id");
		$this->db->where("{$this->collection}.collection_status", 1);
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->enterprise}.enterprise_status", 1);
		$this->db->where("{$this->article}.article_status", 1);
		$this->db->where("{$this->product_album}.is_primary", 1);
		$this->db->where("{$this->artisan_album}.is_primary", 1);
		$this->db->where("{$this->enterprise_album}.is_primary", 1);
		$this->db->where("{$this->product}.product_id", $product_id);
		$this->db->where("{$this->collection}.collection_id", $collection_id);
				
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row();

		return FALSE;
	}
	
	function get_product($product_id) {
		$this->db->cache_off();
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->product_album}.is_primary", 1);
		$this->db->where("{$this->product}.product_id", $product_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function product_exists($product_id, $product_name) {
		$this->db->cache_off();
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->where('product_id', $product_id);
		$this->db->like('product_name', $product_name);
				
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
	
	function get_collection_products($collection_id=NULL) {
		$this->db->cache_off();
        $this->db->select('*');
        $this->db->from($this->collection);
        $this->db->join($this->collection_product, "{$this->collection_product}.collection_id = {$this->collection}.collection_id");
        $this->db->join($this->product, "{$this->product}.product_id = {$this->collection_product}.product_id");
        $this->db->join($this->article, "{$this->article}.article_id = {$this->product}.article_id");
        $this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->where("{$this->collection}.collection_status", 1);
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->product_album}.is_primary", 1);
		$this->db->where("{$this->article}.article_status", 1);
		$this->db->where("{$this->collection}.collection_id", $collection_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function search_products($str, $offset = NULL, $limit = NULL){
		$this->db->cache_off();
		$this->db->select('*');
        $this->db->from($this->collection);
        $this->db->join($this->collection_product, "{$this->collection_product}.collection_id = {$this->collection}.collection_id");
        $this->db->join($this->product, "{$this->product}.product_id = {$this->collection_product}.product_id");
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->like("{$this->product}.product_name", $str);
		$this->db->where("{$this->collection}.collection_status", 1);
		$this->db->where('product_status', 1);
		$this->db->where('is_primary', 1);
		
		if(!is_null($offset) && !is_null($limit)){
			$this->db->limit($limit, $offset);
		}
		
        $query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
}
