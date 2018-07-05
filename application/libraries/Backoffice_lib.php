<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backoffice_lib {

	public function login($username,$password){
		$CI =& get_instance();
		$CI->load->model('backoffice_model','backoffice');
		$result = $CI->backoffice->login($username,$password);
		$userData = $CI->backoffice->getUserData($username);
		if ($result) {
			$data = array(
				'loggedIn' => true,
				'userID' => $userData[0]['userID'],
				'username' => $username,
				'name' => $userData[0]['name'],
				);
			$CI->session->set_userdata('user_data', $data);
			return 1;
		}
		return 0;
	}

  public function checkUsernameExist($username){
		$CI = &get_instance();
		$CI->load->model('backoffice_model','backoffice');
		return $CI->backoffice->checkUsernameExist($username);
	}
}
