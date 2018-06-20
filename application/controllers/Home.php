<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib', 'skill_lib'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['headerFiles'] =  $this->load->view('commonCode/headerFiles',$this->data,true);
		$this->data['footerFiles'] =  $this->load->view('commonCode/footerFiles',$this->data,true);
		$this->data['nav'] =  $this->load->view('commonCode/nav',$this->data,true);
		$this->data['footer'] =  $this->load->view('commonCode/footer',$this->data,true);
		$this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
		$this->data['csrf_token'] = $this->security->get_csrf_hash();

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}


	public function pageNotFound(){
		$this->load->view('404', $this->data);
	}

	public function index(){
		if($this->function_lib->auth()){
			redirect(base_url('general-details'));
		}
		else{
			$this->data['pageTitle'] = "CampusPuppy";
			$this->load->view('home', $this->data);
		}
	}

	public function resetPassword(){
		if($this->function_lib->auth()){
			redirect(base_url('general-details'));
		}
		else{
			$this->data['pageTitle'] = "Reset Password";
			$this->load->view('resetPassword', $this->data);
		}
	}


	public function emailer(){
			$this->load->view('emailers/offers', $this->data);
	}


	public function verifyContactDetails(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				redirect(base_url('general-details'));
			}
			else{
				$this->data['pageTitle'] = "Verify Contact Details";
				$this->data['activePage'] = "0";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				if($_SESSION['user_data']['emailVerified'] == '0'){
					if(!(isset($_SESSION['sentVerificationEmail']) && $_SESSION['sentVerificationEmail'] == 1)){
						$this->generateVerificationCode(2);
						$_SESSION['sentVerificationEmail'] = 1;
					}
				}
				if($_SESSION['user_data']['mobileVerified'] == '0'){
					if(!(isset($_SESSION['sentVerificationSMS']) && $_SESSION['sentVerificationSMS'] == 1)){
						$this->generateVerificationCode(1);
						$_SESSION['sentVerificationSMS'] = 1;
					}
				}
				$this->load->view('verifyContactDetails', $this->data);
			}
		}
		else{
			redirect(base_url());
		}

	}

	public function resendCode($type){
		$this->generateVerificationCode($type);
		redirect(base_url('verify-contact-details'));
	}

	public function generalDetails(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "General Details";
				$this->data['activePage'] = "2";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['generalData'] = $this->function_lib->getUserData($_SESSION['user_data']['email']);
				$this->data['generalData'] = $this->data['generalData'][0];
				if($_SESSION['user_data']['accountType'] == 2)
					$this->data['companyData'] = $this->function_lib->getCompanyData($this->data['generalData']['userID']);
				$this->data['locations'] = $this->function_lib->getAllLocations();
				$this->data['preferredLocation'] = $this->function_lib->getPreferredLocations($_SESSION['user_data']['userID']);
				$this->load->view('generalDetails', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}

	}


	public function skills(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Skills";
				$this->data['activePage'] = "3";
				if(!empty($x = $this->skill_lib->getPremiumSkills($_SESSION['user_data']['userID'])))
					$this->data['premiumSkills'] = $x;
				else
					$this->data['premiumSkills'] = null;
				if(!empty($x = $this->skill_lib->getOtherSkills($_SESSION['user_data']['userID'])))
					$this->data['otherSkills'] = $x;
				else
					$this->data['otherSkills'] = null;
				// var_dump($x);die;
				if(!empty($x = $this->skill_lib->getNotAddedSkills($_SESSION['user_data']['userID'])))
					$this->data['skills'] = $x;
				else
					$this->data['skills'] = null;
				// var_dump($x);die;
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('skills', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function skillTest(){
		if($this->function_lib->skillAdded($_SESSION['user_data']['userID'], $_SESSION['userData']['currentSkill'])){
			$this->session->set_flashdata('message', array('content'=>'This Skill has already been added to your profile.','color'=>'red'));
			redirect(base_url('skills'));
		}
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				if($_SESSION['userData']['intest']){
				// if(false){
					$_SESSION['questionData'] = NULL;
					$skill_id = $_SESSION['userData']['currentSkill'];
					$_SESSION['userData']['currentSkill'] = NULL;
					$_SESSION['userData']['currentSkillName'] = NULL;
					$_SESSION['userData'][$skill_id]['totalScore'] = NULL;
					$_SESSION['userData'][$skill_id]['skips'] = NULL;
					$_SESSION['userData'][$skill_id]['skipStatus'] = NULL;
					$_SESSION['userData'][$skill_id]['totalTime'] = NULL;
					$_SESSION['userData'][$skill_id]['responses'] = NULL;
					$_SESSION['userData']['intest'] = false;
					$this->session->set_flashdata('message', array('content'=>'Page Reload Not allowed During test.','color'=>'red'));
					redirect(base_url('skills'));
				}
				$_SESSION['userData']['intest'] = true;
				$this->data['skillData']['skillID'] = $_SESSION['userData']['currentSkill'];
				$this->data['skillData']['skillName'] = $_SESSION['userData']['currentSkillName'];
				$this->data['questionData'] = $_SESSION['questionData'];
				$totalTime = $_SESSION['userData'][$_SESSION['userData']['currentSkill']]['totalTime'];
				$this->data['totalTime'] = $totalTime;
				$this->data['skips'] = $_SESSION['userData'][$_SESSION['userData']['currentSkill']]['skips'];
				$this->data['pageTitle'] = "Skill Test";
				$this->data['activePage'] = "3";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('skillTest', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function skillTestGuidelines(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Skill Test Guidelines";
				$this->data['activePage'] = "3";
				$this->data['skill'] = $_SESSION['userData']['currentSkill'];
				$this->data['settings'] = $this->skill_lib->getTestSettings($_SESSION['userData']['currentSkill'])[0];
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('skillTestGuidelines', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function educationalDetails(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Educational Details";
				$this->data['activePage'] = "4";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['educations'] = $this->function_lib->getUserEducationalDetails($_SESSION['user_data']['userID']);
				$this->data['colleges'] = $this->function_lib->getColleges();
				$this->data['courses'] = $this->function_lib->getCourses();
				$this->load->view('educationalDetails', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function workExperience(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Work Experience";
				$this->data['activePage'] = "5";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['workExperience'] = $this->function_lib->getUserWorkExperience($_SESSION['user_data']['userID']);
				$this->load->view('workExperience', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function resume(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Resume";
				$this->data['activePage'] = "6";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['resumeReferenceNumber'] = $this->function_lib->getUserData($_SESSION['user_data']['email']);
				$this->data['userID'] = $this->data['resumeReferenceNumber'][0]['userID'];
				$this->data['resumeReferenceNumber'] = $this->data['resumeReferenceNumber'][0]['resumeReferenceNumber'];
				$this->load->view('resume', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function changePassword(){
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Change Password";
				$this->data['activePage'] = "7";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('changePassword', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function addNewOffer(){
		$companyData = $this->function_lib->getCompanyData($_SESSION['user_data']['userID']);
		if($companyData['companyName'] == NULL || $companyData['companyName'] == ''){
			$this->session->set_flashdata('message', array('content'=>'Please Enter Company Details to add offers.','color'=>'red'));
			redirect(base_url('general-details'));
		}
		if($_SESSION['user_data']['accountType'] == 1){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Add New Offer";
				$this->data['activePage'] = "9";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['skills'] = $this->function_lib->getSkills();
				$this->data['locations'] = $this->function_lib->getAllLocations();
				if(isset($_SESSION['redirect']))
					$this->data['redirect'] = $_SESSION['redirect'];
				unset($_SESSION['redirect']);
				$this->load->view('addNewOffer', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function editOffer($offerID){
		if($_SESSION['user_data']['accountType'] == 1){redirect(base_url());}
		if($this->function_lib->auth()){
			if($this->function_lib->checkOfferStatus($offerID) == 0){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Edit Offer";
				$this->data['activePage'] = "9";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->data['skills'] = $this->function_lib->getSkills();
				$this->data['locations'] = $this->function_lib->getAllLocations();
				if(!empty($this->function_lib->getOfferDetails($offerID))){
					$this->data['redirect'] = $this->function_lib->getOfferDetails($offerID)[0];
					if($this->data['redirect']['addedBy'] != $_SESSION['user_data']['userID']){
						// $this->session->set_flashdata('message', array('content'=>'Something went Wrong or Broken Link.','color'=>'red'));
						redirect(base_url('404'));
					}
					if(isset($this->data['redirect']['compensation'])){
						$this->data['redirect']['compensationType'] = 1;
					}else if(isset($this->data['redirect']['minCompensation']) || isset($this->data['redirect']['maxCompensation'])){
						$this->data['redirect']['compensationType'] = 2;
					}else{
						$this->data['redirect']['compensationType'] = 3;
					}
					$this->data['redirect']['workHome'] = $this->data['redirect']['workFromHome'];
					$this->data['redirect']['applicantType'] = $this->data['redirect']['skillRequired'];
					if($offerSkills = $this->function_lib->getOfferSkills($offerID))
						$this->data['redirect']['selectedSkills'] = json_encode($offerSkills);
					else
						$this->data['redirect']['selectedSkills'] = array();

					if($offerLocations = $this->function_lib->getOfferLocations($offerID)){
						$i=0;
						foreach ($offerLocations as $key => $locations) {
							$offers[$i]['locationID'] = $locations['cityID'];
							$offers[$i]['location_name'] = $locations['city'].', '.$locations['state'];
							$i++;
						}
						$offerLocations = $offers;
						$this->data['redirect']['location'] = json_encode($offerLocations);
					}else{
						$this->data['redirect']['location'] = array();
					}
				$this->data['edit'] = 1;
				}else{
					redirect(base_url('add-new-offer'));
				}
				$this->load->view('addNewOffer', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}else{
			// $this->session->set_flashdata('message', array('content'=>'Something went Wrong or Broken Link','color'=>'red'));
			redirect(base_url('404'));
		}
	}else{
			redirect(base_url());
		}
	}

	public function myAddedOffers(){
		if($_SESSION['user_data']['accountType'] == 1){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "My Added Offers";
				$this->data['activePage'] = "8";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$offers = $this->function_lib->getAddedOffers($_SESSION['user_data']['userID'],0,10);
				$this->data['hasMore'] = $this->function_lib->hasMoreOffers($_SESSION['user_data']['userID'], 10,10);
				$this->data['offers'] = $offers;
				if(!empty($offers)){
				foreach ($offers as $key => $offer) {
					if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID'])){
						$this->data['offerSkills'][$offer['offerID']] = $offerSkills;

					}
					else{
						$this->data['offerSkills'][$offer['offerID']] = array();
					}

					if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID'])){
						$this->data['offerLocations'][$offer['offerID']] = $offerLocations;

					}
					else{
						$this->data['offerLocations'][$offer['offerID']] = array();
					}
				}
				}
				$this->load->view('myAddedOffers', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function applicants($offerID){
		// if(false){
		// 	$this->session->set_flashdata('message', array('content'=>'You can access Applicants from 3rd of May to 6th of May.','color'=>'red'));
		// 	redirect(base_url('my-added-offers'));
		// }

		$offerDetails = $this->function_lib->getOfferDetails($offerID)[0];
		if($offerDetails['addedBy'] != $_SESSION['user_data']['userID']){
			$this->session->set_flashdata('message', array('content'=>'Something went wrong or Broken Link.','color'=>'red'));
			redirect(base_url('404'));
		}

		if(!$this->function_lib->isOfferAcceptedAndActive($offerID)){
			$this->session->set_flashdata('message', array('content'=>'Something went wrong. Please Try Again.','color'=>'red'));
		 	redirect(base_url('my-added-offers'));
		}


		if($_SESSION['user_data']['accountType'] == 1){redirect(base_url());}

		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Applicants";
				$this->data['activePage'] = "8";
				$this->data['offer'] = $offerID;
				$_SESSION['currentOffer']['offerID']= $offerID;
				$this->data['offerTitle'] = $this->function_lib->getOfferDetails($offerID)[0]['offerTitle'];
				$this->data['allOfferLocations'] = $this->function_lib->getAllApplicantOfferLocations($offerID);
				$this->data['allOfferSkills'] = $this->function_lib->getAllApplicantOfferSkills($offerID);
				$this->data['colleges'] = $this->function_lib->getAllApplicantColleges($offerID);
				$this->data['courses'] = $this->function_lib->getAllApplicantCourses($offerID);

				if(isset($_SESSION['filter']) && $_SESSION['filter'] == 1){
					$this->data['applicants'] = $_SESSION['data']['applicants'];
					$this->data['hasMore'] = $_SESSION['data']['hasMore'];
					if(isset($_SESSION['data']['type'])){
						$this->data['type'] = $_SESSION['data']['type'];
					}else{
						$this->data['type'] = 1;
					}
					if(isset($_SESSION['appliedFilters'])){
						$this->data['appliedFilters'] = $_SESSION['appliedFilters'];
					}
				}else{
					$this->data['applicants'] = $this->function_lib->getOfferApplicants($offerID, 0, 10, 1);
					$userSkills = $this->function_lib->getOfferApplicantSkills($offerID, 0, 10, 1);
					$applicants = array_column($userSkills, 'applicantID');
					$_SESSION['skillOffset'] = count($applicants);
					$i = 0;
					foreach ($this->data['applicants'] as $key => $value) {
							$x = array_search($value['applicantID'], $applicants);
						if(is_int($x)){
							$this->data['applicants'][$i]['skillID'] = $userSkills[$x]['skillID'];
							$this->data['applicants'][$i]['type'] = $userSkills[$x]['type'];
							$this->data['applicants'][$i]['score'] = $userSkills[$x]['score'];
							$this->data['applicants'][$i]['skillName'] = $userSkills[$x]['skillName'];
						}else{
							$this->data['applicants'][$i]['skillID'] = NULL;
							$this->data['applicants'][$i]['type'] = NULL;
							$this->data['applicants'][$i]['score'] = NULL;
							$this->data['applicants'][$i]['skillName'] = NULL;
						}
						$i++;
					}
					$this->data['hasMore'] = $this->function_lib->hasMoreOfferApplicants($offerID, 10, 10, 1);
					$this->data['type'] = 1;
				}
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('applicants', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function compareApplicants(){
		if(false){
			$this->session->set_flashdata('message', array('content'=>'You can access Compare Applicants Now.','color'=>'red'));
			redirect(base_url('hiring-nucleus/applicants/'.$_SESSION['currentOffer']['offerID']));
		}
		if(!isset($_SESSION['compare'][0]) || !isset($_SESSION['compare'][1])){
			$this->session->set_flashdata('message', array('content'=>'You need to add Two Candidates to Compare.','color'=>'red'));
			redirect(base_url('hiring-nucleus/applicants/'.$_SESSION['currentOffer']['offerID']));
		}
		if($_SESSION['user_data']['accountType'] == 1){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Compare Applicants";
				$this->data['activePage'] = "8";
				$this->data['offer'] = $_SESSION['currentOffer']['offerID'];
				$this->data['offerTitle'] = $this->function_lib->getOfferDetails($_SESSION['currentOffer']['offerID'])[0]['offerTitle'];
				if(isset($_SESSION['compare'][0])){
				$this->data['candidates']['userDetails'][0] = $this->function_lib->getUserGeneralData($_SESSION['compare'][0]);
				$this->data['candidates']['educationalDetails'][0] = $this->function_lib->getUserEducationalDetails($_SESSION['compare'][0]);
				$this->data['candidates']['status'][0] = $this->function_lib->getCurrentApplicantStatus($_SESSION['compare'][0])[0]['status'];
				$skills[0] = $this->skill_lib->getUserSkills($_SESSION['compare'][0]);
				$this->data['candidates']['skills'][0] = $skills[0];
				}else{
					$this->data['candidates'][0] = null;
				}
				if(isset($_SESSION['compare'][1])){
				$this->data['candidates']['userDetails'][1] = $this->function_lib->getUserGeneralData($_SESSION['compare'][1]);
				$this->data['candidates']['educationalDetails'][1] = $this->function_lib->getUserEducationalDetails($_SESSION['compare'][1]);
				$this->data['candidates']['status'][1] = $this->function_lib->getCurrentApplicantStatus($_SESSION['compare'][1])[0]['status'];
				$skills[1] = $this->skill_lib->getUserSkills($_SESSION['compare'][1]);
				$this->data['candidates']['skills'][1] = $skills[1];
				}else{
					$this->data['candidates'][1] = null;
				}
				$allSkills = array();
				if(!empty($skills[0]) && !empty($skills[1])){
					$candidate[0] = array_column($skills[0] ,'skillID');
					$candidate[1] = array_column($skills[1] ,'skillID');
					$skill_name[0] = array_column($skills[0], 'skill_name');
					$skill_name[1] = array_column($skills[1], 'skill_name');
					$allSkillsID = array_unique(array_merge($candidate[1], $candidate[0]));
					$allSkillName = array_unique(array_merge($skill_name[1], $skill_name[0]));
					$i = 0;
					foreach ($allSkillsID as $key => $value) {
						$allSkills[$i]['skillID'] = $value;
						$i++;
					}
					$i = 0;
					foreach ($allSkillName as $key => $value) {
							$allSkills[$i]['skillName'] = $value;
							$i++;
					}
				}else if(empty($skills[1])){
					$i = 0;
					foreach ($skills[0] as $key => $value) {
						$allSkills[$i]['skillName'] = $value['skill_name'];
						$allSkills[$i]['skillID'] = $value['skillID'];
						$i++;
					}
				}else if(empty($skills[0])){
					$i = 0;
					foreach ($skills[1] as $key => $value) {
						$allSkills[$i]['skillName'] = $value['skill_name'];
						$allSkills[$i]['skillID'] = $value['skillID'];
						$i++;
					}
				}else{
					$allSkills = array();
				}
				// var_dump($allSkills);
				// foreach ($allSkills as $key => $value) {
				// 	var_dump($value['skillID']);
				// 	echo "<br>";
				// 	var_dump($value['skillName']);
				// 	echo "<br>";
				// }
				// die;
				$this->data['allSkills'] = $allSkills;
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				$this->load->view('compareApplicants', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}



	public function appliedOffers(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Applied Offers";
				$this->data['activePage'] = "10";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				if(isset($_SESSION['filter']) && $_SESSION['filter'] == 1){
					$this->data['offers'] = $_SESSION['data']['offers'];
					$this->data['hasMore'] = $_SESSION['data']['hasMore'];
					if(!empty($_SESSION['data']['offers'])){
						$this->data['offerSkills'] = $_SESSION['data']['offerSkills'];
						$this->data['offerLocations'] = $_SESSION['data']['offerLocations'];
					}
					$this->data['status'] = $_SESSION['data']['status'];

				}else{
				unset($_SESSION['filter']);
				unset($_SESSION['data']);
				$offers = $this->function_lib->getAppliedOffers($_SESSION['user_data']['userID'],0,10,0);
				$this->data['hasMore'] = $this->function_lib->hasMoreAppliedOffers($_SESSION['user_data']['userID'],10,10,0);
				$this->data['offers'] = $offers;
				if(!empty($offers)){
				foreach ($offers as $key => $offer) {
					if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID'])){
						$this->data['offerSkills'][$offer['offerID']] = $offerSkills;
					}
					else{
						$this->data['offerSkills'][$offer['offerID']] = array();
					}
					if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID'])){
						$this->data['offerLocations'][$offer['offerID']] = $offerLocations;
					}
					else{
						$this->data['offerLocations'][$offer['offerID']] = array();
					}
				}
				}
			}
				$this->load->view('appliedOffers', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function availableOffers(){
		if($_SESSION['user_data']['accountType'] == 2){redirect(base_url());}
		if($this->function_lib->auth()){
			if($_SESSION['user_data']['emailVerified'] == '1' && $_SESSION['user_data']['mobileVerified'] == '1'){
				$this->data['pageTitle'] = "Available Offers";
				$this->data['activePage'] = "20";
				$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
				if(isset($_SESSION['filter']) && $_SESSION['filter'] == 1){
					$this->data['offers'] = $_SESSION['data']['offers'];
					$this->data['hasMore'] = $_SESSION['data']['hasMore'];
					if(!empty($_SESSION['data']['offers'])){
						$this->data['offerSkills'] = $_SESSION['data']['offerSkills'];
						$this->data['offerLocations'] = $_SESSION['data']['offerLocations'];
					}
					$this->data['allOfferLocations'] = $this->function_lib->getAllOfferLocations();
					$this->data['allOfferSkills'] = $this->function_lib->getAllOfferSkills();
					if(isset($_SESSION['data']['status'])){
						$this->data['status'] = $_SESSION['data']['status'];
						$this->data['userSkills'] = $_SESSION['data']['userSkills'];
					}
					if(isset($_SESSION['appliedFilters'])){
						$this->data['appliedFilters'] = $_SESSION['appliedFilters'];
					}
				}else{
					unset($_SESSION['appliedFilters']);
					unset($_SESSION['filter']);
					unset($_SESSION['data']);
				$offers = $this->function_lib->getAllOffers(0,10);
				$this->data['hasMore'] = $this->function_lib->hasMoreUserOffers(10,10);
				$this->data['offers'] = $offers;
				$this->data['allOfferLocations'] = $this->function_lib->getAllOfferLocations();
				$this->data['allOfferSkills'] = $this->function_lib->getAllOfferSkills();
				if(!empty($offers)){
				foreach ($offers as $key => $offer) {
					if($offerSkills = $this->function_lib->getOfferSkills($offer['offerID'])){
						$this->data['offerSkills'][$offer['offerID']] = $offerSkills;
					}
					else{
						$this->data['offerSkills'][$offer['offerID']] = array();
					}
					if($offerLocations = $this->function_lib->getOfferLocations($offer['offerID'])){
						$this->data['offerLocations'][$offer['offerID']] = $offerLocations;
					}
					else{
						$this->data['offerLocations'][$offer['offerID']] = array();
					}
				}
				}
			}
				$this->load->view('availableOffers', $this->data);
			}
			else{
				redirect(base_url('verify-contact-details'));
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function offer($offerID){
		$this->data['pageTitle'] = "Offer";
		$this->data['activePage'] = "0";
		$this->data['offerDetails'] = $this->function_lib->getOfferDetails($offerID);
		$this->data['employerDetails'] = $this->function_lib->getCompanyData($this->data['offerDetails'][0]['addedBy']);
		if(empty($this->function_lib->getOfferDetails($offerID))){
			redirect(base_url('404'));
		}
		if($this->data['offerDetails'][0]['approved'] != 1 || $this->data['offerDetails'][0]['active'] == 0){
			if(isset($_SESSION['user_data']['accountType']) && $_SESSION['user_data']['accountType'] == 1){
				redirect(base_url('404'));
			}
			if(!isset($_SESSION['user_data']['accountType'])){
				redirect(base_url('404'));
			}
		}
		if(isset($_SESSION['user_data']['accountType']) && $_SESSION['user_data']['accountType'] == 1){
			$userEducations = $this->function_lib->getUserEducationalDetails($_SESSION['user_data']['userID']);
			$userSkills = $this->skill_lib->getUserSkills($_SESSION['user_data']['userID']);
			// var_dump($userEducations);die;
			$this->data['userData']['education'][1] = false;
			$this->data['userData']['education'][2] = false;
			$this->data['userData']['education'][3] = false;
			if(!empty($userEducations)){
				foreach ($userEducations as $key => $education) {
					if(isset($education['educationType']) && $education['educationType'] == 1){
						$this->data['userData']['education'][1] = true;
					}else{
						if(!$this->data['userData']['education'][1])
						$this->data['userData']['education'][1] = false;
					}
					if(isset($education['educationType']) && $education['educationType'] == 2){
						$this->data['userData']['education'][2] = true;
					}else{
						if(!$this->data['userData']['education'][2])
						$this->data['userData']['education'][2] = false;
					}
					if(isset($education['educationType']) && $education['educationType'] == 3){
						$this->data['userData']['education'][3] = true;
					}else{
						if(!$this->data['userData']['education'][3])
						$this->data['userData']['education'][3] = false;
					}
				}
			}
			if(empty($userSkills)){
				$this->data['userData']['skills'] = array();
			}else{
				$this->data['userData']['skills'] = array_column($userSkills, 'skillID');
			}
		}
		$offerSkills = $this->function_lib->getOfferSkills($offerID);
		if(!empty($userSkills)){
			$userSkills = array_column($userSkills, 'skillID');
		}else{
			$userSkills = array();
		}
		if(!empty($offerSkills)){
			foreach ($offerSkills as $key => $value) {
				if(in_array($value['skillID'], $userSkills)){
					$offerSkills[$key]['user'] = true;
					if(!isset($allSkillSatisfied)){
						$allSkillSatisfied = true;
					}
				}else{
					$offerSkills[$key]['user'] = false;
					$allSkillSatisfied = false;
				}
			}
			$this->data['offerSkills'] = $offerSkills;
		}else{
			$allSkillSatisfied = true;
			$this->data['offerSkills'] = $offerSkills;
		}
		$this->data['allSkillSatisfied'] = $allSkillSatisfied;
		if($offerLocations = $this->function_lib->getOfferLocations($offerID))
			$this->data['offerLocations'] = $offerLocations;
		else{
			$this->data['getOfferLocationsations'] = array();
		}

		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('offer', $this->data);
	}

	public function aboutUs(){
		$this->data['pageTitle'] = "About Us";
		$this->data['activePage'] = "0";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('aboutUs', $this->data);
	}

	public function termsAndConditions(){
		$this->data['pageTitle'] = "Terms and Conditions";
		$this->data['activePage'] = "0";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('termsAndConditions', $this->data);
	}

	public function privacyPolicy(){
		$this->data['pageTitle'] = "Privacy Policy";
		$this->data['activePage'] = "0";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('privacyPolicy', $this->data);
	}

	public function contactUs(){
		$this->data['pageTitle'] = "Contact Us";
		$this->data['activePage'] = "0";
		$this->data['sidebar'] =  $this->load->view('commonCode/sidebar',$this->data,true);
		$this->load->view('contactUs', $this->data);
	}


	public function employer(){
		$this->data['pageTitle'] = "Employer";

		$this->load->view('employer', $this->data);
	}

	public function profile($offerID, $userID){
		if($_SESSION['user_data']['userID'] != $userID && $_SESSION['user_data']['accountType'] == 1){
			redirect(base_url('404'));
		}
		$userOffer = $this->function_lib->getUserOfferDetails($offerID, $userID);
		if(count($userOffer) == 0){
			$this->session->set_flashdata('message', array('content'=>'Something went Wrong. Please Try Again.','color'=>'red'));
			redirect(base_url('hiring-nucleus/applicants/'.$offerID));
		}
		$this->data['userOffer'] = $userOffer[0];
		$this->data['generalData'] = $this->function_lib->getUserGeneralData($userID)[0];
		$this->data['educationalDetails'] = $this->function_lib->getUserEducationalDetails($userID);
		$this->data['workExperience'] = $this->function_lib->getUserWorkExperience($userID);
		$this->data['skills'] = $this->skill_lib->getUserSkills($userID);
		$premiumSkills = $this->skill_lib->getPremiumSkills($userID);
		$this->data['premiumSkills'] = $premiumSkills;
		foreach ($premiumSkills as $key => $value) {
			$this->data['skillResponse'][$value['skillID']] = $this->skill_lib->getResponses($userID, $value['skillID']);
			$this->data['skillCorrect'][$value['skillID']] = $this->skill_lib->getCorrectResponses($userID, $value['skillID']);
			$this->data['skillIncorrect'][$value['skillID']] = $this->skill_lib->getIncorrectResponses($userID, $value['skillID']);
			$this->data['skillMax'][$value['skillID']] = $this->skill_lib->getSkillMax($value['skillID']);
		}

		$this->load->view('profile', $this->data);
	}

	public function report($userID){
		if($_SESSION['user_data']['userID'] != $userID && $_SESSION['user_data']['accountType'] == 1){
			redirect(base_url('404'));
		}
		$this->data['generalData'] = $this->function_lib->getUserGeneralData($userID)[0];
		$this->data['educationalDetails'] = $this->function_lib->getUserEducationalDetails($userID);
		$this->data['workExperience'] = $this->function_lib->getUserWorkExperience($userID);
		$this->data['skills'] = $this->skill_lib->getUserSkills($userID);
		$premiumSkills = $this->skill_lib->getPremiumSkills($userID);
		$this->data['premiumSkills'] = $premiumSkills;
		foreach ($premiumSkills as $key => $value) {
			$this->data['skillResponse'][$value['skillID']] = $this->skill_lib->getResponses($userID, $value['skillID']);
			$this->data['skillCorrect'][$value['skillID']] = $this->skill_lib->getCorrectResponses($userID, $value['skillID']);
			$this->data['skillIncorrect'][$value['skillID']] = $this->skill_lib->getIncorrectResponses($userID, $value['skillID']);
			$this->data['skillMax'][$value['skillID']] = $this->skill_lib->getSkillMax($value['skillID']);
		}

		$this->load->view('report', $this->data);
	}

	private function sendEMail($email, $msg){
		$this->load->helper('mail_helper');
		$this->data['msg'] = $msg;
		$message =  $this->load->view('emailers/verifyEMail', $this->data, true);
		$data = array(
				'sendToEmail' => $email,
				'fromName' => 'Campus Puppy Private Limited',
				'fromEmail' => 'no-reply@campuspuppy.com',
				'subject' => 'Offers|Campus Puppy Private Limited',
				'message' => $message,
				'using' =>'pepipost'
				);
		sendEmail($data);
	}

	private function sendSMS($mobile, $msg){
		$authKey = "163538ADD0UybtU59590664";
		$mobileNumber = $mobile;
		$senderId = "CPUPPY";
		$message = urlencode($msg);
		$route = "4";
		$postData = array(
		    'authkey' => $authKey,
		    'mobiles' => $mobileNumber,
		    'message' => $message,
		    'sender' => $senderId,
		    'route' => $route
		);
		$url="http://api.msg91.com/api/sendhttp.php";
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $postData
		    //,CURLOPT_FOLLOWLOCATION => true
		));
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$output = curl_exec($ch);
		if(curl_errno($ch)){
	  // echo 'error:' . curl_error($ch);
		}
		curl_close($ch);
		// echo $output;
	}

	public function generateVerificationCode($type){
		$this->load->library(array('contact_lib'));
		$mobile = "";
		$email = "";

		if($type=="1"){
			date_default_timezone_set("Asia/Kolkata");
			$mobile = $this->function_lib->getUserData($_SESSION['user_data']['email'])[0]['mobile'];
			$checkCode = $this->contact_lib->checkVerificationCode($mobile, $email, $type);
			$currentTime = strtotime(date("d M Y H:i:s"));
			if($checkCode){
				$expiry = $checkCode[0]['expiry'];
				$timeDifference = $expiry-$currentTime;
				if($timeDifference>0 && $timeDifference<7200){
					$msg = "Your Mobile Number Verification Token is: ".$checkCode[0]['code'].". The token is valid for only next 2 hours.";
					// echo $msg."1";
					$this->sendSMS($mobile, $msg);
				}
				else{
					$code = rand(1000,9999);
					$expiry = $currentTime + 7200;
					$codeData = array(
						'code' => $code,
						'mobile' => $mobile,
						'generatedAt' => $currentTime,
						'expiry' => $expiry,
						'codeType' => '1',
						'userID' => $_SESSION['user_data']['userID'],
						'active' => '1'
					);
					$this->contact_lib->insertVerificationCode($codeData);
					$msg =  "Your Mobile Number Verification Token is: ".$code.". The token is valid for only next 2 hours.";
					$this->sendSMS($mobile, $msg);
				}
			}
			else {
				$code = rand(1000,9999);
				$expiry = $currentTime + 7200;
				$codeData = array(
					'code' => $code,
					'mobile' => $mobile,
					'generatedAt' => $currentTime,
					'expiry' => $expiry,
					'codeType' => '1',
					'userID' => $_SESSION['user_data']['userID'],
					'active' => '1'
				);
				$this->contact_lib->insertVerificationCode($codeData);
				$msg =  "Your Mobile Number Verification Token is: ".$code.". The token is valid for only next 2 hours.";
				$this->sendSMS($mobile, $msg);
			}
		}

		if($type=="2"){
			date_default_timezone_set("Asia/Kolkata");
			$email = $_SESSION['user_data']['email'];
			$checkCode = $this->contact_lib->checkVerificationCode($mobile, $email, $type);
			$currentTime = strtotime(date("d M Y H:i:s"));
			if($checkCode){
				$expiry = $checkCode[0]['expiry'];
				$timeDifference = $expiry-$currentTime;
				if($timeDifference>0 && $timeDifference<7200){
					$msg = "Your E-Mail Verification Token is: ".$checkCode[0]['code'].". The token is valid for only next 2 hours.";
					$this->sendEMail($email, $msg);
				}
				else{
					$code = rand(1000,9999);
					$expiry = $currentTime + 7200;
					$codeData = array(
						'code' => $code,
						'email' => $email,
						'generatedAt' => $currentTime,
						'expiry' => $expiry,
						'codeType' => '2',
						'userID' => $_SESSION['user_data']['userID'],
						'active' => '1'
					);
					$this->contact_lib->insertVerificationCode($codeData);
					$msg =  "Your E-Mail Verification Token is: ".$code.". The token is valid for only next 2 hours.";
					$this->sendEMail($email, $msg);
				}
			}
			else {
				$code = rand(1000,9999);
				$expiry = $currentTime + 7200;
				$codeData = array(
					'code' => $code,
					'email' => $email,
					'generatedAt' => $currentTime,
					'expiry' => $expiry,
					'codeType' => '2',
					'userID' => $_SESSION['user_data']['userID'],
					'active' => '1'
				);
				$this->contact_lib->insertVerificationCode($codeData);
				$msg =  "Your E-Mail Verification Token is: ".$code.". The token is valid for only next 2 hours.";
				$this->sendEMail($email, $msg);
			}
		}

	}


	public function getReport($userID){

		$this->data['generalData'] = $this->function_lib->getUserGeneralData($userID)[0];
		$this->data['educationalDetails'] = $this->function_lib->getUserEducationalDetails($userID);
		$this->data['workExperience'] = $this->function_lib->getUserWorkExperience($userID);
		$this->data['skills'] = $this->skill_lib->getUserSkills($userID);
		$premiumSkills = $this->skill_lib->getPremiumSkills($userID);
		$this->data['premiumSkills'] = $premiumSkills;
		foreach ($premiumSkills as $key => $value) {
			$this->data['skillResponse'][$value['skillID']] = $this->skill_lib->getResponses($userID, $value['skillID']);
			$this->data['skillCorrect'][$value['skillID']] = $this->skill_lib->getCorrectResponses($userID, $value['skillID']);
			$this->data['skillIncorrect'][$value['skillID']] = $this->skill_lib->getIncorrectResponses($userID, $value['skillID']);
			$this->data['skillMax'][$value['skillID']] = $this->skill_lib->getSkillMax($value['skillID']);
		}

		$this->load->view('report', $this->data);
	}

	public function calculateScore($difficulty_level, $expert_time, $timeConsumed, $correct){
		$score = 0;
		if($correct == 0){
			$correct = -1;
		}
		$score = pow(((pow(3, ($difficulty_level/2)) * ((2*$expert_time)-$timeConsumed))/(2*$expert_time)), (2/$difficulty_level));
		$score = $score * $correct;
		if($correct == -1){
			$score = $score/2;
		}
		echo $score;
	}

}
