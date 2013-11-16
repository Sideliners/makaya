<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MY_Controller{

    public function __construct(){
        parent::__construct();		
    }
	
	public function donation(){
        $pagedata['page_title'] = 'Donation Info';
		$pagedata['page'] = 'Donation Info';
		
		$recipients = $this->mod_artisan->get_donation_artisans();
		$recipients = $this->mod_enterprise->get_donation_enterprises();
		
		$pagedata['recipients'] = $recipients;
		
        $contentdata['script'] = array('admin');
        $contentdata['page'] = $this->load->view('page/donationinfo', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
	
	public function get_recipients($type=NULL) {
		if(!$this->input->is_ajax_request()) redirect(base_url());
		if(is_null($type)) redirect(base_url());
		
		$status = 0;
		$response = "";		
		
		if ($type == "artisan") { $response = $this->mod_artisan->get_donation_artisans(); }
		if ($type == "enterprise") { $response = $this->mod_enterprise->get_donation_enterprises(); }
		if ($response) { $status = 1; }
		
		$jsondata = array('status' => $status, 'response' => $response);
		return json_encode($jsondata);
	}
	
	public function customer(){
        $pagedata['page_title'] = 'Customer Support';
		$pagedata['page'] = 'Customer Support';
			
		if(isset($_POST['send'])){
			$params = (object)$this->input->post();
			
			$email = $this->session->userdata('email');
			$name = $this->session->userdata('firstname');			
			
			if(!$email && !$this->validate_email($params->inputEmail)){
				$pagedata['error_msg'] = 'Invalid Email Address';
			}
			else if(!$name && empty($params->user_name)) {
				$pagedata['error_msg'] = 'Please enter your name';
			}
			else if(empty($params->message)){
				$pagedata['error_msg'] = 'Please enter your message';
			}
			else{
				// will send an email to customer support				
				if (!$email && !$name) {
					$email = $params->inputEmail;
					$name = $params->user_name;
				}
				if ($name) $name .= " " . $this->session->userdata('lastname');
                $subject = "[INQUIRY] Customer Support";
                
				if ($this->send_email($email, $name, $subject, $params->message, 1)) {
					$pagedata['success_msg'] = '<strong>Your message has been sent!</strong> Please wait for our reply.';
					unset($_POST);
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
					'date_added' => date($this->config->item('datetime'))
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
		
		$pagedata['feedbacks'] = $this->mod_feedback->get_feedbacks();	
		
        $contentdata['script'] = array('feedback');
        $contentdata['page'] = $this->load->view('page/feedback', $pagedata, TRUE);

        $this->templateLoader($contentdata);
    }
}
