# 마이피플 봇 API 샘플
===
사용자의 말을 따라하는 echo 봇 샘플 입니다. 

## 사용된 API 정보

- [OAuth for php](http://dna.daum.net/apis/oauth/tutorial/basic_php)
- [봇 등록 하기](http://dna.dev.daum.net/apis/mypeople/ref#addbot)
- [프로필 정보 수정](http://dna.dev.daum.net/apis/mypeople/ref#editprofile)
- [1:1 대화 메시지 보내기](http://dna.dev.daum.net/apis/mypeople/ref#send1on1message)
- [알림 콜백](http://dna.dev.daum.net/apis/mypeople/ref#pushmessage)

## index.php
메인페이지. access token이 발급 되었는지 확인 한다. access token이 발급 되지 않았을 경우 아래와 같은 화면을 보인다.

![access token 발급 받기 전 index](http://cfile9.uf.tistory.com/image/276CA240517E1A82247097)

accesstoken이 발급 되었을 경우 아래와 같은 화면을 보인다.

![access token 발급 받은 후 index](http://cfile9.uf.tistory.com/image/250CB140517E1A83096F1E)

##config.php
oauth 인증과 관련된 여러 변수 선언

## oauth.php, oauthVerifier.php 
oauth 인증관련 페이지이다. 토큰이 발급되지 않았을 경우 다음과 같은 화면을 보인다.

![oauth인증](http://cfile27.uf.tistory.com/image/136A3D40517E1A8327F163)

verifier키를 입력 한 뒤 버튼을 누르면 **oauthVerifier.php**에서 accesstoken을 발급 받아 파일로 저장한다.
완료가 되면 다음과 같이 access token을 확인할 수 있게 된다.

![accesstoken확인페이지](http://cfile22.uf.tistory.com/original/13718940517E1A8021D6FB)

## addBot.php
봇을 등록 하는 페이지

![봇등록](http://cfile22.uf.tistory.com/image/016F3340517E1A81211358)


## editProfile.php
등록된 봇의 프로필을 수정하는 페이지 

![봇 프로필 수정](http://cfile4.uf.tistory.com/image/117DD240517E1A8115711B)


## receivecallback.php
콜백 메시지를 처리하는 부분이다. access key가 제대로 인증 되었다면 봇에게 말을 걸었을때 말을 따라하게 된다. 

![말따라하기](http://cfile22.uf.tistory.com/image/277A1340517E1A821657BD)
