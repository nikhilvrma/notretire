<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function checkVerificationCode($mobile, $email, $type){
		if($type=="1"){
			$this->db->order_by('codeID', 'DESC');
			$result = $this->db->get_where('verificationCodes', array('mobile' => $mobile, 'active'=>'1'), '1');
			return $result->result_array();
		}
		if($type=="2"){
			$this->db->order_by('codeID', 'DESC');
			$result = $this->db->get_where('verificationCodes', array('email' => $email, 'active'=>'1'), '1');
			return $result->result_array();
		}
	}

	public function insertVerificationCode($data){
		return $this->db->insert('verificationCodes', $data);
	}

}
