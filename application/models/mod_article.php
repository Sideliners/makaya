<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_article extends CI_Model{
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $article = 'article';
	private $article_type = 'article_type';
	private $collection = 'collection';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';		
	private $product = 'product';
	private $product_album = 'product_album';
	private $user = 'user';
	
	function get_article($article_id) {
		$this->db->cache_off();		
		$this->db->select("*");
		$this->db->from($this->article);
		$this->db->join($this->article_type, "{$this->article_type}.article_type_id = {$this->article}.article_type_id");
		$this->db->join($this->user, "{$this->user}.user_id = {$this->article}.user_id");		
		$this->db->where("article_id", $article_id);
		$this->db->where("article_status", 1);
				
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
				
	function get_article_product($article_id=NULL) {
		$this->db->cache_off();		
		$this->db->select("{$this->product}.product_id AS id, {$this->product}.product_name AS name");
		$this->db->from($this->product);
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->where("article_id", $article_id);
		$this->db->where("product_status", 1);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
			
	function get_article_artisan($article_id=NULL) {
		$this->db->cache_off();		
		$this->db->select("{$this->artisan}.artisan_id AS id, {$this->artisan}.artisan_name AS name");
		$this->db->from($this->artisan);
		$this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id");
		$this->db->where("article_id", $article_id);
		$this->db->where("artisan_status", 1);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function get_article_enterprise($article_id=NULL) {
		$this->db->cache_off();		
		$this->db->select("{$this->enterprise}.enterprise_id AS id, {$this->enterprise}.enterprise_name AS name");
		$this->db->from($this->enterprise);
		$this->db->join($this->enterprise_album, "{$this->enterprise_album}.enterprise_id = {$this->enterprise}.enterprise_id");
		$this->db->where("article_id", $article_id);
		$this->db->where("enterprise_status", 1);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function article_exists($article_id, $article_name) {
		$this->db->cache_off();		
		$this->db->select('*');
		$this->db->from($this->article);
		$this->db->like('article_title', $article_name);
		$this->db->where('article_id', $article_id);
		
		$query = $this->db->get();		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
}
