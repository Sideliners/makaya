<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Collection extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index($collection_id=NULL, $collection_name=NULL){
		if (!$this->exists("collection", $collection_id, $collection_name)) redirect(base_url());
		
		$pagedata['page_title'] = 'Products';
		$pagedata['page'] = 'Products';
		
		$products = $this->mod_product->get_collection_products($collection_id);
		foreach ($products as $product) {
			$clean_name = $this->clean_string($product->product_name);
			$product->url = "product/{$product->collection_id}/{$product->product_id}/{$clean_name}";
			$product->image_path = $this->config->item('image_product_path') . $product->product_image;
		}
		$pagedata['products'] = $products;
		
        $contentdata['script'] = array('article');
        $contentdata['page'] = $this->load->view('page/products', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}	
}