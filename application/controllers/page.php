<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index(){
        $pagedata['xpage_title'] = 'Home';
		$pagedata['page'] = 'Home';
		
		$product = $this->mod_product->get_highlighted_product();
        if ($product) {
		    $this->set_meta_params("product", $product->collection_id, $product->product_id);
    		$carouseldata['carousel'] = $this->_get_carousel_details('product', $product->collection_id, $product->product_id);
	    	$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
    	    $highlightsdata['highlights'] = $this->_get_highlights_deck('product', $product->collection_id, $product->product_id);
	    	$pagedata['highlights'] = $this->load->view('partials/highlights/product', $highlightsdata, TRUE);
        }
		
		$springboardsdata['springboards'] = $this->_get_springboards_list();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function aboutus() {
		$pagedata['page_title'] = 'About Us';
        $pagedata['page'] = 'About Us';

        $contentdata['script'] = array('aboutus');
        $contentdata['page'] = $this->load->view('page/aboutus', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function acknowledgements() {
		$pagedata['page_title'] = 'Acknowledgements';
		$pagedata['page'] = 'Acknowledgements';

        $contentdata['script'] = array('acknowledgements');
        $contentdata['page'] = $this->load->view('page/acknowledgements', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}

	public function partners() {
		$pagedata['page_title'] = 'Partners';
		$pagedata['page'] = 'Partners';

        $contentdata['script'] = array('partners');
        $contentdata['page'] = $this->load->view('page/partners', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function termsofuse() {
		$pagedata['page_title'] = 'Terms Of Use';
		$pagedata['page'] = 'Partners';		

        $contentdata['script'] = array('termsofuse');
        $contentdata['page'] = $this->load->view('page/termsofuse', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function legalcopyright() {
		$pagedata['page_title'] = 'Legal Copyright';
		$pagedata['page'] = 'Legal Copyright';		

        $contentdata['script'] = array('legalcopyright');
        $contentdata['page'] = $this->load->view('page/legalcopyright', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}	
}
