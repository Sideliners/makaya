<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enterprise extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index($collection_id=NULL, $enterprise_id=NULL, $enterprise_name=NULL){		
		if (!$this->exists("enterprise", $enterprise_id, $enterprise_name)) redirect(base_url());
		
        $pagedata['xpage_title'] = 'Enterprise';
		$pagedata['page'] = 'Enterprise';
		
		$this->set_meta_params("enterprise", $collection_id, $enterprise_id);
		$carouseldata['carousel'] = $this->_get_carousel_details('enterprise', $collection_id, $enterprise_id);
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
		$highlightsdata['highlights'] = $this->_get_highlights_deck('enterprise', $collection_id, $enterprise_id);
		$pagedata['highlights'] = $this->load->view('partials/highlights/enterprise', $highlightsdata, TRUE);

		$springboardsdata['springboards'] = $this->_get_springboards_list();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function detail() {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		
		$enterprise_id = intval($this->input->post("id"));
		$data = $this->mod_enterprise->get_enterprise($enterprise_id);
		
		$status = 0;
		$message = "No Details for this Enterprise";
		if (is_object($data)) {
			$status = 1;
			$message = $data->enterprise_id;
		}
		
		$jsondata = array('status' => $status, 'response' => $message);
		echo json_encode($jsondata);
	}
}
