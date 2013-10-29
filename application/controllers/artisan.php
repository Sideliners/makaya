<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artisan extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index($collection_id=NULL, $artisan_id=NULL, $artisan_name=NULL){		
		if (!$this->exists("artisan", $artisan_id, $artisan_name)) redirect(base_url());
		
        $pagedata['xpage_title'] = 'Artisan';
		$pagedata['page'] = 'Artisan';
		
		$this->set_meta_params("artisan", $collection_id, $artisan_id);
		$carouseldata['carousel'] = $this->_get_carousel_details('artisan', $collection_id, $artisan_id);
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
		$highlightsdata['highlights'] = $this->_get_highlights_deck('artisan', $collection_id, $artisan_id);
		$pagedata['highlights'] = $this->load->view('partials/highlights/artisan', $highlightsdata, TRUE);

		$springboardsdata['springboards'] = $this->_get_springboards_list();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function detail() {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		
		$artisan_id = intval($this->input->post("id"));
		$data = $this->mod_artisan->get_artisan($artisan_id);
		
		$status = 0;
		$message = "No Details for this Artisan";
		if (is_object($data)) {
			$status = 1;
			$message = $data->artisan_id;
		}
		
		$jsondata = array('status' => $status, 'response' => $message);
		echo json_encode($jsondata);
	}
}
