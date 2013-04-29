<?php
require "config.php";

session_start();

// Access Token이 이미 발급되어 있는 상태면, 토큰 지정
if($_SESSION['access_token'] ) {

	if(empty($_POST['botName']) && empty($_POST['receiveUrl']) && empty($_POST['status']))
	{
		$botName = "";
		$receiveUrl ="";
		$status = "";
	}
	else
	{
		$botName = $_POST['botName'];
		$receiveUrl = $_POST['receiveUrl'];
		$status = $_POST['status'];
		
		$oauth->setToken($_SESSION['access_token'],$_SESSION['access_token_secret']);
		$oauth->fetch($api_url."/mypeople/profile/edit.xml?name=".urlencode($botName)."&receiveUrl=".$receiveUrl."&status=".urlencode($status));
		$xml = simplexml_load_string($oauth->getLastResponse());
	}
}
?>
<h2>프로필 수정 예제</h2>
<div>
	<form method='post' action='editProfile.php'>
		name : <input type='text' name='botName' value='<?= $botName ?>' /> <br>
		status : <input type='text' name='status' value='<?= $status ?>' /> <br>
		receiveUrl : <input type='text' name='receiveUrl' value='<?= $receiveUrl ?>' /> <input type='submit' />
	</form>
</div>
<hr>
<div>
	<h3>프로필 수정 결과</h3>
	<?php 
	if(!empty($_POST['botName']) && !empty($_POST['receiveUrl'])){
		echo("<p>");
		echo("code : " .$xml->code);
		echo("message : " .$xml->message);
		echo("</p>");
	}
	else {
		echo ("<p>프로필을 수정해 보세요</p>");
	}
	?>
</div>
<div>
	<a href='index.php'> 샘플 목록으로</a>
</div>
