<?php
require "config.php";

session_start();

// Access Token이 이미 발급되어 있는 상태면, 토큰 지정
if(empty($_POST['botName']) && empty($_POST['receiveUrl']))
{
	$botName = "";
	$receiveUrl ="";
}
else
{
	$botName = $_POST['botName'];
	$receiveUrl = $_POST['receiveUrl'];

	$oauth->setToken($_SESSION['access_token'],$_SESSION['access_token_secret']);
	$oauth->fetch($api_url."/mypeople/bot/register.xml?botName=".urlencode($botName)."&receiveUrl=".urlencode($receiveUrl));
	$xml = simplexml_load_string($oauth->getLastResponse());
}
?>
<h2>봇 등록 예제</h2>
<div>
	<form method='post' action='addBot.php'>
		botName : <input type='text' name='botName' value=<?= $botName ?>></input>
		receiveUrl : <input type='text' name='receiveUrl'
			value=<?= $receiveUrl ?>></input> <input type='submit' />
	</form>
</div>
<hr>
<div>
	<h3>봇 등록 결과</h3>
	<?php 
	if(!empty($_POST['botName']) && !empty($_POST['receiveUrl'])){
		echo("<p>");
		echo("code : " .$xml->code);
		echo("message : " .$xml->message);
		echo("</p>");
	}
	else {
		echo ("<p>봇을 등록 하세요</p>");
	}
	?>
</div>
<div>
	<a href='index.php'> 샘플 목록으로</a>
</div>
