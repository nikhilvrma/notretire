<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backoffice_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login($username,$password){
		$result = $this->db->get_where('adminAuth', array('username' => $username,'password' => $password, 'active'=>1), 1, 0);
		if ($result->num_rows()>0) {
			return $result;
		}
		return false;
	}

  public function checkUsernameExist($username){
		$result = $this->db->get_where('adminAuth', array('username' => $username), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

  public function getUserData($username){
    $result = $this->db->get_where('adminAuth', array('username' => $username));
    return $result->result_array();
  }

  public function checkPasswordMatch($username, $password){
		$result = $this->db->get_where('adminAuth', array('username' => $username,'password' => $password), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function changePassword($username, $password){
		$query = "UPDATE adminAuth SET password='$password' WHERE username='$username'";
		return $this->db->query($query);
	}

  public function getUserDataFromID($userID){
    $result = $this->db->get_where('adminAuth', array('userID' => $userID));
    return $result->result_array();
  }

  public function getAllUsersData(){
    $this->db->select('userID, name, email, mobile, accountType');
    $result = $this->db->get('users')->result_array();
    return $result;
  }

}
