<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	
	protected $_user;
	
    function __construct(){
        parent::__construct();

    }

    function templateLoader($contentdata){
		if($this->session->userdata('email')){
			if($this->_getUserDetails($this->session->userdata('email'))){
				$navdata['user']['email'] = $this->session->userdata('email');
				$navdata['user']['fname'] = $this->_user->firstname;
			}
		}

        $navdata['site_title'] = $this->site_name();
		$navdata['pinterest'] = (object)$this->pinterest_params($this->uri->segment(1), intval($this->uri->segment(2)));
		$navdata['twitterPost'] = $this->twitter_params($this->uri->segment(1), intval($this->uri->segment(2)));
		
		$backbonedata['backbone'] = $this->getBackboneList();
		
		$script = array_pop(array_reverse($contentdata));
		
        $templatedata['metatags'] = $this->meta_data($this->uri->segment(1), intval($this->uri->segment(2)));

        $templatedata['scripts'] = $this->page_script($script);
		$templatedata['modals'] = $this->load->view('template/modals', NULL, TRUE);
        $templatedata['header_elements'] = $this->header_elements();
        $templatedata['navigation'] = $this->load->view('partials/navigation', $navdata, TRUE);
        $templatedata['sidemenu'] = $this->load->view('partials/sidemenu', $navdata, TRUE);
        $templatedata['content'] = $this->load->view('template/content', $contentdata, TRUE);
		$templatedata['backbone'] = $this->load->view('partials/backbone', $backbonedata, TRUE);

        $this->load->view('template/main', $templatedata);
    }
	
	private function get_product($id){
		$product = $this->mod_product->getProductDetails();
		
		return $product;
	}
	
	private function pinterest_params($page, $id){
		if($page == 'product'){
			$product = $this->get_product($id);
			$pinterest_params = array(
				'url' => current_url(),
				'media' => $this->config->item('image_product_path').$product->product_image,
				'description' => strip_tags($product->product_description)
			);
		}
		else{
			$pinterest_params = array(
				'url' => current_url(),
				'media' => 'logo',
				'description' => 'We are makaya'
			);
		}
		
		return $pinterest_params;
	}
	
	private function twitter_params($page, $id){
		if($page == 'product'){
			$product = $this->get_product($id);
			$description = strip_tags($product->product_description);
			
			$post = "{$product->product_name} &mdash; {$description}\n";
		}
		else{
			$post = $this->config->item('sitename')." &mdash; We are makaya\n";
		}
		
		return $post;
	}
	
	private function meta_data($page, $id){
		$meta = "<meta property='fb:app_id' content='176244019234035' />\n\t";
		
		 if($page == 'product'){
			$product = $this->get_product($id);
			$image = $this->config->item('image_product_path').$product->product_image;
			$description = strip_tags($product->product_description);
			
			$meta.= "<meta property='og:url' content='".current_url()."' />\n\t";
			$meta.= "<meta property='og:type' content='website' />\n\t";
			$meta.= "<meta property='og:description' content='".strip_tags($description)."' />\n\t";
			$meta.= "<meta property='og:title' content='{$product->product_name}' />\n\t";
			$meta.= "<meta property='og:image' content='{$image}' />\n\n";
        }
		else{
			$meta.= "<meta property='og:url' content='".current_url()."' />\n\t";
			$meta.= "<meta property='og:type' content='website' />\n\t";
			$meta.= "<meta property='og:description' content='We Are makaya' />\n\t";
			$meta.= "<meta property='og:title' content='".$this->config->item('sitename')."' />\n\t";
			//$meta.= "<meta property='og:image' content='logo' />\n\n";
		}
		
		return $meta;
	}

    function site_name(){
        $title = $this->config->item('sitename');
        return $title;
    }

    function _paginate($url, $total_rows, $per_page, $uri){
        $this->load->library('pagination');

        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['full_tag_open'] = '<ul>';
        $config['cur_tag_open'] = '<li class="active"><a>';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['full_tag_close'] = '</u>';
		$config['uri_segment'] = $uri;

        $this->pagination->initialize($config); 

        return $this->pagination->create_links();
    }
	
	function validate_email($email){
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		
		if(preg_match($regex, $email)){
			return TRUE;
		}
		
		return FALSE;
	}
	
	function _getUserDetails($email){
		$this->load->model('mod_user');
		
		$this->_user = $this->mod_user->getUserDetails($email);
		
		return $this->_user;
	}
		
	function _create_session($data){
		$this->session->set_userdata($data);
	}

    private function header_elements(){
        $elems = "<link href='".base_url()."assets/css/template.css' rel='stylesheet' />\n";
        $elems.= "\t<link href='".base_url()."assets/css/bootstrap.css' rel='stylesheet' />\n";
        $elems.= "\t<link href='".base_url()."assets/css/bootstrap-responsive.css' rel='stylesheet' />\n";
        $elems.= "\t<link href='".base_url()."assets/css/jasny-bootstrap.css' rel='stylesheet' />\n";
        $elems.= "\t<link href='".base_url()."assets/css/font-awesome.css' rel='stylesheet'>\n";
        $elems.= "\t<!--[if IE 7]>\n\t<link href='".base_url()."assets/css/font-awesome-ie7.min.css' rel='stylesheet' />\n\t<![endif]-->\n";

        $elems.= "\t<script type='text/javascript'>var site_url = '".site_url()."';</script>\n";
        $elems.= "\t<script src='".base_url()."assets/js/jquery-1.10.2.js' type='text/javascript'></script>\n";
        /* $elems.= "\t<script src='".base_url()."assets/js/jquery-ui.min.js' type='text/javascript'></script>\n"; */
        $elems.= "\t<script src='".base_url()."assets/js/bootstrap.js' type='text/javascript'></script>\n";
        $elems.= "\t<script src='".base_url()."assets/js/jasny-bootstrap.js' type='text/javascript'></script>\n";
        $elems.= "\t<script src='".base_url()."assets/js/makaya.js' type='text/javascript'></script>";

        return $elems;
    }

    private function page_script($script){
        $count = count($script);
        $scripts = '';

        for($i = 0; $i < $count; ++$i){
            if($script[$i] != ""){
                $scripts.= "<script type='text/javascript' src='".base_url()."assets/js/page/".$script[$i].".js'></script>\n\t";
            }
        }
        return $scripts;
    }

	function _getCarouselDetails($type=NULL,$id=NULL) {
		#if (!isset($object_list) || empty($object_list) || !isset($image_path) || empty($image_path)) {
		#	return NULL;
		#}
		
		$collection_id = NULL;
		$collection_id = $this->mod_collection->getCollectionId($type, $id);		
		$carousel = $this->mod_collection->getCollectionCarousel($collection_id);
		foreach ($carousel as $object) {
			if ($object->article_type == "product") {
				$image_path = $this->config->item('image_product_path');
				$image_name = $object->product_image;
				$url_id = $object->product_id;
				$name = $object->product_name;
			}
			else if ($object->article_type == "artisan") {
				$image_path = $this->config->item('image_artisan_path');
				$image_name = $object->artisan_image;
				$url_id = $object->artisan_id;
				$name = $object->artisan_name;
			}
			else if ($object->article_type == "enterprise") {
				$image_path = $this->config->item('image_enterprise_path');
				$image_name = $object->enterprise_image;
				$url_id = $object->enterprise_id;
				$name = $object->enterprise_name;
			}
						
			$clean_name = $this->clean_string($name);
			$object->url = site_url("{$object->article_type}/{$url_id}/{$clean_name}");
			$object->image = "{$image_path}{$image_name}";
			$object->name = $name;
		}
		
		return $carousel;
	}

	function _getHighlightsDeck($type, $id=NULL) {
		
		if ($type == "product") {
			$highlights = $this->mod_product->getProductDetails($id);
		}
		else if ($type == "artisan") {
			$highlights = $this->mod_artisan->getArtisanDetails($id);
		}
		else if ($type == "enterprise") {
			$highlights = $this->mod_enterprise->getEnterpriseDetails($id);
		}
		
		if (!isset($highlights) || empty($highlights)) {
			return NULL;
		}

		$highlights->clean_pname = ($pname = $highlights->product_name) ? $this->clean_string($pname) : "#";
		$highlights->clean_aname = ($aname = $highlights->artisan_name) ? $this->clean_string($aname) : "#";
		$highlights->clean_ename = ($ename = $highlights->enterprise_name) ? $this->clean_string($ename) : "#";

		return $highlights;
	}

	function _getSpringboardsList() {
		/* Returns a list of Springboards Link Pages */

		$collections = array();

		if ($collection_object = $this->mod_collection->getCollectionList()) {
			foreach ( $collection_object as $collection ) {
				$id = $collection->collection_id;
				$name = $collection->collection_name;

				$articles = array();
				if ( $collection_articles = $this->mod_article->getCollectionArticles($id) ) {
					foreach ( $collection_articles as $article ) {
						if ($article) {
							$article->url_title = $this->clean_string($article->article_title);
							array_push($articles, $article);
						}
					}
				}

				$collections[$name] = $articles;
			}
		}

		return $collections;
	}

	private function getBackboneList() {
		/* Returns a list of Backbone Link Pages */

		$pages = array(
					'About Us' => site_url('page/about-us'),
					'Acknowledgements' => site_url('page/acknowledgements'),
					'Partners' => site_url('page/page/partners'),
					'Terms Of Use' => site_url('page/terms-of-use'),
					'Legal Copyright' => site_url('page/legal-copyright')
					);
		$carts = array(
					'Shopping Cart' => site_url('shopping-cart'),
					'Customer Support' => site_url('page/customer-support'),
					'Feedback' => site_url('page/feedback'),
					'Subscribe' => '',
					'Share' => '',
					'Support' => '',
					);
		$collections = array(
					'Browse Makaya Products' => '',
					);

		if ($collection_object = $this->mod_collection->getCollectionList()) {
			foreach ( $collection_object as $collection ) {
				$id = $collection->collection_id;
				$name = $this->clean_string($collection->collection_name);
				$uri = site_url("collection/{$id}/{$name}");

				$collections[$collection->collection_name] = $uri;
			}
		}

		return array(
				'left' => $pages,
				'center' => $carts,
				'right' => $collections,
				);
	}

	function clean_string($string) {
		$cleaned_string = preg_replace('/\s/','-', $string);
		$cleaned_string = strtolower( $cleaned_string );
		$cleaned_string = preg_replace('/&/','and', $cleaned_string);
		$cleaned_string = preg_replace('/[^a-z0-9-]/','', $cleaned_string);

		return $cleaned_string;
	}
	
	function restore_string($string) {
		$original_string = preg_replace('/-/',' ', $string);		
		$original_string = preg_replace('/and/','&', $original_string);		

		return $original_string;
	}
	
	function exists($type=NULL, $id=NULL, $name=NULL) {
		if (is_null($id) && is_null($name)) {
			return FALSE;
		}
		$name = $this->restore_string($name);
		
		if ($type == "product") {
			return $this->mod_product->productExists($id, $name);
		}
		else if ($type == "artisan") {
			return $this->mod_artisan->artisanExists($id, $name);
		}
		else if ($type == "enterprise") {
			return $this->mod_enterprise->enterpriseExists($id, $name);
		}
		else if ($type == "article") {
			return $this->mod_article->articleExists($id, $name);
		}
		else {
			return FALSE;	
		}
	}
}
