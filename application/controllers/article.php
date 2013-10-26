<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index($id=NULL, $name=NULL){
		if (!$this->exists("article", $id, $name)) {
			redirect(site_url());
		}		
		
		$article = $this->mod_article->getArticle($id);		
		
		if ($article->article_type == "product") {
			$product = $this->mod_product->getArticleProduct($id);
			$url_id = $product->product_id;
			$url_name = $this->clean_string($product->product_name);			
		}
		else if ($article->article_type == "artisan") {
			$artisan = $this->mod_artisan->getArticleArtisan($id);
			$url_id = $artisan->artisan_id;
			$url_name = $this->clean_string($artisan->artisan_name);			
		}
		else if ($article->article_type == "enterprise") {
			$enterprise = $this->mod_enterprise->getArticleEnterprise($id);
			$url_id = $enterprise->enterprise_id;
			$url_name = $this->clean_string($enterprise->enterprise_name);			
		}
		
		if (empty($url_id) && empty($url_name)) {
			redirect(site_url());
		}
		
		$url = site_url("{$article->article_type}/{$url_id}/{$url_name}" );
		redirect($url);
	}
	
	public function view($id=NULL, $name=NULL) {
		$pagedata['page_title'] = 'Article';
		$pagedata['page'] = 'Article';
		
		$article = $this->mod_article->getArticle($id);
		$article->theme = $this->mod_article->getArticleTheme($id);
		$pagedata['article'] = $article;
		
        $contentdata['script'] = array('article');
        $contentdata['page'] = $this->load->view('page/article', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}	
}