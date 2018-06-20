<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function sendEmail($data)
{
  if($data['using'] == 'pepipost'){
    return sendEmailUsingPepipost($data);
  }
  if($data['using'] == 'smtp'){
    return sendEmailUsingSMTP($data);
  }
}

function sendEmailUsingSMTP($data)
{
  $ci =& get_instance();
  $ci->load->library('email');
  date_default_timezone_set("Asia/Kolkata");
  $config = Array(
  'protocol' => "smtp",
  'smtp_host' => "ssl://smtp.gmail.com",
  'smtp_port' => 465,
  'smtp_user' => "no-reply@campuspuppy.com",
  'smtp_pass' => "vrmanikhil",
  'mailtype' => "html",
  'charset' => "utf-8",
  'wordwrap' => TRUE,
  'newline' => "\r\n"
  );
  $ci->email->initialize($config);
  $ci->email->from($data['fromEmail'], $data['fromName']);
  $ci->email->to($data['sendToEmail']);
  $ci->email->subject($data['fromName']);
  $ci->email->message($data['message']);
  if(!$ci->email->send(FALSE)){
    $message = $ci->email->print_debugger();
    return json_encode(['message'=>'ERROR','errorcode'=>"1",'errormessage'=>$message]);
  }
  return json_encode(['message'=>'SUCCESS','errorcode'=>"0",'errormessage'=>'']);
}

function sendEmailUsingPepipost($data)
{
  $from =$data['fromEmail'];
  $fromname =$data['fromName'];
  $to =$data['sendToEmail'];//Recipients list (semicolon separated)
  $api_key ="85db19be8702ada2314b21f840403e36";
  $subject =$data['subject'];
  $content =$data['message'];
  $data=array();
  $data['subject']= $subject;
  $data['fromname']= $fromname;
  $data['api_key']= $api_key;
  $data['from']= $from;
  $data['content']= $content;
  $data['recipients']= $to;
  $apiresult = callApi(@$api_type,@$action,$data);
  // echo trim($apiresult); 
}

function callApi($api_type='', $api_activity='', $api_input='')
{
  $data = array();
  $result = http_post_form("https://api.pepipost.com/api/web.send.rest", $api_input);
  return $result;
}

function http_post_form($url,$data,$timeout=20){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_FAILONERROR,1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION,0);
  curl_setopt($ch, CURLOPT_POST,1);
  curl_setopt($ch, CURLOPT_RANGE,"1-2000000");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch,  CURLOPT_REFERER,@$_SERVER['REQUEST_URI']);
  $result = curl_exec($ch);
  $result = curl_error($ch)? curl_error($ch): $result;
  curl_close($ch);
  return $result;
}
