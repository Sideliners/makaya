<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index($id=NULL, $name=NULL){
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