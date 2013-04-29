<?php
require 'config.php';
session_start();

?>
<html>
<head>
</head>
<h2>PHP 샘플 목록</h2>
<?php
//access token이 세션에 존재하는지 확인
if(empty($_SESSION['access_token']) || empty($_SESSION['access_token_secret']))
{
	//access_token이 발급되었는지 확인
	if(file_exists($access_token_file_name))
	{
		//파일에 저장되어있으면 읽어옴
		$fh = fopen($access_token_file_name, 'rb');
		list($access_token, $access_token_secret)  = split("\t", fread($fh, filesize($access_token_file_name)), 2);
		fclose($fh);

		//세션에 저장
		$_SESSION['access_token'] = $access_token;
		$_SESSION['access_token_secret'] = $access_token_secret;
	}
	else
	{
		//저장된 token이 없으면 재발급
		echo("
				<ul>
				<li><a href='oauth.php'> OAuth Access Token 발급받기</a></li>
				");
		exit;
	}
}
else {
	//세션에는 있지만 파일로 저장되어 있지 않을 경우
	if(!file_exists($access_token_file_name)) {
		// Access Token을 파일로 저장
		$fo = fopen($access_token_file_name, 'wb');
		fwrite($fo, $_SESSION['access_token']."\t".$_SESSION['access_token_secret']);
		fclose($fo);
	}
}

?>

<body>
	<ul>
		<li><a href='oauth.php'> OAuth Access Token 확인</a></li>
		<li><a href='addBot.php'>봇 등록 예제</a></li>
		<li><a href='editProfile.php'>프로필 수정 예제</a></li>
	</ul>
</body>
</html>
