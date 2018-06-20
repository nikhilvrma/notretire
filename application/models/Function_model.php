<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function login($email,$password){
		$result = $this->db->get_where('users', array('email' => $email,'password' => $password, 'active'=>1), 1, 0);
		if ($result->num_rows()>0) {
			return $result;
		}
		return false;
	}

	public function updateEmail($email){
		$data = array(
			'email' => $email
		);
		$this->db->where('email', $_SESSION['user_data']['email']);
		return $this->db->update('users', $data);
	}

	public function updateMobile($mobile){
		$data = array(
			'mobile' => $mobile
		);
		$this->db->where('mobile', $_SESSION['user_data']['mobile']);
		return $this->db->update('users', $data);
	}

	public function getMobileVerificationCode(){
		$this->db->select('code,expiry');
		$this->db->order_by('generatedAt', 'Desc');
		$this->db->limit(1);
		$result = $this->db->get_where('verificationCodes', array('mobile' => $_SESSION['user_data']['mobile']))->result_array();
		return $result;
	}

	public function getEmailVerificationCode(){
		$this->db->select('code,expiry');
		$this->db->order_by('generatedAt', 'Desc');
		$this->db->limit(1);
		$result = $this->db->get_where('verificationCodes', array('email' => $_SESSION['user_data']['email']))->result_array();
		return $result;
	}

	public function updateEmailVerified(){
		$data = array(
			'emailVerified' => 1
		);
		$this->db->where('email', $_SESSION['user_data']['email']);
		return $this->db->update('users', $data);
	}

	public function updateMobileVerified(){
		$data = array(
			'mobileVerified' => 1
		);
		$this->db->where('mobile', $_SESSION['user_data']['mobile']);
		return $this->db->update('users', $data);
	}

	public function getOfferApplicantSkills($offerID, $offset = 0, $limit = 10, $type){
		if($type == 1){
			if($offset == -1){
				$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, GROUP_CONCAT(DISTINCT `userSkills`.`skillID`) as `skillID`, GROUP_CONCAT(`userSkills`.`type`) as `type`, GROUP_CONCAT(DISTINCT `userSkills`.`score`) as `score`, GROUP_CONCAT(DISTINCT `skills`.`skill_name`) as `skillName` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `userSkills` ON `users`.`userID` = `userSkills`.`userID` LEFT JOIN `skills` ON `userSkills`.`skillID` = `skills`.`skillID` WHERE `applicants`.`offerID` ='. $offerID .' AND `userSkills`.`score` >= 10 GROUP BY `applicants`.`applicantID`');
			}else{
			$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, GROUP_CONCAT(DISTINCT `userSkills`.`skillID`) as `skillID`, GROUP_CONCAT(`userSkills`.`type`) as `type`, GROUP_CONCAT(DISTINCT `userSkills`.`score`) as `score`, GROUP_CONCAT(DISTINCT `skills`.`skill_name`) as `skillName` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `userSkills` ON `users`.`userID` = `userSkills`.`userID` LEFT JOIN `skills` ON `userSkills`.`skillID` = `skills`.`skillID` WHERE `applicants`.`offerID` ='. $offerID .' AND `userSkills`.`score` >= 10 GROUP BY `applicants`.`applicantID` LIMIT '.$limit.' OFFSET '. $offset);
			}
		}
		else{
			if($offset == -1){
					$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, GROUP_CONCAT(DISTINCT `userSkills`.`skillID`) as `skillID`, GROUP_CONCAT(`userSkills`.`type`) as `type`, GROUP_CONCAT(DISTINCT `userSkills`.`score`) as `score`, GROUP_CONCAT(DISTINCT `skills`.`skill_name`) as `skillName` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `userSkills` ON `users`.`userID` = `userSkills`.`userID` LEFT JOIN `skills` ON `userSkills`.`skillID` = `skills`.`skillID` WHERE `applicants`.`offerID` ='. $offerID .' AND `applicants`.`status` = '. $type .' AND `userSkills`.`score` >= 10  GROUP BY `applicants`.`applicantID`');
			}else{
					$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, GROUP_CONCAT(DISTINCT `userSkills`.`skillID`) as `skillID`, GROUP_CONCAT(`userSkills`.`type`) as `type`, GROUP_CONCAT(DISTINCT `userSkills`.`score`) as `score`, GROUP_CONCAT(DISTINCT `skills`.`skill_name`) as `skillName` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `userSkills` ON `users`.`userID` = `userSkills`.`userID` LEFT JOIN `skills` ON `userSkills`.`skillID` = `skills`.`skillID` WHERE `applicants`.`offerID` ='. $offerID .' AND `applicants`.`status` = '. $type .' AND `userSkills`.`score` >= 10  GROUP BY `applicants`.`applicantID` LIMIT '.$limit.' OFFSET '. $offset);
			}
		}
		// var_dump($this->db->last_query()); die;
		return $result->result_array();
	}

	public function getOfferApplicants($offerID, $offset = 0, $limit = 10, $type){
		if($type == 1){
			if($offset == -1){
				$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, `applicants`.`status`, `users`.`name`, `users`.`email`, `users`.`mobile`, `users`.`gender`, `users`.`cityID`, `indianCities`.`city`, `indianCities`.`state` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `indianCities` ON `users`.`cityID` = `indianCities`.`cityID` WHERE `applicants`.`offerID` ='. $offerID .' GROUP BY `applicants`.`applicantID`');
			}else{
				$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, `applicants`.`status`, `users`.`name`, `users`.`email`, `users`.`mobile`, `users`.`gender`, `users`.`cityID`, `indianCities`.`city`, `indianCities`.`state` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `indianCities` ON `users`.`cityID` = `indianCities`.`cityID` WHERE `applicants`.`offerID` ='. $offerID .' GROUP BY `applicants`.`applicantID` LIMIT '.$limit.' OFFSET '. $offset);
		}
		}
		else{
			if($offset == -1){
				$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, `applicants`.`status`, `users`.`name`, `users`.`email`, `users`.`mobile`, `users`.`gender`, `users`.`cityID`, `indianCities`.`city`, `indianCities`.`state` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `indianCities` ON `users`.`cityID` = `indianCities`.`cityID` WHERE `applicants`.`offerID` ='. $offerID .' AND `applicants`.`status` = '. $type .' GROUP BY `applicants`.`applicantID`');
			}else{
				$result = $this->db->query('SELECT `applicants`.`applicantID`, `applicants`.`userID`, `applicants`.`status`, `users`.`name`, `users`.`email`, `users`.`mobile`, `users`.`gender`, `users`.`cityID`, `indianCities`.`city`, `indianCities`.`state` FROM `applicants` JOIN `users` ON `applicants`.`userID` = `users`.`userID` LEFT JOIN `indianCities` ON `users`.`cityID` = `indianCities`.`cityID` WHERE `applicants`.`offerID` ='. $offerID .' AND `applicants`.`status` = '. $type .' GROUP BY `applicants`.`applicantID` LIMIT '.$limit.' OFFSET '. $offset);
			}
		}
		// var_dump($this->db->last_query()); die;
		return $result->result_array();
	}

	public function hasMoreOfferApplicants($offerID, $offset, $limit, $type){
		if($offset == -1){
			return false;
		}
		$this->db->limit($limit, $offset);
		$result = $this->db->get_where('applicants', array('offerID' => $offerID, 'status' => $type));
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getAllLocations(){
		return $this->db->get('indianCities')->result_array();
	}

	public function insertCompanyData($userID){
		$data = array(
			'userID' => $userID
		);
		return $this->db->insert('employers',$data);
	}

	public function getCompanyData($userID){
		return $this->db->get_where('employers', array('userID' => $userID))->result_array()[0];
	}

	public function getColleges(){
		$this->db->order_by('college', 'ASC');
		return $this->db->get_where('colleges', array('active' => 1))->result_array();
	}

	public function getCourses(){
		return $this->db->get_where('courses', array('active' => 1))->result_array();
	}

	public function getUserData($email){
		$result = $this->db->get_where('users', array('email' => $email));
		return $result->result_array();
	}

	public function getUserDataFromID($userID){
		$result = $this->db->get_where('users', array('userID' => $userID));
		return $result->result_array();
	}

	public function checkEMailExist($email){
		$result = $this->db->get_where('users', array('email' => $email), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function checkMobileExist($mobile){
		$result = $this->db->get_where('users', array('mobile' => $mobile), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function register($data){
		return $this->db->insert('users', $data);
	}

	public function checkPasswordMatch($email, $password){
		$result = $this->db->get_where('users', array('email' => $email,'password' => $password), 1, 0);
		if ($result->num_rows()>0) {
			return true;
		}
		return false;
	}

	public function changePassword($email, $password){
		$query = "UPDATE users SET password='$password' WHERE email='$email'";
		return $this->db->query($query);
	}




	////////////////////////////////////////////////////////////


	///////////////////General Details/////////////////////////





	public function getPreferredLocations($userID){
		$this->db->join('indianCities', 'preferredLocations.cityID = indianCities.cityID');
		$result = $this->db->get_where('preferredLocations', array('userID'=>$userID));
		return $result->result_array();
	}

	public function insertPreferredLocation($data){
		return $this->db->insert('preferredLocations', $data);
	}

	public function checkPreferredLocationUnique($location, $userID){
		$result = $this->db->get_where('preferredLocations', array('cityID'=> $location, 'userID' => $userID));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function deletePreferredLocation($location, $userID){
		$this->db->where(array('userID' => $userID, 'cityID' => $location));
		return $this->db->delete('preferredLocations');
	}

	public function isUserPreferredLocation($location, $userID){
		$this->db->where(array('userID' => $userID, 'cityID' => $location));
		$result = $this->db->get('preferredLocations');
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function updateGeneralDetails($data, $userID){
		$this->db->where('userID', $userID);
		return $this->db->update('users', $data);
	}

	public function updateCompanyDetails($data, $userID){
		$this->db->where('userID', $userID);
		return $this->db->update('employers', $data);
	}

	public function updateCompanyLogo($userId, $logo){
		$CI =& get_instance();
		$_SESSION['user_data']['companyLogo'] = $image['companyLogo'];
		$this->db->where('userID', $userId);
		return $this->db->update('employers', $logo);
	}

	public function getFilename($type, $userId){
		if($type == 'company'){
			$this->db->select('companyName');
			$this->db->where('userID', $userId);
			$result = $this->db->get('employers')->result_array();
			$result = $result[0]['companyName'];
		}else{
			$this->db->select('name');
			$this->db->where('userID', $userId);
			$result = $this->db->get('users')->result_array();
			$result = $result[0]['name'];
		}
		return str_replace(' ', '_', $result).$userId;
	}

	public function updateProfileImage($userId, $image){
		$CI =& get_instance();
		$_SESSION['user_data']['profileImage'] = $image['profileImage'];
		$this->db->where('userID', $userId);
		return $this->db->update('users', $image);
	}

	public function getUserGeneralData($userID){
		$this->db->select('users.userID, users.name, users.email, users.mobile, users.gender, users.cityID, indianCities.city, indianCities.state');
		$this->db->join('indianCities', 'users.cityID = indianCities.cityID');
		$result = $this->db->get_where('users', array('userID'=>$userID))->result_array();
		return $result;
	}



/////////////////////////////////////////////////////////////////

//////////////Education And Work Experience//////////////////////


	public function deleteEducationalDetail($education){
		$this->db->where(array('educationID' => $education));
		return $this->db->delete('educationalDetails');
	}

	public function deleteWorkExperience($experience){
		$this->db->where(array('workExperienceID' => $experience));
		return $this->db->delete('workExperience');
	}


	public function checkEducationUnique($userID, $type){
		$result = $this->db->get_where('educationalDetails', array('userID' => $userID, 'educationType' => $type));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function addEducation($data){
		return $this->db->insert('educationalDetails', $data);
	}

	public function updateEducation($data, $educationID){
		$this->db->where('educationID', $educationID);
		return $this->db->update('educationalDetails', $data);
	}

	public function getUserEducationalDetails($userID){
		$this->db->join('colleges', 'educationalDetails.instituteID = colleges.college_id', 'left');
		$this->db->join('courses', 'educationalDetails.courseID = courses.course_id', 'left');
		$this->db->order_by('educationType','ASC');
		$result = $this->db->get_where('educationalDetails', array('userID'=>$userID));
		return $result->result_array();
	}

	public function getUserWorkExperience($userID){
		$result = $this->db->get_where('workExperience', array('userID'=>$userID));
		return $result->result_array();
	}

	public function addWorkExperience($data){
		return $this->db->insert('workExperience', $data);
	}

	public function updateWorkExperience($data, $workExperience){
		$this->db->where('workExperienceID', $workExperience);
		return $this->db->update('workExperience', $data);
	}



/////////////////////////////////////////////////////////////////



///////////////////////////Skills////////////////////////////////

	public function getActiveSkills(){
		$result = $this->db->get_where('skills', array('active' => 1));
		return $result->result_array();
	}

	public function getNotAddedSkills($userID){
		$this->db->select('skillID');
		$result = $this->db->get_where('userSkills', array('userID'=>$userID));
		// echo "string";
		// var_dump($result);die;
		$i = 0;
		$result1 = $result->result_array();
		if($result->num_rows()>0){
		foreach ($result1 as $key => $value) {
			$res[$i] = $value['skillID'];
			$i++;
		}

		$this->db->where_not_in('skillID',$res);
		}
		$result = $this->db->get_where('skills', array('active' => 1));
		return $result->result_array();
	}

	public function getPremiumSkills($userID){
		$this->db->join('skills','skills.skillID = userSkills.skillID');
		$result = $this->db->get_where('userSkills', array('type' => 2, 'userID' => $userID));
		return $result->result_array();
	}

	public function getUserSkills($userID){
		$this->db->select('userSkills.skillID, skill_name, userSkills.type, userSkills.score');
		$this->db->join('skills','skills.skillID = userSkills.skillID');
		$result = $this->db->get_where('userSkills', array('userID' => $userID, 'userSkills.score>=' => 10));
		return $result->result_array();
	}

	public function getOtherSkills($userID){
		$this->db->join('skills','skills.skillID = userSkills.skillID');
		$result = $this->db->get_where('userSkills', array('type' => 1, 'userID' => $userID));
		return $result->result_array();
	}

	public function getTestSettings($skillID){
		return $this->db->get_where('testSettings', array('skillID' => $skillID))->result_array();
	}

	public function getSkillData($skill_id)
	{
		$this->db->select('*');
		$this->db->where('skillID', $skill_id);
		return $this->db->get('skills')->result_array();
	}

	public function getQuestionDetails($level, $skillID, $max = 0){
		$this->db->select('question_id, question, option1, option2, option3, option4, expert_time');
		$this->db->where('difficulty_level', $level);
		if(!empty($_SESSION['userData'][$skillID]['responses']))
		$this->db->where_not_in('question_id', $_SESSION['userData'][$skillID]['responses']);
		$this->db->where('skill_id', $skillID);
		$this->db->order_by('RAND()');
		$result = $this->db->get('skillQuestions',1);
		if(empty($result->result_array())){
			if($level <= 0){
				return false;
			}
			if($level<8){
				if($max == 0){
					$level++;
					return $this->getQuestionDetails($level, $skillID, $max);
				}else{
					$level--;
					return $this->getQuestionDetails($level, $skillID, 1);
				}
			}elseif($level == 8){
				$level-- ;
				return $this->getQuestionDetails($level, $skillID, 1);
			}
		}
		return $result->result_array();
	}

	public function getAnswer($questionID){
		$this->db->select('answer');
		$this->db->where('question_id', $questionID);
		return $this->db->get('skillQuestions')->result_array();
	}

	public function updateResponse($data){
		return $this->db->insert('skillResponses', $data);
	}

	public function addSkilltoUser($skill_id, $user_id, $score){
		$data = ['skillID'=> $skill_id, 'userID'=> $user_id, 'score'=> $score, 'status'=> 4, 'type' => 1];
		// var_dump($data);die;
		return $this->db->insert('userSkills', $data);
	}

	public function testAvailable($skillID){
		$this->db->select('testAvailable');
		$result = $this->db->get_where('skills', array('skillID'=>$skillID))->result_array();
		return $result[0]['testAvailable'];
	}

	public function getSkills(){
		$result = $this->db->get_where('skills', array('active'=>1));
		return $result->result_array();
	}

	public function getResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('skillQuestions', 'skillQuestions.question_id = skillResponses.questionID');
		$result = $this->db->get_where('skillResponses', array('skillQuestions.skill_id'=> $skillID, 'skillResponses.userID' => $userID))->result_array()[0];
		return $result;
	}

	public function getCorrectResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('skillQuestions', 'skillQuestions.question_id = skillResponses.questionID');
		$result = $this->db->get_where('skillResponses', array('skillQuestions.skill_id'=> $skillID, 'skillResponses.userID' => $userID, 'skillResponses.correct' => 1))->result_array()[0];
		return $result;
	}

	public function getIncorrectResponses($userID, $skillID){
		$this->db->select('count(*) as responses');
		$this->db->join('skillQuestions', 'skillQuestions.question_id = skillResponses.questionID');
		$result = $this->db->get_where('skillResponses', array('skillQuestions.skill_id'=> $skillID, 'skillResponses.userID' => $userID, 'skillResponses.correct' => 0))->result_array()[0];
		return $result;
	}

	public function getSkillMax($skillID){
		$this->db->select('max(score) as max');
		$result = $this->db->get_where('userSkills', array('skillID' => $skillID))->result_array()[0];
		return $result;
	}

	public function skillAdded($userID, $skillID){
		$result = $this->db->get_where('userSkills', array('userID' => $userID, 'skillID' => $skillID));
		if($result->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


////////////////////////////////////////////////////////////



///////////////////////////OFFERS///////////////////////////


	public function addOffer($data){
		return $this->db->insert('offers', $data);
	}

	public function updateOffer($offerID, $data){
		$this->db->where('offerID', $offerID);
		return $this->db->update('offers', $data);
	}

	public function getCurrentofferID($userID){
		$this->db->select('offerID');
		$this->db->order_by('offerID', 'DESC');
		return $this->db->get_where('offers', array('addedBy'=> $userID), 1)->result_array()[0]['offerID'];
	}


	public function addOfferSkills($data){
		// var_dump($data);
		foreach ($data as $key => $value) {
			if($this->db->insert('offerSkills', $value)){
				continue;
			}else{
				$c = 1;
				break;
			}
		}
		if(isset($c) && $c == 1){
			return false;
		}else{
			return true;
		}

	}

	public function addOfferLocation($data){
		foreach ($data as $key => $value) {
			if($this->db->insert('offerLocation', $value)){
				continue;
			}else{
				$c = 1;
				break;
			}
		}
		if(isset($c) && $c == 1){
			return false;
		}else{
			return true;
		}

	}

	public function getAddedOffers($userID, $offset, $limit){
		$this->db->select('offerID, offerType, offerTitle, applicationDeadline, joiningDate, approved, rejectMessage');
		$this->db->limit($limit, $offset);
		$this->db->order_by('offerID','DESC');
		$result = $this->db->get_where('offers', array('addedBy'=>$userID))->result_array();
		// var_dump($this->db->last_query()); die;,
		return $result;
	}


	public function getOfferDetails($offerID){
		$result = $this->db->get_where('offers', array('offerID'=>$offerID))->result_array();
		return $result;
	}

	public function hasMoreOffers($userID, $limit, $offset){
		$this->db->limit($limit, $offset);
		$result = $this->db->get_where('offers', array('addedBy'=>$userID));
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getAppliedOffers($userID, $offset, $limit, $status = 0){
		$this->db->select('applicants.offerID, offerType, offerTitle, applicationDeadline, joiningDate, status, companyName, companyLogo, remark');
		$this->db->limit($limit, $offset);
		$this->db->join('offers','applicants.offerID = offers.offerID');
		$this->db->join('employers', 'offers.addedBy = employers.userID');
		$this->db->order_by('offerID','DESC');
		if($status != 0)
			$this->db->where('status', $status);
		$result = $this->db->get_where('applicants', array('applicants.userID'=>$userID))->result_array();
		// var_dump($this->db->last_query()); die;
		return $result;
	}

	public function hasMoreAppliedOffers($userID, $limit, $offset, $status = 0){
		$this->db->limit($limit, $offset);
		if($status != 0)
			$this->db->where('status', $status);
		$result = $this->db->get_where('applicants', array('userID'=>$userID));
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getAllOffers($offset, $limit){
		$this->db->select('offerID, offerType, offerTitle, applicationDeadline, joiningDate, companyName, companyLogo');
		$this->db->join('employers', 'offers.addedBy = employers.userID');
		$this->db->limit($limit, $offset);
		$this->db->order_by('offerID','DESC');
		$result = $this->db->get_where('offers', array('active' => 1, 'approved' => 1))->result_array();
		// var_dump($this->db->last_query()); die;,
		return $result;
	}

	public function hasMoreUserOffers($limit, $offset){
		$this->db->limit($limit, $offset);
		$result = $this->db->get_where('offers', array('active' => 1, 'approved' => 1));
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}


	public function getOfferSkills($offerID){
		$this->db->select('offerSkills.skillID, skills.skill_name');
		$this->db->join('skills', 'offerSkills.skillID = skills.skillID');
		$result = $this->db->get_where('offerSkills', array('offerID' => $offerID))->result_array();
		return $result;
	}

	public function getOfferLocations($offerID){
		$this->db->select('offerLocation.cityID, indianCities.city, indianCities.state');
		$this->db->join('indianCities', 'offerLocation.cityID = indianCities.cityID');
		$result = $this->db->get_where('offerLocation', array('offerID' => $offerID))->result_array();
		return $result;
	}

	public function checkAlreadyApplied($offerID, $userID){
		$result = $this->db->get_where('applicants', array('offerID' => $offerID, 'userID' => $userID));
		if($result->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}

	public function insertApplicationData($data){
		return $this->db->insert('applicants', $data);
	}

	public function deleteSkillsLocations($offerID){
		$this->db->where('offerID', $offerID);
		$result1 = $this->db->delete('offerLocation');
		$this->db->where('offerID', $offerID);
		$result2 = $this->db->delete('offerSkills');
		if($result1 && $result2){
			return true;
		}else{
			return false;
		}
	}

	public function getAllOfferLocations(){
		$this->db->select('DISTINCT(offerLocation.cityID),city,state');
		$this->db->join('indianCities','offerLocation.cityID = indianCities.cityID');
		$result = $this->db->get('offerLocation');
		return $result->result_array();
	}

	public function getAllColleges(){
		$result = $this->db->get_where('colleges', array('active' => 1));
		return $result->result_array();
	}

	public function getAllCourses(){
		$result = $this->db->get_where('courses', array('active' => 1));
		return $result->result_array();
	}

	public function getAllOfferSkills(){
		$this->db->select('DISTINCT(offerSkills.skillID), skill_name');
		$this->db->join('skills','offerSkills.skillID = skills.skillID');
		$result = $this->db->get('offerSkills');
		return $result->result_array();
	}

	public function getAllApplicantOfferLocations($offerID){
		$this->db->select('DISTINCT(users.cityID), city, state');
		$this->db->join('users','applicants.userID = users.userID', 'left');
		$this->db->join('indianCities','users.cityID = indianCities.cityID', 'left');
		$result = $this->db->get_where('applicants', array('applicants.offerID' => $offerID));
		return $result->result_array();
	}

	public function getAllApplicantOfferSkills($offerID){
		$this->db->select('DISTINCT(userSkills.skillID), skill_name');
		$this->db->join('userSkills','applicants.userID = userSkills.userID', 'left');
		$this->db->join('skills','userSkills.skillID = skills.skillID', 'left');
		$result = $this->db->get_where('applicants', array('applicants.offerID' => $offerID, 'userSkills.score>=' => 10));
		return $result->result_array();
	}

	public function getAllApplicantColleges($offerID){
		$this->db->select('DISTINCT (instituteID), college');
		$this->db->join('educationalDetails', 'applicants.userID = educationalDetails.userID', 'left');
		$this->db->join('colleges', 'educationalDetails.instituteID = colleges.college_id', 'left');
		$result = $this->db->get_where('applicants', array('applicants.offerID' => $offerID));
		return $result->result_array();
	}

	public function getAllApplicantCourses($offerID){
		$this->db->select('DISTINCT (courseID), course');
		$this->db->join('educationalDetails', 'applicants.userID = educationalDetails.userID', 'left');
		$this->db->join('courses', 'educationalDetails.courseID = courses.course_id', 'left');
		$result = $this->db->get_where('applicants', array('applicants.offerID' => $offerID));
		return $result->result_array();
	}

	public function getFilteredOffers($offset, $limit, $offerType, $offerSkills, $offerLocations){
		$this->db->select('offers.offerID, offerType, offerTitle, applicationDeadline, joiningDate');
		$this->db->limit($limit, $offset);
		if(!empty($offerType))
			$this->db->where_in('offerType',$offerType);
		if(!empty($offerSkills)){
			$this->db->where_in('skillID',$offerSkills);
			$this->db->join('offerSkills','offers.offerID = offerSkills.offerID');
		}
		if(!empty($offerLocations)){
			$this->db->where_in('cityID',$offerLocations);
			$this->db->join('offerLocation','offers.offerID = offerLocation.offerID');
		}
		$result = $this->db->get('offers')->result_array();
		// var_dump($this->db->last_query());die;
		return $result;
	}

	public function hasMoreFilteredOffers($limit, $offset, $offerType, $offerSkills, $offerLocations){
		$this->db->limit($limit, $offset);
		if(!empty($offerType))
			$this->db->where_in('offerType',$offerType);
		if(!empty($offerSkills)){
			$this->db->where_in('skillID',$offerSkills);
			$this->db->join('offerSkills','offers.offerID = offerSkills.offerID');
		}
		if(!empty($offerLocations)){
			$this->db->where_in('cityID',$offerLocations);
			$this->db->join('offerLocation','offers.offerID = offerLocation.offerID');
		}
		$result = $this->db->get_where('offers');
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function checkOfferStatus($offerID){
		$this->db->select('approved');
		return $this->db->get_where('offers', array('offerID'=>$offerID))->result_array()[0]['approved'];
	}
///////////////////////////////////////////////////////////


	public function contactUs($data){
		return $this->db->insert('contactMessages', $data);
	}

	public function checkResetPasswordToken($email){
			$this->db->order_by('passwordTokenID', 'DESC');
			$result = $this->db->get_where('resetPasswordTokens', array('email' => $email, 'active'=>'1'), '1');
			return $result->result_array();
	}

	public function checkResetToken($email, $token){
			$this->db->order_by('passwordTokenID', 'DESC');
			$result = $this->db->get_where('resetPasswordTokens', array('email' => $email, 'token' => $token, 'active'=>'1'), '1');
			return $result->result_array();
	}

	public function insertResetPasswordToken($data){
		return $this->db->insert('resetPasswordTokens', $data);
	}

	public function resetActivePasswordResetToken($email, $token){
		$query = "UPDATE resetPasswordTokens SET active= 0 WHERE email='$email' AND token='$token'";
		return $this->db->query($query);
	}

	public function insertCollege($data){
		return $this->db->insert('colleges', $data);
	}

	public function getCollegeID($college){
		$result = $this->db->get_where('colleges', array('college'=>$college))->result_array();
		return $result[0]['college_id'];
	}

	public function getUserIDForEducation($id){
		$result = $this->db->get_where('educationalDetails', array('educationID' => $id))->result_array();
		// var_dump($result); die;
		return $result[0]['userID'];
	}

	public function getUserIDForExperience($id){
		$result = $this->db->get_where('workExperience', array('workExperienceID' => $id))->result_array();
		return $result[0]['userID'];
	}

	public function getUserIDForOffer($id){
		$result = $this->db->get_where('offers', array('offerID' => $id))->result_array();
		return $result[0]['userID'];
	}

	public function shortlistCandidate($userID, $offer){
		$this->db->set('status', '3');
		$this->db->where(array('userID' => $userID, 'offerID' => $offer));
		$result = $this->db->update('applicants');
		return $result;
	}

	public function rejectCandidate($userID, $offer, $remark){
		$data = array(
			'status'=> '4',
			'remark'=>$remark
		);
		$this->db->where(array('userID' => $userID, 'offerID' => $offer));
		$result = $this->db->update('applicants', $data);
		return $result;
	}

	public function removeFromReject($userID, $offer){
		$this->db->set('status', '3');
		$this->db->where(array('userID' => $userID, 'offerID' => $offer));
		$result = $this->db->update('applicants');
		return $result;
	}

	public function selectCandidate($userID, $offer){
		$this->db->set('status', '2');
		$this->db->where(array('userID' => $userID, 'offerID' => $offer));
		$result = $this->db->update('applicants');
		return $result;
	}

	public function getCandidateDetails($userID){
		$result = $this->db->get_where('users', array('userID' => $userID));
		return $result->result_array();
	}

	public function isOfferAcceptedAndActive($offerID){
		$result = $this->db->get_where('offers', array('offerID' => $offerID, 'active' => 1, 'approved'=>1));
		if($result->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function getApplicantSkills($userID){
		$this->db->select('userSkills.skillID, skills.skill_name');
		$this->db->join('skills', 'userSkills.skillID = skills.skillID');
		$result = $this->db->get_where('userSkills', array('userID' => $userID, 'score>=' => 10))->result_array();
		// var_dump($this->db->last_query());
		return $result;
	}

	public function getApplicantLocations($userID){
		$this->db->select('users.cityID, indianCities.city, indianCities.state');
		$this->db->join('indianCities', 'users.cityID = indianCities.cityID');
		$result = $this->db->get_where('users', array('userID' => $userID))->result_array();
		return $result;
	}

	public function getApplicantColleges($userID){
		$this->db->select('educationalDetails.instituteID, colleges.college');
		$this->db->join('colleges', 'educationalDetails.instituteID = colleges.college_id');
		$result = $this->db->get_where('educationalDetails', array('userID' => $userID))->result_array();
		return $result;
	}

	public function getApplicantCourses($userID){
		$this->db->select('educationalDetails.courseID, courses.course');
		$this->db->join('courses', 'educationalDetails.courseID = courses.course_id');
		$result = $this->db->get_where('educationalDetails', array('userID' => $userID))->result_array();
		return $result;
	}

	public function getCurrentApplicantStatus($userID){
		$this->db->select('status');
		$result = $this->db->get_where('applicants', array('userID'=> $userID));
		// var_dump($this->db->last_query());die;
		return $result->result_array();
	}

	public function getUserOfferDetails($offerID, $userID){
		$result = $this->db->get_where('applicants', array('offerID' => $offerID, 'userID' => $userID));
		return $result->result_array();
	}

	public function isOfferApplicant($userID, $offerID){
		$result = $this->db->get_where('applicants', array('offerID' => $offerID, 'userID' => $userID));
		if($result->num_rows()> 0){
			return true;
		}else{
			return false;
		}
	}
}
