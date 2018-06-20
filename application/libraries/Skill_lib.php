<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skill_lib {

	public function getPremiumSkills($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getPremiumSkills($userID);
	}

	public function getUserSkills($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getUserSkills($userID);
	}

	public function getOtherSkills($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getOtherSkills($userID);
	}

	public function getNotAddedSkills($userID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getNotAddedSkills($userID);
	}

	public function getActiveSkills(){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getActiveSkills();
	}

	public function getTestSettings($skillID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getTestSettings($skillID);
	}

	public function checkAnswer($questionID, $answer, $test = 0){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		$correctAnswer = $CI->function->getAnswer($questionID)[0]['answer'];
		if($answer == $correctAnswer){
			return 1;
		}else{
			return 0;
		}
	}

	public function getScore($actual_ans, $ans_given)
	{
		$CI = &get_instance();
		$score = 0;
		for ($i = 0; $i < count($actual_ans); $i++) {
			if($actual_ans[$i] == ($ans_given[$i]))
				$score++;
		}
		$test_settings = $CI->session->userdata('test_settings');
		$percent = $score/$test_settings[0]['numberQuestions'] * 100;
		return $percent;
	}

	public function addSkill($score, $userID, $skill_id)
	{
		$response = 0;
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
			date_default_timezone_set('Asia/Kolkata');
			$time = time();
			$date = date("d-m-Y", $time);
			$datestamp = strtotime($date);
			if($CI->function->addSkillToUser($skill_id, $userID, $score)){
				return true;
			}else{
				return false;
			}
	}

	public function testAvailable($skillID){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		if($CI->function->testAvailable($skillID) == 1){
			return true;
		}else{
			return false;
		}
	}

	public function getSkillData($skill_id){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->getSkillData($skill_id);
	}

	public function isInTest()
	{
		$CI = &get_instance();
		$CI->load->library('session');
		return $CI->session->userdata('in_test');
	}


	public function getQuestionDetails($level, $skillID){
		$CI = &get_instance();
		$CI->load->model('function_model','function');
		return $CI->function->getQuestionDetails($level, $skillID);
	}

	public function updateResponse($data){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->updateResponse($data);
	}

	public function getResponses($userID, $skillID){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->getResponses($userID, $skillID);
	}

	public function getCorrectResponses($userID, $skillID){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->getCorrectResponses($userID, $skillID);
	}

	public function getIncorrectResponses($userID, $skillID){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->getIncorrectResponses($userID, $skillID);
	}

	public function getSkillMax($skillID){
		$CI = &get_instance();
		$CI->load->model('function_model', 'function');
		return $CI->function->getSkillMax($skillID);
	}

}