<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller{

    public function __construct(){
        parent::__construct();
		$this->load->helper('cookie');
	}

    public function index(){
        //$this->cart->destroy();
        $pagedata['page_title'] = 'Shopping Cart';
		$pagedata['page'] = 'Shopping Cart';

        if(isset($_POST['remove_cart_items'])){
            $this->cart->destroy();
        }

        $orders = $this->cart->contents();

        $img_path = $this->config->item('image_product_path');
        
        $pagedata['imgpath'] = $img_path;
		$pagedata['orders'] = $orders;

        $contentdata['script'] = array('shoppingcart');
        $contentdata['page'] = $this->load->view('page/shoppingcart', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function add(){
        if(!$this->input->is_ajax_request()) redirect(base_url());
        
        $pid = $this->input->post('pid');

        if(is_numeric($pid)){
            $product = $this->mod_product->getProduct($pid);

            $item_count = count($pid);

            if($this->cart->contents()){
                $cart_content = $this->cart->contents();

                foreach($cart_content as $key => $val){
                    if($cart_content[$key]['id'] == 'sku_prod_'.$product->product_id){
                        $curqty = intval($cart_content[$key]['qty']);
                        $newqty = intval($curqty+1);
                        $cdata = array(
                            'rowid' => $cart_content[$key]['rowid'],
                            'qty' => intval($cart_content[$key]['qty'])
                        );

                        $cdata['qty']+=1;

                        $this->update_cart($cdata);
                    }
                    else{
                        $rowid = $this->add_to_cart($product);
                    }
                }
            }
            else{
                $rowid = $this->add_to_cart($product);
            }

            $jsondata = array('status' => 1, 'response' => 'Item Added to Cart');
        }
        else{
            $jsondata = array('status' => 0, 'response' => 'Invalid Parameters');
        }

        echo json_encode($jsondata);
	}

    private function add_to_cart($product){
        $cdata = array(
            'id' => 'sku_prod_'.$product->product_id,
            'qty' => 1,
            'price' => $product->product_price,
            'name' => $product->product_name,
            'image' => $product->primary_image
        );

        return $this->cart->insert($cdata); 
    }

    private function update_cart($cdata){
        $this->cart->update($cdata);
    }

    public function remove(){
        $rowid = $this->uri->segment(3);

        if($rowid){
            $cartitems = array_keys($this->cart->contents());

            if(in_array($rowid, $cartitems)){
                $this->cart->update(array('rowid' => $rowid, 'qty' => 0));

                redirect(site_url('shopping-cart'));
            }
            else{
                echo 'Invalid Parameters';
            }
        }
        else{
            echo 'Invalid Parameters';
        }
    }

    public function update(){
        $qty = $this->uri->segment(3);
        $rowid = $this->uri->segment(4);

        if($rowid){
            $cartitems = array_keys($this->cart->contents());

            if(in_array($rowid, $cartitems)){
                $cdata = array('rowid' => $rowid, 'qty' => $qty);

                $this->update_cart($cdata);

                redirect(site_url('shopping-cart'));
            }
            else{
                echo 'Invalid Parameters';
            }
        }
        else{
            echo 'Invalid Parameters';
        }
    }
}
