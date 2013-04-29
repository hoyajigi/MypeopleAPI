<?php
require "config.php";

session_start();
if($_GET['oauth_verifier'] ) {
	try {
		// Request Token과 verifier로 Access Token 얻기
		$oauth->setToken($_SESSION['oauth_token'],$_SESSION["request_token_secret"]);
		$access_token_info = $oauth->getAccessToken($access_token_url, null, $_GET['oauth_verifier']);

		// Access Token로 교환 되었으므로 Oauth_token과 Request Token 삭제.
		unset($_SESSION["oauth_token"]);
		unset($_SESSION["request_token_secret"]);

		// Access Token을 세션에 저장
		$_SESSION['access_token'] = $access_token_info['oauth_token'];
		$_SESSION['access_token_secret'] = $access_token_info['oauth_token_secret'];
		
		// Access Token을 파일로 저장
		$fo = fopen($access_token_file_name, 'wb');
		fwrite($fo, $access_token_info['oauth_token']."\t".$access_token_info['oauth_token_secret']);
		fclose($fo);
		
	} catch(OAuthException $E) {
		print_r($E);
		exit;
	}
}
// protected resoure가 있는 페이지로
header("Location: ./OAuth.php");
?>