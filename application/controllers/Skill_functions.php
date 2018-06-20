<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skill_functions extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('session', 'function_lib', 'skill_lib'));
		$this->load->helper(array('url'));
		$this->data = array();

		$this->data['message'] = ($v = $this->session->flashdata('message'))?$v:array('content'=>'','color'=>'');

		// $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
	}

	 public function addSkills(){
	 	$skillID = '';
	 	if($x = $this->input->post('skill'))
	 		$skillID = $x;
	 	if($skillID == ''){
	 		$this->session->set_flashdata('message', array('content'=>'Please select a skill to proceed further.','color'=>'red'));
			redirect(base_url('skills'));
	 	}
	 	if(!$this->skill_lib->testAvailable($skillID)){
	 		$_SESSION['userData']['currentSkill'] = $skillID;
			$_SESSION['userData'][$skillID]['totalScore'] = 10;
	 		$this->endTest();
	 	}
	 	$_SESSION['userData']['currentSkill'] = $skillID;
	 	redirect(base_url('skill-test-guidelines'));
	 }

	 public function beginTest(){
			$skill_id = $this->input->get('skillID');
			$_SESSION['userData']['intest'] = false;
			$_SESSION['userData']['currentSkill'] = $skill_id;
			$_SESSION['userData']['currentSkillName'] = $this->skill_lib->getSkillData($skill_id)[0]['skill_name'];
			$_SESSION['userData'][$skill_id]['totalScore'] = 0;
			$_SESSION['userData'][$skill_id]['skips'] = 3;
			$_SESSION['userData'][$skill_id]['skipStatus'] = 0;
			$_SESSION['userData'][$skill_id]['level'] = 1;
			$testTime = $this->skill_lib->getTestSettings($skill_id)[0]['testTime'];
			$_SESSION['userData'][$skill_id]['totalTime'] = $testTime;
			$_SESSION['userData'][$skill_id]['responses'] = array();
			$_SESSION['questionData'] = $this->getQuestionDetails(1,$skill_id);
			redirect(base_url('skill-test'));
		}

		public function nextQuestion(){
			if(!$_SESSION['userData']['intest']){
				$this->session->set_flashdata('message', array('content'=>'You Need to Start or Resume a test to Answer.','color'=>'red'));
				redirect(base_url('skill-tests'));
			}
			$answer = $this->input->get('answer');
			$timeConsumed = $this->input->get('timeConsumed');
			$correct = $this->skill_lib->checkAnswer($_SESSION['questionData'][0]['question_id'], $answer);
			$skill_id = $_SESSION['userData']['currentSkill'];
			$_SESSION['userData'][$skill_id]['totalTime'] = $this->input->get('totalTime');
			$score = $this->calculateScore(1, $_SESSION['questionData'][0]['expert_time'], $timeConsumed, $correct);
			if($correct == 1){
				$correct = '1';
			}else{
				$correct = '0';
			}
			if($answer == 0){
				$timeConsumed++;
			}
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'questionID' => $_SESSION['questionData'][0]['question_id'],
				'answer' => $answer,
				'score' => $score,
				'timeConsumed' => $timeConsumed,
				'correct' => $correct
				);
			if($this->skill_lib->updateResponse($data, $score)){
				$this->updateSkip($skill_id, $score);
				$_SESSION['userData'][$skill_id]['totalScore'] += $score;
				$totalScore = $_SESSION['userData'][$skill_id]['totalScore'];
				$level = $this->getLevel($totalScore);
				$_SESSION['userData'][$skill_id]['level'] = $level;
				array_push($_SESSION['userData'][$skill_id]['responses'], $_SESSION['questionData'][0]['question_id']);
				$_SESSION['questionData'] = $this->getQuestionDetails($level, $skill_id);
				$testData['questionData'] = $_SESSION['questionData'][0];
					if($_SESSION['userData'][$skill_id]['skips'] > 0){
						$testData['skipsLeft'] = $_SESSION['userData'][$skill_id]['skips'];
						$testData['skips'] = true;
					}
					else{
						$testData['skipsLeft'] = 0;
						$testData['skips'] = false;
					}
					$testData['level'] = $level;
					$testData['totalScore'] = $totalScore;
					$testData['totalTime'] = $_SESSION['userData'][$skill_id]['totalTime'];
					if($totalScore >= 100 || $totalScore <= -10){
						$testData['questionData'] = null;
					}
					echo json_encode($testData);
			}else{
				echo "string"; die;
				$this->logout();
			}
		}

	private function updateSkip($skill_id, $score){
		if($_SESSION['userData'][$skill_id]['totalScore'] <= 30 && ($_SESSION['userData'][$skill_id]['totalScore'] + $score) >= 30 && $_SESSION['userData'][$skill_id]['skipStatus'] == 0){
			$_SESSION['userData'][$skill_id]['skipStatus'] = 1;
			$_SESSION['userData'][$skill_id]['skips'] +=1;
		}else{
			if($_SESSION['userData'][$skill_id]['totalScore'] <= 60 && ($_SESSION['userData'][$skill_id]['totalScore'] + $score) >= 60 && $_SESSION['userData'][$skill_id]['skipStatus'] == 1){
				$_SESSION['userData'][$skill_id]['skipStatus'] = 2;
				$_SESSION['userData'][$skill_id]['skips'] +=1;
			}
		}
	}

	private function getLevel($totalScore = 0){
		if($totalScore < -10 && $totalScore != NULL){
			$level = 0;
		}
		if(($totalScore >=-10 && $totalScore < 10) || $totalScore == NULL){
			$level = 1;
		}
		if($totalScore >= 10 && $totalScore < 20){
			$level = 2;
		}
		if($totalScore >= 20 && $totalScore < 35){
			$level = 3;
		}
		if($totalScore >= 35 && $totalScore < 45){
			$level = 4;
		}
		if($totalScore >= 45 && $totalScore < 55){
			$level = 5;
		}
		if($totalScore >= 55 && $totalScore < 75){
			$level = 6;
		}
		if($totalScore >= 75 && $totalScore < 85){
			$level = 7;
		}
		if($totalScore > 85){
			$level = 8;
		}
		return $level;
	}	


	public function skipQuestion(){
		if(!$_SESSION['userData']['intest'] || !isset($_SESSION['userData']['intest'])){
			$this->session->set_flashdata('message', array('content'=>'Sorry, Some Error Occured. You May resume the Test to Continue.','color'=>'red'));
			redirect(base_url('skill-tests'));
		}
		if(!$timeConsumed = $this->input->get('timeConsumed')){
			$timeConsumed = 0;
		}
		$answer = $this->input->get('answer');
		$skill_id = $_SESSION['userData']['currentSkill'];
		$_SESSION['userData'][$skill_id]['totalTime'] = $this->input->get('totalTime');
		if($_SESSION['userData'][$skill_id]['skips'] > 0){
			$_SESSION['userData'][$skill_id]['skips']--;
			$data = array(
				'userID' => $_SESSION['user_data']['userID'],
				'questionID' => $_SESSION['questionData'][0]['question_id'],
				'answer' => $answer,
				'score' => 0,
				'timeConsumed' => $timeConsumed,
				'correct' => '-1'
				);
			if($this->skill_lib->updateResponse($data)){	
				$totalScore = $_SESSION['userData'][$skill_id]['totalScore'];
				$level = $this->getLevel($totalScore);
				array_push($_SESSION['userData'][$skill_id]['responses'], $_SESSION['questionData'][0]['question_id']);
				$_SESSION['questionData'] = $this->getQuestionDetails($level,$skill_id);
				$testData['questionData'] = $_SESSION['questionData'][0];
				if($_SESSION['userData'][$skill_id]['skips'] > 0){
					$testData['skipsLeft'] = $_SESSION['userData'][$skill_id]['skips'];
					$testData['skips'] = true;
				}
				else{
					$testData['skipsLeft'] = 0;
					$testData['skips'] = false;
				}
				$testData['totalTime'] = $_SESSION['userData'][$skill_id]['totalTime'];
				echo json_encode($testData);
			}else{
				$this->logout();
			}
		}else{
			$this->session->set_flashdata('message', array('content'=>'Some Error Occured Resume Test to Continue.','color'=>'red'));
			echo 'false';
		}
	}

	public function endTest(){
		$userID = $_SESSION['user_data']['userID'];
		$skill_id = $_SESSION['userData']['currentSkill'];
		$score = $_SESSION['userData'][$skill_id]['totalScore'];
		if($score >= 10){
			$result = $this->skill_lib->addSkill($score, $userID, $skill_id);
			if(!$result){
				$this->session->set_flashdata('message', array('content'=>'Some Error Occured. Please Try Again.','color'=>'red'));
				$this->updateInfo();
				redirect('skills');
			}
			$this->session->set_flashdata('message', array('content'=>'Congratulations, you cleared the skill Test and your skill was Successfully added to your Profile.','color'=>'green'));
		}else{
			$this->session->set_flashdata('message', array('content'=>'Sorry, you were unable to clear the skill Test. Better Luck Next Time.','color'=>'red'));
		} 
		$this->updateInfo();
		redirect('skills');
	}

	public function updateInfo(){
		$skill_id = $_SESSION['userData']['currentSkill'];
		$totalScore = $_SESSION['userData'][$skill_id]['totalScore'];
		$_SESSION['questionData'] = NULL;
		$_SESSION['userData']['currentSkill'] = NULL;
		$_SESSION['userData']['currentSkillName'] = NULL;
		$_SESSION['userData'][$skill_id]['totalScore'] = NULL;
		$_SESSION['userData'][$skill_id]['skips'] = NULL;
		$_SESSION['userData'][$skill_id]['skipStatus'] = NULL;
		$_SESSION['userData'][$skill_id]['totalTime'] = NULL;
		$_SESSION['userData'][$skill_id]['responses'] = NULL;
		$_SESSION['userData']['intest'] = false;
	}

	private function getQuestionDetails($level, $skillID){
		$questionDetails = $this->skill_lib->getQuestionDetails($level, $skillID);
		return $questionDetails;
	}

	private function calculateScore($difficulty_level = 1, $expert_time, $timeConsumed, $correct){
		$score = 0;
		if($correct == 0){
			$correct = -1;
		}
		$score = pow(((pow(3, ($difficulty_level/2)) * ((2*$expert_time)-$timeConsumed))/(2*$expert_time)), (2/$difficulty_level));
		$score = $score * $correct;
		if($correct == -1){
			$score = $score/2;
		}
		return $score;
	}



}
