<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Enterprise extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index($id=NULL, $name=NULL){
		if (!$this->exists("enterprise", $id, $name)) {
			redirect(site_url());
		}
		
        $pagedata['xpage_title'] = 'Enterprise';
		$pagedata['page'] = 'Enterprise';
		
		$carouseldata['carousel'] = $this->_getCarouselDetails('enterprise', $id);
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
		$highlightsdata['highlights'] = $this->_getHighlightsDeck('enterprise',$id);
		$pagedata['highlights'] = $this->load->view('partials/highlights/enterprise', $highlightsdata, TRUE);

		$springboardsdata['springboards'] = $this->_getSpringboardsList();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function detail() {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		
		$id = intval($this->input->post('id'));
		$data = $this->mod_enterprise->getEnterprise($id);
		
		if(is_object($data)){
			$jsondata = array('status' => 1, 'response' => $data->enterprise_id);
		}
		else{
			$jsondata = array('status' => 0, 'response' => 'No Details for this Enterprise');
		}
				
		echo json_encode($jsondata);
	}
}
