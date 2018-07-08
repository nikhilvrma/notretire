<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'backoffice_lib', 'function_lib'));
		$this->load->helper(array('url'));
		$this->data = array();
		$this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$this->data['csrf_token'] = $this->security->get_csrf_hash();
		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');
	}

	public function index(){
		if($this->backoffice_lib->auth()){
			redirect(base_url('backoffice/users'));
		}
		$this->load->view('backoffice/login', $this->data);
	}
	public function users(){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$this->data['users'] = $this->backoffice_lib->getAllUsersData();
		$this->load->view('backoffice/users', $this->data);
	}

	public function offers(){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$this->data['offers'] = $this->backoffice_lib->getAllOffers();
		$this->load->view('backoffice/offers', $this->data);
	}


	public function viewOfferDetails($offerID){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$this->data['offerDetails'] = $this->function_lib->getOfferDetails($offerID);
		$this->data['employerDetails'] = $this->function_lib->getCompanyData($this->data['offerDetails'][0]['addedBy']);
		if(empty($this->function_lib->getOfferDetails($offerID))){
			redirect(base_url('404'));
		}
		if($offerLocations = $this->function_lib->getOfferLocations($offerID))
			$this->data['offerLocations'] = $offerLocations;
		else{
			$this->data['getOfferLocationsations'] = array();
		}
		$this->load->view('backoffice/offer', $this->data);
	}


	public function viewUserDetails($userID){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$this->data['generalData'] = $this->function_lib->getUserGeneralData($userID)[0];
		$this->data['educationalDetails'] = $this->function_lib->getUserEducationalDetails($userID);
		$this->data['workExperience'] = $this->function_lib->getUserWorkExperience($userID);
		$this->load->view('report', $this->data);
	}


	public function changePassword(){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$this->load->view('backoffice/changePassword', $this->data);
	}




	///// Backoffice Functions/////




	public function login(){
		$username = '';
		$password = '';
		if($x = $this->input->post('username')){
			$username = $x;
		}
		if($x = $this->input->post('password')){
			$password = $x;
		}
		if($this->backoffice_lib->checkUsernameExist($username)){
			$password = md5($password);
			$result = $this->backoffice_lib->login($username, $password);
			if($result){
				redirect(base_url('backoffice/users'));
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'Wrong Password. Please Try Again.','color'=>'red'));
				redirect(base_url('backoffice'));
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Please Enter the correct Username to Proceed Ahead.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
	}

	public function signout(){
		$this->session->set_userdata('user_data', false);
		$this->session->set_userdata('user_data', []);
		$this->session->sess_destroy();
		redirect(base_url('backoffice'));
	}

	public function setNewPassword(){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
		$currentPassword = '';
		$newPassword = '';
		$confirmNewPassword = '';

		if($x = $this->input->post('currentPassword')){
			$currentPassword = $x;
		}
		if($x = $this->input->post('newPassword')){
			$newPassword = $x;
		}
		if($x = $this->input->post('confirmPassword')){
			$confirmNewPassword = $x;
		}
		$currentPassword = md5($currentPassword);
		$newPassword = md5($newPassword);
		$confirmNewPassword = md5($confirmNewPassword);
		if($newPassword === $confirmNewPassword){
			$username = $_SESSION['user_data']['username'];
			if($this->backoffice_lib->checkPasswordMatch($username, $currentPassword)){
				$result = $this->backoffice_lib->changePassword($username, $newPassword);
				if($result){
					$this->session->set_flashdata('message', array('content'=>'Password Successfully Changed','color'=>'green'));
					redirect(base_url('backoffice/change-password'));
				}
				else{
					$this->session->set_flashdata('message', array('content'=>'Some Error Occured, Please Try Again.','color'=>'red'));
					redirect(base_url('backoffice/change-password'));
				}
			}
			else{
				$this->session->set_flashdata('message', array('content'=>'The Current Password, does not match with the one in our database, Please Try Again.','color'=>'red'));
				redirect(base_url('backoffice/change-password'));
			}
		}
		else{
			$this->session->set_flashdata('message', array('content'=>'Your New Password, does not matches with Confirm New Password, Please Try Again.','color'=>'red'));
			redirect(base_url('backoffice/change-password'));
		}
	}

	public function approveOffer($offerID){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			echo "false"; die;
		}
		if($this->backoffice_lib->approveOffer($offerID)){
			$this->session->set_flashdata('message', array('content'=>'The offer has been successfully approved.','color'=>'green'));
			echo "true"; die;
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong, Please Try Again.','color'=>'red'));
			echo "false"; die;
		}
	}

	public function rejectOffer($offerID){
		if(!$this->backoffice_lib->auth()){
			$this->session->set_flashdata('message', array('content'=>'It seems you have been logged out, Please Login to Continue.','color'=>'red'));
			echo "false"; die;
		}
		$remark = $this->input->get('remark');
		if($this->backoffice_lib->rejectOffer($offerID, $remark)){
			$this->session->set_flashdata('message', array('content'=>'The offer has been successfully rejected.','color'=>'green'));
			echo 'true'; die;
		}else{
			$this->session->set_flashdata('message', array('content'=>'Something Went Wrong, Please Try Again.','color'=>'red'));
			echo 'false'; die;
		}
	}

}
