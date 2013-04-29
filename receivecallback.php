<?php
require "config.php";

session_start();

//access_token 가져오기
if(file_exists($access_token_file_name))
{
	//파일에 저장되어있으면 읽어옴
	$fh = fopen($access_token_file_name, 'rb');
	list($access_token, $access_token_secret)  = split("\t", fread($fh, filesize($access_token_file_name)), 2);
	fclose($fh);

	//세션에 저장
	if (!empty($access_token)&& !empty($access_token_secret)) {
		$_SESSION['access_token'] = $access_token;
		$_SESSION['access_token_secret'] = $access_token_secret;
	}

}
else {
	// access_token이 발급된 상태가 아니라면, OAuth 인증 절차 시작
	header('Location: oauth.php');
	exit;
}

if($_POST['action'] == "sendFromMessage")
{
	$buddyId = $_POST['buddyId'];	
	$content =  $_POST['content'];
	
	if(!empty($_SESSION['access_token']) && !empty($_SESSION['access_token_secret'])) {
			
		$oauth->setToken($_SESSION['access_token'],$_SESSION['access_token_secret']);
		$oauth->fetch($api_url."/mypeople/buddy/send.xml?buddyId=".urlencode($buddyId)."&content=".urlencode($content));
	}
	
	unset($buddyId);
	unset($content);
}


?>
