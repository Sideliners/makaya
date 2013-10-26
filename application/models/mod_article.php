<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_article extends CI_Model{

	private $article = 'article';
	private $article_type = 'article_type';
	private $user = 'user';	
	private $collection = 'collection';

	private $product = 'product';
	private $artisan = 'artisan';
	private $enterprise = 'enterprise';
	
	function getCollectionArticles($collection_id) {
		/* Returns a list of article_id's of specified $collection_id */
		#$this->db->where('collection_id', $collection_id);
	
		$this->db->cache_off();
		$query = $this->db->get($this->article);
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return FALSE;
	}
	
	function articleExists($id, $name) {
		$this->db->cache_off();
		
		$this->db->select('*');
		$this->db->from($this->article);
		$this->db->like('article_title', $name);
		$this->db->where('article_id', $id);
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return TRUE;
		
		return FALSE;
	}
	
	function getArticle($id) {
		$this->db->cache_off();
		
		$this->db->select("*");
		$this->db->from($this->collection);
		$this->db->join($this->article, "{$this->article}.collection_id = {$this->collection}.collection_id");
		$this->db->join($this->article_type, "{$this->article_type}.article_type_id = {$this->article}.article_type_id");
		$this->db->join($this->user, "{$this->user}.user_id = {$this->article}.user_id");		
		$this->db->where("article_id", $id);
		$this->db->where("article_status", 1);
				
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->row();
		
		return FALSE;
	}
	
	
	## old
	
	function getArticleTheme($article_id) {
		/* Returns theme of specified $article_id */
		
		$this->db->select($this->theme.'.*');
		$this->db->from($this->article_theme);
		$this->db->join($this->theme, $this->theme.'.theme_id = '.$this->article_theme.'.theme_id', 'right');
		$this->db->where($this->theme.'.theme_status', 1);
		$this->db->where($this->article_theme.'.article_id', $article_id);

		$this->db->cache_off();
		$query = $this->db->get();
		
		return $query->row();	
	}
	

	function getProductArticle($id=NULL) {
		/* 
		Returns an instance of article of a product
		
		SELECT *
		FROM category
		RIGHT JOIN product_category ON(category.category_id = product_category.category_id)
		RIGHT JOIN product ON(product_category.product_id = product.product_id)
		RIGHT JOIN article ON(product.article_id = article.article_id)
		WHERE
			article.status = 1
			AND category.category_status = 1
			AND product.product_status = 1
			AND user.user_status = 1
			AND product.product_id = 1;	
		*/
		
		$this->db->select(
			$this->category.'.category_name, '
			.$this->product.'.product_name AS name, '
			.$this->product.'.primary_image AS image, '
			.$this->article.'.title, '
			.$this->article.'.body, '
			.$this->article.'.date_created, '
			.$this->article.'.last_modified, '
			.$this->user.'.user_email, '
			.$this->user.'.firstname, '
			.$this->user.'.lastname'
		);
		$this->db->from($this->category);
		$this->db->join($this->prod_cat, $this->prod_cat.'.category_id = '.$this->category.'.category_id', 'right');		
		$this->db->join($this->product, $this->product.'.product_id = '.$this->prod_cat.'.product_id', 'right');
		$this->db->join($this->article, $this->article.'.article_id = '.$this->product.'.article_id', 'right');
		$this->db->join($this->user, $this->user.'.user_id = '.$this->article.'.user_id', 'right');

		$this->db->where($this->article.'.status', 1);		
		$this->db->where($this->category.'.category_status', 1);
		$this->db->where($this->product.'.product_status', 1);
		$this->db->where($this->user.'.user_status', 1);
		$this->db->where($this->product.'.product_id', $id);

		$this->db->cache_off();
		$query = $this->db->get();
		
		return $query->row();	
	}

	function getArtisanArticle($id=NULL) {
		/* 
		Returns an instance of article of an artisan
		
		SELECT *
		FROM category
		RIGHT JOIN product_category ON(category.category_id = product_category.category_id)
		RIGHT JOIN product ON(product_category.product_id = product.product_id)
		RIGHT JOIN artisan ON(artisan.artisan_id = product.artisan_id)
		RIGHT JOIN article ON(product.article_id = article.article_id)
		WHERE
			article.status = 1
			AND category.category_status = 1
			AND product.product_status = 1
			AND artisan.artisan_status = 1			
			AND user.user_status = 1
			AND product.product_id = 1;	
		*/
		
		$this->db->select(
			$this->category.'.category_name, '
			.$this->product.'.product_name AS name, '
			.$this->product.'.primary_image AS image, '
			.$this->article.'.title, '
			.$this->article.'.body, '
			.$this->article.'.date_created, '
			.$this->article.'.last_modified, '
			.$this->user.'.user_email, '
			.$this->user.'.firstname, '
			.$this->user.'.lastname'
		);
		$this->db->from($this->category);
		$this->db->join($this->prod_cat, $this->prod_cat.'.category_id = '.$this->category.'.category_id', 'right');		
		$this->db->join($this->product, $this->product.'.product_id = '.$this->prod_cat.'.product_id', 'right');
		$this->db->join($this->artisan, $this->artisan.'.artisan_id = '.$this->product.'.artisan_id', 'right');
		$this->db->join($this->article, $this->article.'.article_id = '.$this->artisan.'.article_id', 'right');
		$this->db->join($this->user, $this->user.'.user_id = '.$this->article.'.user_id', 'right');

		$this->db->where($this->article.'.status', 1);		
		$this->db->where($this->category.'.category_status', 1);
		$this->db->where($this->product.'.product_status', 1);
		$this->db->where($this->artisan.'.artisan_status', 1);
		$this->db->where($this->user.'.user_status', 1);
		$this->db->where($this->artisan.'.artisan_id', $id);

		$this->db->cache_off();
		$query = $this->db->get();
		
		return $query->row();	
	}
	
	function getEnterpriseArticle($id=NULL) {
		/* 
		Returns an instance of article of an enterprise
		
		SELECT *
		FROM category
		RIGHT JOIN product_category ON(category.category_id = product_category.category_id)
		RIGHT JOIN product ON(product_category.product_id = product.product_id)
		RIGHT JOIN artisan ON(artisan.artisan_id = product.artisan_id)
		RIGHT JOIN enterprise ON(enterprise.enterprise_id = artisan.enterprise_id)
		RIGHT JOIN article ON(product.article_id = article.article_id)
		WHERE
			article.status = 1
			AND category.category_status = 1
			AND product.product_status = 1
			AND artisan.artisan_status = 1
			AND enterprise.enterprise_status = 1			
			AND user.user_status = 1
			AND product.product_id = 1;	
		*/
		
		$this->db->select(
			$this->category.'.category_name, '
			.$this->product.'.product_name AS name, '
			.$this->product.'.primary_image AS image, '
			.$this->article.'.title, '
			.$this->article.'.body, '
			.$this->article.'.date_created, '
			.$this->article.'.last_modified, '
			.$this->user.'.user_email, '
			.$this->user.'.firstname, '
			.$this->user.'.lastname'
		);
		$this->db->from($this->category);
		$this->db->join($this->prod_cat, $this->prod_cat.'.category_id = '.$this->category.'.category_id', 'right');		
		$this->db->join($this->product, $this->product.'.product_id = '.$this->prod_cat.'.product_id', 'right');
		$this->db->join($this->artisan, $this->artisan.'.artisan_id = '.$this->product.'.artisan_id', 'right');
		$this->db->join($this->enterprise, $this->enterprise.'.enterprise_id = '.$this->artisan.'.enterprise_id', 'right');
		$this->db->join($this->article, $this->article.'.article_id = '.$this->enterprise.'.article_id', 'right');
		$this->db->join($this->user, $this->user.'.user_id = '.$this->article.'.user_id', 'right');

		$this->db->where($this->article.'.status', 1);		
		$this->db->where($this->category.'.category_status', 1);
		$this->db->where($this->product.'.product_status', 1);
		$this->db->where($this->artisan.'.artisan_status', 1);
		$this->db->where($this->enterprise.'.enterprise_status', 1);
		$this->db->where($this->user.'.user_status', 1);
		$this->db->where($this->enterprise.'.enterprise_id', $id);

		$this->db->cache_off();
		$query = $this->db->get();
		
		return $query->row();
	}
}
