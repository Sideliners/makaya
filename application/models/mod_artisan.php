<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_artisan extends CI_Model{
	
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $collection = 'collection';
	private $article = 'article';
	private $artisan_product = 'artisan_product';
	private $product = 'product';
	private $product_album = 'product_album';
	private $enterprise_artisan = 'enterprise_artisan';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';

	function getArtisanList() {
		/* Returns a list of all active artisans */
	
		$this->db->cache_off();
		$this->db->select(
			"{$this->artisan}.artisan_id AS id, " .
			"{$this->artisan}.artisan_name AS name, " .
			"{$this->artisan_album}.artisan_image AS image_name, " 
		);
		$this->db->from($this->artisan);
        $this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");

		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->artisan_album}.is_primary", 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function getArtisanDetails($id=NULL){

        $this->db->select('*');
        $this->db->from($this->collection);
        $this->db->join($this->article, "{$this->article}.collection_id = {$this->collection}.collection_id");
		$this->db->join($this->artisan, "{$this->artisan}.article_id = {$this->article}.article_id");
		$this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");        
		$this->db->join($this->artisan_product, "{$this->artisan_product}.artisan_id = {$this->artisan}.artisan_id");        
        $this->db->join($this->product, "{$this->product}.product_id = {$this->artisan_product}.product_id");
        $this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->join($this->enterprise_artisan, "{$this->enterprise_artisan}.artisan_id = {$this->artisan}.artisan_id");
		$this->db->join($this->enterprise, "{$this->enterprise}.enterprise_id = {$this->enterprise_artisan}.enterprise_id");
		$this->db->join($this->enterprise_album, "{$this->enterprise_album}.enterprise_id = {$this->enterprise}.enterprise_id");
		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->enterprise}.enterprise_status", 1);
		$this->db->where("{$this->article}.article_status", 1);
		$this->db->where("{$this->artisan}.artisan_id", $id);

		$query = $this->db->get();
		
		return $query->row();
	}
	
	function getArtisan($id) {
		/* Returns a row of active artisan $id */
		$this->db->where('artisan_id', $id);
		$this->db->where('artisan_status', 1);
		
		$this->db->cache_off();
		$query = $this->db->get($this->artisan);
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}	
	
	function artisanExists($id, $name) {
		$this->db->cache_off();
		
		$this->db->select('*');
		$this->db->from($this->artisan);
		$this->db->like('artisan_name', $name);
		$this->db->where('artisan_id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}	
	
	function getArticleArtisan($article_id=NULL) {
		$this->db->cache_off();
		
		$this->db->select('*');
		$this->db->from($this->artisan);
		$this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");		
		$this->db->where("article_id", $article_id);
		$this->db->where("artisan_status", 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
}
