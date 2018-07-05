<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'backoffice_lib'));
		$this->load->helper(array('url'));
		$this->data = array();
		$this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$this->data['csrf_token'] = $this->security->get_csrf_hash();
		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');
	}

	public function index(){
		$this->load->view('backoffice/login', $this->data);
	}

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
			$this->session->set_flashdata('message', array('content'=>'This E-Mail Address is not registered with us. Please Register to Proceed Ahead.','color'=>'red'));
			redirect(base_url('backoffice'));
		}
	}

	public function signout(){
		$this->session->set_userdata('user_data', false);
		$this->session->set_userdata('user_data', []);
		$this->session->sess_destroy();
		redirect(base_url('backoffice'));
	}

	public function users(){
		$this->load->view('backoffice/users', $this->data);
	}

	public function offers(){
		$this->load->view('backoffice/offers', $this->data);
	}

	public function changePassword(){
		$this->load->view('backoffice/changePassword', $this->data);
	}


}
