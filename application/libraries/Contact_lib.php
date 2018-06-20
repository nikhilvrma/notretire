<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_lib {

	public function checkVerificationCode($mobile, $email, $type){
		$CI = &get_instance();
		$CI->load->model('contact_model','contactModel');
		return $CI->contactModel->checkVerificationCode($mobile, $email, $type);
	}

	public function insertVerificationCode($data){
		$CI = &get_instance();
		$CI->load->model('contact_model','contactModel');
		return $CI->contactModel->insertVerificationCode($data);
	}

}
