<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Function_lib {

	public function login($email,$password){
		$CI =& get_instance();
		$CI->load->model('function_model','function');
		$result = $CI->function->login($email,$password);
		$userData = $CI->function->getUserData($email);
		if ($result) {
			$data = array(
				'loggedIn' => true,
				'userID' => $userData[0]['userID'],
				'email' => $email,
				'mobile' => $userData[0]['mobile'],
				'name' => $userData[0]['name'],
				'profileImage'	=>	$userData[0]['profileImage'],
				'accountType' => $userData[0]['accountType'],
				'emailVerified' => $userData[0]['emailVerified'],
				'mobileVerified' => $userData[0]['mobileVerified']
				);
			$CI->session->set_userdata('user_data', $data);
			return 1;
		}
		return 0;
	}


	public function updateEmailVerified(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateEmailVerified();
	}

	public function updateMobileVerified(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateMobileVerified();
	}

	public function checkOfferStatus($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkOfferStatus($offerID);
	}

	public function getEmailVerificationCode(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getEmailVerificationCode();
	}

	public function getMobileVerificationCode(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getMobileVerificationCode();
	}

	public function updateEmail($email){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateEmail($email);
	}

	public function updateMobile($mobile){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateMobile($mobile);
	}

	public function auth(){
		$CI = & get_instance();
		$CI->load->library('session');
		$data = $CI->session->userdata('user_data');
		if (isset($data['loggedIn']) && $data['loggedIn']) {
			return 1;
		}
		return 0;
	}

	public function insertCompanyData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->insertCompanyData($userID);
	}

	public function getCompanyData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCompanyData($userID);
	}

	public function getPreferredLocations($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getPreferredLocations($userID);
	}


	public function getUserGeneralData($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserGeneralData($userID);
	}

	public function getUserEducationalDetails($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserEducationalDetails($userID);
	}

	public function getUserWorkExperience($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserWorkExperience($userID);
	}

	public function insertPreferredLocation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->insertPreferredLocation($data);
	}

	public function checkPreferredLocationUnique($location, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkPreferredLocationUnique($location, $userID);
	}

	public function deletePreferredLocation($location, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deletePreferredLocation($location, $userID);
	}

	public function isUserPreferredLocation($location, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->isUserPreferredLocation($location, $userID);
	}

	public function deleteEducationalDetail($education){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deleteEducationalDetail($education);
	}

	public function deleteWorkExperience($experience){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deleteWorkExperience($experience);
	}

	public function getColleges(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getColleges();
	}


	public function getCourses(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCourses();
	}


	public function getAllLocations(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllLocations();
	}

	public function updateGeneralDetails($data, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateGeneralDetails($data, $userID);
	}

	public function updateCompanyDetails($data, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateCompanyDetails($data, $userID);
	}

	public function uploadImage($image, $type ,$path = 'assets/images/'){
		if(empty($image)){
			return false;
		}
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		var_dump(base_url());
		$upload_path = $path;
		$name = $CI->function->getFilename($type,$_SESSION['user_data']['userID']);
		$upload_path .= $name.'_'.str_replace(['-',':'],'',(new DateTime())->format('d-m-YH:i:s')).'.jpg';
		$ifp = fopen($upload_path, "wb");
		$data = explode(',', $image);
		fwrite($ifp, base64_decode($data[1]));
		fclose($ifp);
		if($this->validateImage($upload_path)){
			if($type == 'company' ){
				$logo['companyLogo'] = $upload_path;
				return $CI->function->updateCompanyLogo($_SESSION['user_data']['userID'], $logo);
			}else{
				$picture['profileImage'] = $upload_path;
				return $CI->function->updateProfileImage($_SESSION['user_data']['userID'], $picture);
			}
		}else{
			return false;
		}
		return false;
	}

	public function getOfferApplicants($driveID, $offset = 0, $limit = 10, $type = 1){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferApplicants($driveID, $offset, $limit, $type);
	}

	public function getOfferApplicantSkills($driveID, $offset = 0, $limit = 10, $type = 1){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferApplicantSkills($driveID, $offset, $limit, $type);
	}

	public function validateImage($file)
	{
		$data = getimagesize($file);
		if($data[0] > 400 || $data[1] > 400){
			$this->set_flashdata('error', 'Image dimensions must be under 300 * 300.');
			return false;
		}else if(filesize($file) > 2048000){
			$this->set_flashdata('error', 'The file size must be under 2MB.');
			return false;
		}else{
			return true;
		}
	}

	public function checkEMailExist($email){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkEMailExist($email);
	}

	public function checkMobileExist($mobile){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkMobileExist($mobile);
	}

	public function register($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->register($data);
	}

	public function getUserData($email){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserData($email);
	}

	public function getUserDataFromID($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserDataFromID($userID);
	}

	public function addOffer($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOffer($data);
	}

	public function updateOffer($offerID, $data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateOffer($offerID, $data);
	}

	public function checkPasswordMatch($email, $password){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkPasswordMatch($email, $password);
	}

	public function changePassword($email, $password){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->changePassword($email, $password);
	}

	public function checkEducationUnique($userID, $type){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkEducationUnique($userID, $type);
	}

	public function addEducation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addEducation($data);
	}

	public function addWorkExperience($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addWorkExperience($data);
	}

	public function updateEducation($data, $id){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateEducation($data, $id);
	}

	public function updateWorkExperience($data, $id){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->updateWorkExperience($data, $id);
	}


	public function getSkills(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getSkills();
	}

	public function getCurrentOfferID($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCurrentOfferID($userID);
	}

	public function addOfferSkills($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOfferSkills($data);
	}

	public function addOfferLocation($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->addOfferLocation($data);
	}

	public function getAddedOffers($userID, $offset, $limit){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAddedOffers($userID, $offset, $limit);
	}

	public function hasMoreOffers($userID, $limit, $offset){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreOffers($userID, $limit, $offset);
	}

	public function getAppliedOffers($userID, $offset, $limit, $status){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAppliedOffers($userID, $offset, $limit, $status);
	}

	public function hasMoreAppliedOffers($userID, $limit, $offset, $status){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreAppliedOffers($userID, $limit, $offset, $status);
	}

	public function getAllOffers($offset, $limit){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllOffers($offset, $limit);
	}

	public function hasMoreUserOffers($limit, $offset){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreUserOffers($limit, $offset);
	}

	public function getOfferSkills($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferSkills($offerID);
	}

	public function getOfferDetails($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferDetails($offerID);
	}

	public function getOfferLocations($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOfferLocations($offerID);
	}

	public function contactUs($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->contactUs($data);
	}

	public function checkAlreadyApplied($offerID, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->checkAlreadyApplied($offerID, $userID);
	}

	public function insertApplicationData($data){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->insertApplicationData($data);
	}

	public function deleteSkillsLocations($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->deleteSkillsLocations($offerID);
	}

	public function getAllOfferLocations(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllOfferLocations();
	}

	public function getAllOfferSkills(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllOfferSkills();
	}

	public function getAllApplicantColleges($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllApplicantColleges($offerID);
	}

	public function getAllApplicantCourses($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllApplicantCourses($offerID);
	}

	public function getAllApplicantOfferLocations($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllApplicantOfferLocations($offerID);
	}

	public function getAllApplicantOfferSkills($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getAllApplicantOfferSkills($offerID);
	}

	public function getFilteredOffers($offset, $limit, $offerType, $offerSkills, $offerLocations){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getFilteredOffers($offset, $limit, $offerType, $offerSkills, $offerLocations);
	}

	public function hasMoreFilteredOffers($limit, $offset, $offerType, $offerSkills, $offerLocations){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreFilteredOffers($limit, $offset, $offerType, $offerSkills, $offerLocations);
	}

	public function checkResetPasswordToken($email){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->checkResetPasswordToken($email);
	}

	public function checkResetToken($email, $token){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->checkResetToken($email, $token);
	}

	public function insertResetPasswordToken($data){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->insertResetPasswordToken($data);
	}

	public function resetActivePasswordResetToken($email, $token){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->resetActivePasswordResetToken($email, $token);
	}

	public function insertCollege($data){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->insertCollege($data);
	}

	public function getCollegeID($college){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->getCollegeID($college);
	}

	public function getUserIDForEducation($id){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->getUserIDForEducation($id);
	}

	public function getUserIDForExperience($id){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->getUserIDForExperience($id);
	}

	public function getUserIDForOffer($id){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->getUserIDForOffer($id);
	}

	public function skillAdded($userID, $skillID){
		$CI = &get_instance();
		$CI->load->model('function_model','functionModel');
		return $CI->functionModel->skillAdded($userID, $skillID);
	}


	public function shortlistCandidate($userID, $offer){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->shortlistCandidate($userID, $offer);
	}

	public function rejectCandidate($userID, $offer, $remark){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->rejectCandidate($userID, $offer, $remark);
	}

	public function removeFromReject($userID, $offer){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->removeFromReject($userID, $offer);
	}

	public function selectCandidate($userID, $offer){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->selectCandidate($userID, $offer);
	}

	public function getCandidateDetails($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCandidateDetails($userID);
	}

	public function hasMoreOfferApplicants($offerID, $offset, $limit, $type = 1){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->hasMoreOfferApplicants($offerID, $offset, $limit, $type);
	}

	public function isOfferAcceptedAndActive($offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->isOfferAcceptedAndActive($offerID);
	}

	public function getApplicantSkills($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getApplicantSkills($userID);
	}

	public function getApplicantLocations($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getApplicantLocations($userID);
	}

	public function getApplicantColleges($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getApplicantColleges($userID);
	}

	public function getApplicantCourses($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getApplicantCourses($userID);
	}

	public function getCurrentApplicantStatus($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getCurrentApplicantStatus($userID);
	}

	public function getUserOfferDetails($offerID, $userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserOfferDetails($offerID, $userID);
	}

	public function isOfferApplicant($userID, $offerID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->isOfferApplicant($userID, $offerID);
	}

}
