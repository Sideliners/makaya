<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index($collection_id=NULL, $product_id=NULL, $product_name=NULL) {		
		if (!$this->exists("product", $product_id, $product_name)) redirect(base_url());
		
        $pagedata['xpage_title'] = 'Product';
		$pagedata['page'] = 'Product';
		
		$this->set_meta_params("product", $collection_id, $product_id);
		$carouseldata['carousel'] = $this->_get_carousel_details('product', $collection_id, $product_id);
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
		$highlightsdata['highlights'] = $this->_get_highlights_deck('product', $collection_id, $product_id);
		$pagedata['highlights'] = $this->load->view('partials/highlights/product', $highlightsdata, TRUE);

		$springboardsdata['springboards'] = $this->_get_springboards_list();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }	
	
	public function detail() {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		
		$product_id = intval($this->input->post('id'));
		$data = $this->mod_product->get_product($product_id);
		
		$status = 0;
		$message = "No Details for this Product";
		if (is_object($data)) {
			$status = 1;
			$message = $data->product_id;
		}
		
		$jsondata = array('status' => $status, 'response' => $message);
		echo json_encode($jsondata);
	}
}
