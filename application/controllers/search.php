<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$pagedata['page_title'] = 'Search';
        $pagedata['page'] = 'Search';
		
		$pagedata['content'] = 'We Are Makaya';
		
		$offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$limit = 15;
		$total = count($this->search_query($this->input->post('q'), NULL, NULL));
		$url = base_url('search');
		
		$pagedata['search'] = $this->search_query($this->input->post('q'), $offset, $limit);
		
		$pagedata['img_path'] = $this->config->item('image_product_path');
		
		if($total > $limit){
			$pagedata['pagination'] = $this->_paginate($url, $total, $limit, 2);
		}

        $contentdata['script'] = array('admin', 'search');
        $contentdata['page'] = $this->load->view('page/search_result', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	private function search_query($str, $offset = NULL, $limit = NULL){
		$search = $this->mod_product->search_products($str, $offset, $limit);		
		if($search) {
			$search_results = array();			
			foreach ($search as $item) {
				$search_results[$item->collection_name][$item->product_id] = $item;
			}			
			return $search_results;
		}
		return FALSE;
	}
}