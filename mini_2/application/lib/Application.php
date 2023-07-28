<?php

// 객체지향으로 만들어진 사이트는 보통 대규모 사이트기 때문에, php파일만 해도 수천수백개임
// 파일 이름이 중복 될 수 밖에 없기 때문에, 네임스페이스 설정해줌
namespace application\lib;

// autoload에 UrlUtil 경로 잡아주기
use application\util\UrlUtil;   //class 선언 위에.(미리 위치 선언해줘서 urlutil앞에 path설정 안해줌) 

// 클래스명과 파일명은 똑같이
class Application {



    // 생성자
    public function __construct() {
        //접속 url을 배열로 획득  0번방 user 1번방 login
        //UrlUtil.php의 getUrlArrPath() 메소드를 사용해 URL 경로를 배열로 가져옴
        //UrlUtil의 네임스페이스를 적어주지 않은 이유 : 최상단에 use application/util/UrlUtil로 경로를 잡아줘서
        $arrPath = UrlUtil::getUrlArrPath();

        // $arrPath[0]이 있다면 첫글자 대문자로 변환해서 반환
        // $arrPath[0]이 없다면 "User"를 반환
        // URL 경로가 product/list인 경우 $arrPath 배열에는 product와 list 두 개의 요소가 저장
        // 첫 번째 요소인 product를 unfirst 함수로 첫글자 대문자로 변환 후
        // Product라는 문자열이 $identityName 변수에 저장됨
        $identityName = empty($arrPath[0]) ? "Shop" : ucfirst($arrPath[0]); //ucfirst는 aaa bbb일 때 Aaa bbb 로 되고 ucword는 Aaa Bbb로 됨. 0번방에 있는애가 엠티냐? ㄴㄴ그래서 뒤에꺼가 실행, User가 $identityName에 담김
        
        //GET이 전부 대문자라서 모두 소문자로 변경 후 첫글자만 대문자로 반환
        // URL 경로의 login이 존재하는 경우 HTTP 요청 메소드(=Get)와 연결하여 수행
        //loginGet
        $action = (empty($arrPath[1]) ? "main" : $arrPath[1]).ucfirst(strtolower($_SERVER["REQUEST_METHOD"])); //request method는 대문자로 가져옴, Get, Post로 나오게 변경해준거임, 어떤 메소드로 왔는지 체크함, $action에는 loginGet이 담김
        
        //controller명 작성
        //결정된 컨트롤러 이름을 기반으로 컨트롤러 파일의 경로를 구성
        //application/controller/$identityName+Controller.php
        $controllerPath = _PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER._EXTENSION_PHP;

        //? controllerPath 있나 없나 확인 할려고 가져옴

        // 에러 처리(해당 controller 파일 존재 여부 체크)
        // 컨트롤러 파일이 있는지 확인하고, 없으면 오류 메시지와 함께 프로그램을 종료
        //호출할게 없으면 에러처리가 힘들어서 미리 해당 파일이있는지 확인
        
        if(!file_exists($controllerPath)) {
            echo "해당 컨트롤러 파일이 없습니다. : ".$controllerPath;
            exit();   
        }

        // 해당 Controller 호출
        // 결정된 컨트롤러 이름을 기반으로 컨트롤러 클래스의 이름을 지정
        // $identityName 변수가 User라는 값이면, 컨트롤러 클래스의 이름은 UserController가 됨
        // $controllerName = application/controller/UserController
        $controllerName = UrlUtil::replaceSlashToBackslash(_PATH_CONTROLLER.$identityName._BASE_FILENAME_CONTROLLER);
        // var_dump($controllerName);
        // exit(); 
        
        //슬러시를 역슬러시로 바꾼게 controllerName에 저장 
        // application\controller\Usercontroller('User', 'loginGet')
        // 특정값을 변수에 담고 그걸 이용할때 new 사용해서 새로운 객체 사용
        new $controllerName($identityName, $action); 
        




        // var_dump($identityName, $action);
        exit;
    }
}

