<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_collection extends CI_Model{
	
	private $collection = 'collection';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $product = 'product';
	private $product_album = 'product_album';
	private $article = 'article';
	private $article_type = 'article_type';
	
	function getCollectionCarousel($id) {
		/*
		SELECT * 
		FROM article
		LEFT JOIN enterprise ON article.article_id = enterprise.article_id
		LEFT JOIN artisan ON article.article_id = artisan.article_id
		LEFT JOIN product ON article.article_id = product.article_id
		JOIN collection ON collection.collection_id = article.collection_id
		WHERE
			collection.collection_id = $id
		*/
		$this->db->cache_off();
		
		$this->db->select("*");
		$this->db->from($this->article);
		$this->db->join($this->article_type, "{$this->article_type}.article_type_id = {$this->article}.article_type_id");
		$this->db->join($this->enterprise, "{$this->article}.article_id = {$this->enterprise}.article_id", "left");
		$this->db->join($this->enterprise_album, "{$this->enterprise_album}.enterprise_id = {$this->enterprise}.enterprise_id", "left");
		$this->db->join($this->artisan, "{$this->article}.article_id = {$this->artisan}.article_id", "left");
		$this->db->join($this->artisan_album, "{$this->artisan_album}.artisan_id = {$this->artisan}.artisan_id", "left");
		$this->db->join($this->product, "{$this->article}.article_id = {$this->product}.article_id","left");
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id","left");
		$this->db->join($this->collection, "{$this->collection}.collection_id = {$this->article}.collection_id");

		$this->db->where("{$this->collection}.collection_id", $id);

		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function getCollectionId($type=NULL, $id=NULL) {
		$this->db->cache_off();
		
		$this->db->select("*");
		$this->db->from($this->article);
		$this->db->join($this->enterprise, "{$this->article}.article_id = {$this->enterprise}.article_id", "left");		
		$this->db->join($this->artisan, "{$this->article}.article_id = {$this->artisan}.article_id", "left");		
		$this->db->join($this->product, "{$this->article}.article_id = {$this->product}.article_id","left");		
		$this->db->join($this->collection, "{$this->collection}.collection_id = {$this->article}.collection_id");
				
		if ($type == "product") {
			$this->db->where("{$this->product}.product_id", $id);
		}
		else if ($type == "artisan") {
			$this->db->where("{$this->artisan}.artisan_id", $id);
		}
		else if ($type == "enterprise") {
			$this->db->where("{$this->enterprise}.enterprise_id", $id);
		}
				
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row()->collection_id;
		
		return FALSE;
	}
	
	function getCollectionList() {
		$this->db->where('collection_status', '1');
		
		$this->db->cache_off();
		$query = $this->db->get($this->collection);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
}
