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
	
	public function thankyou(){
        $this->load->model('mod_cart');

        $img_path = $this->config->item('image_product_path');
        $save = 0;

		$pagedata['page_title'] = 'Thank you for Purchasing';
        $pagedata['imgpath'] = $img_path;

        $orders = $this->cart->contents();

        if(!empty($orders)){
            $data = array(
                'transaction_id' => $this->input->get('token'),
                'payer_id' => $this->input->get('PayerID')
            );

            foreach($orders as $key => $val){
                $prod_id = explode("_", $val['id']);

                $data['product_id']  = $prod_id[2];
                $data['item_qty']    = $val['qty'];
                $data['total_price'] = $val['subtotal'];

                $save += $this->mod_cart->save_transaction($data);
            }

            if($save > 0){
                $this->cart->destroy();
            }
            else{
                $pagedata['response'] = '<p>Something went wrong, Please contact our support.</p>';
            }
        }

        $pagedata['page'] = 'Thank you for Purchasing';		
        $orders = $this->mod_cart->get_transactions($this->input->get('PayerID'), $this->input->get('token'));

        $pagedata['orders'] = $orders;

        $contentdata['script'] = NULL;
        $contentdata['page'] = $this->load->view('page/thankyou', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function cancelled_purchase(){
		$pagedata['page_title'] = 'Purchase Cancelled';
		$pagedata['page'] = 'Purchase Cancelled';		

        $contentdata['script'] = NULL;
        $contentdata['page'] = $this->load->view('page/cancel_purchase', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
}
