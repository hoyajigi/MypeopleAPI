<?php

require "config.php";

session_start();

// access_token이 발급된 상태가 아니라면, OAuth 인증 절차 시작
if(empty($_SESSION['access_token'])) {

	try {
		// Request Token 요청
		$request_token_info = $oauth->getRequestToken($request_token_url, $callback_url);

		// 얻어온 Request Token을 Access Token과 교환하기 위해 session에 저장
		$_SESSION["request_token_secret"] = $request_token_info["oauth_token_secret"];
		$_SESSION["oauth_token"] = $request_token_info["oauth_token"];
		
		echo ("<h2>OAuth 인증하기</h2>
				<div><p>1. 사용자 인증 받기</p>
			<a href=" .$authorize_url. "?oauth_token=" .$request_token_info['oauth_token']. " target='_blank'>사용자 인증 받기 </a>

			<p>2. verifier키 등록</p>
			<form method='get' action='oauthVerifier.php'>
			Verifier : <input type='text' name='oauth_verifier'></input>
			<input type = 'submit' />
			</form></div>");
		exit;
	} catch(OAuthException $E) {
		print_r($E);
		exit;
	}
} else {
	echo("<h2>OAuth AccessToken 확인</h2>");
	echo("<div>");
	echo ("AccessToken : " .$_SESSION['access_token']. "<br/>" );
	echo ("AccessTokenSecret : " .$_SESSION['access_token_secret']. "<br/>" );
	echo ("<a href='index.php'> 샘플 목록으로</a>");
	echo("</div>");
}
?>




