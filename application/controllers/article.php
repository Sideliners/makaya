<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index($collection_id=NULL, $article_id=NULL, $article_name=NULL){		
		if (!$this->exists("article", $article_id, $article_name)) redirect(base_url());

		$article = $this->mod_article->get_article($article_id);

		if ($article->article_type == "product") {
			$object = $this->mod_article->get_article_product($article_id);
		}
		else if ($article->article_type == "artisan") {
			$object = $this->mod_article->get_article_artisan($article_id);
		}
		else if ($article->article_type == "enterprise") {
			$object = $this->mod_article->get_article_enterprise($article_id);
		}
		
		if (!isset($object)) redirect(base_url());
		
		$clean_name = $this->clean_string($object->name);
		$url = site_url("{$article->article_type}/{$collection_id}/{$object->id}/{$clean_name}");
		redirect($url);
	}
}
