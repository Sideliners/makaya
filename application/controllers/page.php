<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }

    public function index(){
        $pagedata['xpage_title'] = 'Home';
		$pagedata['page'] = 'Home';
		
		$carouseldata['carousel'] = $this->_getCarouselDetails('product');
		$pagedata['carousel'] = $this->load->view('partials/carousel', $carouseldata, TRUE);
		
	    $highlightsdata['highlights'] = $this->_getHighlightsDeck('product');
		$pagedata['highlights'] = $this->load->view('partials/highlights/product', $highlightsdata, TRUE);
		
		$springboardsdata['springboards'] = $this->_getSpringboardsList();
		$pagedata['springboards'] = $this->load->view('partials/springboards', $springboardsdata, TRUE);

        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/homepage', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function aboutus() {
		$pagedata['page_title'] = 'About Us';
        $pagedata['page'] = 'About Us';
		
		$pagedata['content'] = 'We Are Makaya';

        $contentdata['script'] = array('aboutus');
        $contentdata['page'] = $this->load->view('page/aboutus', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function acknowledgements() {
		$pagedata['page_title'] = 'Acknowledgements';
		$pagedata['page'] = 'Acknowledgements';
		
		$pagedata['content'] = 'aknowledgement page';

        $contentdata['script'] = array('acknowledgements');
        $contentdata['page'] = $this->load->view('page/acknowledgements', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}

	public function partners() {
		$pagedata['page_title'] = 'Partners';
		$pagedata['page'] = 'Partners';
		
		$pagedata['content'] = 'partners page';

        $contentdata['script'] = array('partners');
        $contentdata['page'] = $this->load->view('page/partners', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function termsofuse() {
		$pagedata['page_title'] = 'Terms Of Use';
		$pagedata['page'] = 'Partners';
		
		$pagedata['content'] = 'terms of use page';

        $contentdata['script'] = array('termsofuse');
        $contentdata['page'] = $this->load->view('page/termsofuse', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function legalcopyright() {
		$pagedata['page_title'] = 'Legal Copyright';
		$pagedata['page'] = 'Legal Copyright';
		
		$pagedata['content'] = 'Legal Copyright page';

        $contentdata['script'] = array('legalcopyright');
        $contentdata['page'] = $this->load->view('page/legalcopyright', $pagedata, TRUE);

        $this->templateLoader($contentdata);
	}
	
	public function customersupport(){
        $pagedata['page_title'] = 'Customer Support';
		$pagedata['page'] = 'Customer Support';
			
		if(isset($_POST['send'])){
			$params = (object)$this->input->post();
			
			$email = $this->session->userdata('email');
			
			if(!$email && !$this->validate_email($params->inputEmail)){
				$pagedata['error_msg'] = 'Invalid Email Address';
			}
			else if(empty($params->message)){
				$pagedata['error_msg'] = 'Please enter your message';
			}
			else{
				// will send an email to customer support				
				if (!$email) {
					$email = $params->inputEmail;
				}
				$data = array('email' => $email, 'message' => $params->message);
				
				if (1) {
					$pagedata['success_msg'] = '<strong>Your message has been sent!</strong> Please wait for our reply.';
				}
				else{
					$pagedata['error_msg'] = 'An error occured, Please try again later';
				}
			}
		}
	
        $contentdata['script'] = array('customersupport');
        $contentdata['page'] = $this->load->view('page/customersupport', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function feedback(){
        $pagedata['page_title'] = 'User Feedbacks';
		$pagedata['page'] = 'User Feedbacks';

		if(isset($_POST['create'])){
			$params = (object)$this->input->post();
			
			$email = $this->session->userdata('email');
			
			if(!$email && !$this->validate_email($params->inputEmail)){
				$pagedata['error_msg'] = 'Invalid Email Address';
			}
			else if(empty($params->subject)){
				$pagedata['error_msg'] = 'Please enter subject';
			}
			else if(empty($params->message)){
				$pagedata['error_msg'] = 'Please enter your message';
			}
			else{
				if (!$email) {
					$email = $params->inputEmail;
				}
				$data = array(
					'feedback_email' => $email,
					'feedback_subject' => $params->subject,
					'feedback_message' => $params->message,
					'feedback_date_created' => date($this->config->item('datetime'))
					);
				
				if ($this->mod_feedback->create_feedback($data)) {
					$pagedata['success_msg'] = '<strong>Thank you for your feedback!</strong> Your feedback will post shortly.';
					unset($_POST);
				}
				else{
					$pagedata['error_msg'] = 'An error occured, Please try again later';
				}
			}
		}
		
		$pagedata['feedbacks'] = $this->mod_feedback->getFeedbacks();	
		
        $contentdata['script'] = array('feedback');
        $contentdata['page'] = $this->load->view('page/feedback', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
}
