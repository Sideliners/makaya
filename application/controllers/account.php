<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller{
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('mod_user');
	}
	
	public function register(){
		if($this->session->userdata('email')){
			redirect(base_url());
		}
		else{
			$pagedata['page_title'] = 'Create Account';
			$pagedata['page'] = 'register';
			
			if(isset($_POST['create'])){
				$params = (object)$this->input->post();
				
				if(empty($params->f_name)){
					$pagedata['error_msg'] = 'First Name can\'t be blank';
				}
				else if(empty($params->inputEmail)){
					$pagedata['error_msg'] = 'Email Address can\'t be blank';
				}
				else if(empty($params->inputPassword)){
					$pagedata['error_msg'] = 'Password can\'t be blank';
				}
				else if(empty($params->confirmPassword)){
					$pagedata['error_msg'] = 'Confirm Password can\'t be blank';
				}
				else{
					if($params->inputPassword != $params->confirmPassword){
						$pagedata['error_msg'] = 'Passwords are not match';
					}
					else if(!$this->validate_email($params->inputEmail)){
						$pagedata['error_msg'] = 'Invalid Email Address';
					}
					else if(strlen($params->inputPassword) < 6){
						$pagedata['error_msg'] = 'Password must be atleast 6 characters';
					}
					else{
						$check = $this->checkemail($params->inputEmail);
						
						if(is_object($check)){
							$pagedata['error_msg'] = 'Email address already used';
						}
						else{
							$userdata = array(
								'user_email' => $params->inputEmail,
								'user_password' => $this->encrypt->sha1($params->inputPassword),
								'firstname' => $params->f_name,
								'lastname' => $params->l_name,
								'user_type' => 4,
								'date_created' => date($this->config->item('datetime'))
							);
							
							if($this->mod_user->create_user($userdata)){
								// send an email confirmation to be added later...
								$pagedata['success_msg'] = '<strong>Congratulations!</strong> Account has been created.<br />We\'ve sent you an Email Confirmation.';
								unset($_POST);
							}
							else{
								$pagedata['error_msg'] = 'An error occured, Please try again later';
							}
						}
					}
				}
			}
	
			$contentdata['script'] = array('account');
			$contentdata['page'] = $this->load->view('page/register', $pagedata, TRUE);
	
			$this->templateLoader($contentdata);
		}
	}
	
	public function login(){
		if($this->session->userdata('email')){
			redirect(base_url());
		}
		else{
			$pagedata['page_title'] = 'Customer Login';
			$pagedata['page'] = 'login';
			
			if(isset($_POST['login'])){
				$params = (object)$this->input->post();
				
				if(!$this->validate_email($params->inputEmail)){
					$pagedata['error_msg'] = 'Invalid Email Address';
				}
				else if(empty($params->inputPassword)){
					$pagedata['error_msg'] = 'Please enter your password';
				}
				else{
					$check = $this->checkemail($params->inputEmail, $this->encrypt->sha1($params->inputPassword), 1);
					
					if(is_object($check)){
						// create sessions
						$data = array('email' 	=> $params->inputEmail);
						
						$this->_create_session($data);
						redirect(base_url());
					}
					else{
						$pagedata['error_msg'] = 'Invalid login credentials';
					}
				}
			}
			elseif(isset($_POST['forgot'])){
				$email = $this->input->post('email');
			}
	
			$contentdata['script'] = array('account');
			$contentdata['page'] = $this->load->view('page/login', $pagedata, TRUE);
	
			$this->templateLoader($contentdata);
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		
		redirect(base_url());
	}
	
	public function profile(){
		$pagedata['page_title'] = 'Profile';
		$pagedata['page'] = 'profile';
		
		if (!$this->session->userdata('email')) {
			redirect(base_url());
		}
		
		$user = $this->mod_user->getUser($this->session->userdata('email'));

		if(isset($_POST['update'])){
			$params = (object)$this->input->post();
			
			if(empty($params->f_name)){
				$pagedata['error_msg'] = 'First Name can\'t be blank';
			}
			else{
				$userdata = array(
						'firstname' => $params->f_name,
						'lastname' => $params->l_name,
						'last_modified' => date($this->config->item('datetime'))
					);
				
				if($this->mod_user->update_user($user->user_id, $userdata)){
					$pagedata['success_msg'] = '<strong>Congratulations!</strong> Your account has been updated.';
				}
				else{
					$pagedata['error_msg'] = 'An error occured, Please try again later';
				}
			}
		}
		else {
			$_POST['f_name'] = $user->firstname;
			$_POST['l_name'] = $user->lastname;
		}

		$contentdata['script'] = array('account');
		$contentdata['page'] = $this->load->view('page/profile', $pagedata, TRUE);

		$this->templateLoader($contentdata);
	}
	
	public function password(){
		$pagedata['page_title'] = 'Change Password';
		$pagedata['page'] = 'password';

		if (!$this->session->userdata('email')) {
			redirect(base_url());
		}
		
		$user = $this->mod_user->getUser($this->session->userdata('email'));

		if(isset($_POST['update'])){
			$params = (object)$this->input->post();
			
			if(empty($params->oldPassword)){
				$pagedata['error_msg'] = 'Old Password can\'t be blank';
			}
			else if(empty($params->newPassword)){
				$pagedata['error_msg'] = 'New Password can\'t be blank';
			}
			else if(empty($params->confirmPassword)){
				$pagedata['error_msg'] = 'Confirm Password can\'t be blank';
			}
			else{
				if (!$this->mod_user->checkOldPassword($user->user_id, $params->oldPassword)) {
					$pagedata['error_msg'] = 'Old Password not match.';
				}
				else if($params->newPassword != $params->confirmPassword){
					$pagedata['error_msg'] = 'Passwords are not match';
				}
				else if(strlen($params->newPassword) < 6){
					$pagedata['error_msg'] = 'Password must be atleast 6 characters';
				}
				else { 
					$userdata = array(
						'user_password' => $this->encrypt->sha1($params->newPassword),
						'last_modified' => date($this->config->item('datetime'))
						);
		
					if($this->mod_user->update_user($user->user_id, $userdata)){
						$pagedata['success_msg'] = '<strong>Congratulations!</strong> Your have successfully changed your password.';
						unset($_POST);
					}
					else{
						$pagedata['error_msg'] = 'An error occured, Please try again later';
					}
				}
			}
		}

		$contentdata['script'] = array('account');
		$contentdata['page'] = $this->load->view('page/password', $pagedata, TRUE);

		$this->templateLoader($contentdata);
	}
	
	private function checkemail($email, $password = NULL, $is_member = NULL){
		return $this->mod_user->getUser($email, $password, $is_member);
	}
	
	function  validateEmail(){
		if($this->input->is_ajax_request()){
			$email = $this->input->post('email');
			$msg = '';
			$status = 0;
			
			if($this->validate_email($email)){
				$check = $this->checkemail($email, NULL, 1);
				
				if($check){
					$status = 1;
					
					// send email
					$msg = 'A new password has been sent to your email.';
				}
				else{
					$msg = 'Email Address does not exists.';
				}
			}
			
			echo json_encode(array('stats' => $status, 'msg' => $msg));
		}
		else{
			redirect(base_url());
		}
	}
}