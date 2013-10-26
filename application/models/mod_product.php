<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_product extends CI_Model{
	
	private $product = 'product';
	private $product_album = 'product_album';
	private $collection = 'collection';
	private $collection_product = 'collection_product';
	private $article = 'article';
	private $artisan_product = 'artisan_product';
	private $artisan = 'artisan';
	private $artisan_album = 'artisan_album';
	private $enterprise_artisan = 'enterprise_artisan';
	private $enterprise = 'enterprise';
	private $enterprise_album = 'enterprise_album';

	function getProductList() {
		/* Returns a list of all active products */

		$this->db->cache_off();
		$this->db->select(
			"{$this->product}.product_id AS id, " .
			"{$this->product}.product_name AS name, " .
			"{$this->product_album}.product_image AS image_name, " 
		);
		$this->db->from($this->product);
        $this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");

		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->product_album}.is_primary", 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function getProductDetails($id=NULL){
		/* Returns all columns of joined table 
			product_category, product, artisan, enterprise, article, category
			where product, artisan, enterprise, article must be active
		
        SELECT * 
        FROM collection
        JOIN article ON collection.collection_id = article.collection_id
        JOIN product ON article.article_id = product.article_id
        JOIN artisan_product ON product.product_id = artisan_product.product_id
        JOIN artisan ON artisan.artisan_id = artisan_product.artisan_id
        JOIN enterprise_artisan ON enterprise_artisan.artisan_id = artisan.artisan_id
        JOIN enterprise ON enterprise.enterprise_id = enterprise_artisan.enterprise_id
        WHERE 
            product_status =1
            AND artisan_status =1
            AND enterprise_status =1
            AND is_highlighted =1
		*/
		
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

		$this->db->where("{$this->product}.product_status", 1);
		$this->db->where("{$this->artisan}.artisan_status", 1);
		$this->db->where("{$this->enterprise}.enterprise_status", 1);
		$this->db->where("{$this->article}.article_status", 1);
		$this->db->order_by("{$this->product}.is_highlighted", "desc");

		if (!is_null($id)) {
			$this->db->where("{$this->product}.product_id", $id);
            $this->db->order_by("{$this->collection_product}.date_added DESC");
		}
		
		$query = $this->db->get();

		return $query->row();
	}
	
	function productExists($id, $name) {
		$this->db->cache_off();
		
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->like('product_name', $name);
		$this->db->where('product_id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
	
	function getArticleProduct($article_id=NULL) {
		$this->db->cache_off();
		
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");		
		$this->db->where("article_id", $article_id);
		$this->db->where("product_status", 1);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	function search_products($str, $offset = NULL, $limit = NULL){
		$this->db->select('*');
		$this->db->from($this->product);
		$this->db->join($this->product_album, "{$this->product_album}.product_id = {$this->product}.product_id");
		$this->db->like('product_name', $str);
		$this->db->where('product_status', 1);
		$this->db->where('is_primary', 1);
		
		if(!is_null($offset) && !is_null($limit)){
			$this->db->limit($limit, $offset);
		}
		
		$this->db->cache_off();
		
		$query = $this->db->get();
		
		return $query->result();
	}
	
## old
	function getCategoryProducts($category_id) {
		/* Returns a list of product_id's of specified $category_id */
		$this->db->where('category_id', $category_id);
	
		$this->db->cache_off();
		$query = $this->db->get($this->prod_cat);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}	
	
	function getProduct($id) {
		/* Returns a row of active product $id */
		$this->db->where('product_id', $id);
		$this->db->where('product_status', 1);
		
		$this->db->cache_off();
		$query = $this->db->get($this->product);
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
}
