<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backoffice extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib'));
		$this->load->helper(array('url'));
		$this->data = array();
		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');
	}

	public function index(){
		$this->load->view('backoffice/login', $this->data);
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
