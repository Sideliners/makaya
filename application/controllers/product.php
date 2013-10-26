<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index($id=NULL, $name=NULL){
		if (!$this->exists("product", $id, $name)) {
			redirect(site_url());
		}
		
        $pagedata['xpage_title'] = 'Product';
		$pagedata['page'] = 'Product';
		
		$carouseldata['carousel'] = $this->_getCarouselDetails('product', $id);
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
		$highlightsdata['highlights'] = $this->_getHighlightsDeck('product',$id);
		$pagedata['highlights'] = $this->load->view('partials/highlights/product', $highlightsdata, TRUE);

		$springboardsdata['springboards'] = $this->_getSpringboardsList();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function category($id=NULL, $name=NULL){
		$category = $this->mod_category->getCategory($id);
        $pagedata['page_title'] = $category->category_name;
		$pagedata['page'] = $category->category_name;
		
		if ( $product_categories = $this->mod_product->getCategoryProducts($id) ) {
			$products = array();
			foreach ($product_categories as $product_category) {
				$product = $this->mod_product->getProduct($product_category->product_id);
				$product->clean_pname = ($product) ? $this->clean_string($product->product_name) : NULL;
				array_push ($products, $product);
			}
			$pagedata['products'] = $products;
		}
		
		$contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/products', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function detail() {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		
		$id = intval($this->input->post('id'));
		$data = $this->mod_product->getProduct($id);
		
		if(is_object($data)){
			$jsondata = array('status' => 1, 'response' => $data->product_id);
		}
		else{
			$jsondata = array('status' => 0, 'response' => 'No Details for this Product');
		}
				
		echo json_encode($jsondata);
	}
}
