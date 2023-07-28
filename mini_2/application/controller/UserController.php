<?php

namespace application\controller;

// Controller class 상속 받음
class UserController extends Controller {
    // get방식으로 로그인 페이지를 요청할 때 실행되는 메소드
    public function loginGet() {    //login 접속할 때 이 메소드 호출
        return "login"._EXTENSION_PHP;
    }
    
    // post방식으로 로그인 정보를 전달할 때 실행되는 메소드
    public function loginPost() {
        $result = $this->model->getUser($_POST);
        $this->model->closeConn(); //db파기
        // 유저 유무 체크
        // 입력된 로그인 정보가 db에 있는지 확인하고, 정보가 없으면 에러메시지 출력 후 로그인 페이지 재로드
        if(count($result) === 0){
            $errMsg = "입력하신 회원 정보가 없습니다.";
            $this->addDynamicProperty("errMsg", $errMsg);
            // 로그인 페이지 리턴
            return "login"._EXTENSION_PHP;
        }

        // 정보가 있다면, 로그인 성공 처리, 세션에 유저 ID를 저장하고, 리스트 페이지로 이동
        // session에 User ID 저장
        $_SESSION[_STR_LOGIN_ID] = $_POST["id"];

        // session에 name 저장
        // $_SESSION[_STR_LOGIN_NAME] = $reuslt[0][STR_LOGIN_NAME];

        // 리스트 페이지 리턴
        return _BASE_REDIRECT."/shop/main";

        // var_dump($result);
    }

    // 로그아웃 메소드
    public function logoutGet() {
        session_unset();    // 삭제
        session_destroy(); //세션 자체 파괴, 연결고리 끊음

        // 메인 페이지 리턴
        return _BASE_REDIRECT."/shop/main"; //view파일명 리턴
    }

    // 회원가입 페이지 리턴 메소드
    public function signGet() {
        return "sign"._EXTENSION_PHP;
    }

    // 회원가입 처리
    public function signPost() {
        $arrPost = $_POST;
        $arrChkErr = [];

        // 유효성체크
        // id 글자수 체크
        if(mb_strlen($arrPost["id"]) === 0 || mb_strlen($arrPost["id"]) > 12){
            $arrChkErr["id"] = "아이디는 12글자 이하로 입력해주세요.";
        }
        //todo id 영문자 체크
        $pattern = "/[^a-zA-Z0-9]/";    // ^ : 문자열의 시작을 알리는 것
        if(preg_match($pattern, $arrPost["id"]) !== 0) {  //int나 false를 리턴해옴
            $arrChkErr["id"] = "ID는 영어 대문자, 영어 소문자, 숫자로만 입력해 주세요.";
            $arrPost["id"] = "";
        }

        //pw 글자수 체크
        if(mb_strlen($arrPost["pw"]) < 8 || mb_strlen($arrPost["pw"]) > 20){
            $arrChkErr["pw"] = "비밀번호는 8~20글자로 입력해주세요.";
        }
        //todo pw 영문 대 소문자, 숫자, 특수문자 사용 */
        $pattern2 = "/(?=.*[a-z]).(?=.*[0-9]).(?=.*?[!,@,#,$,%,^,&,*,?,_,~,-])/";
        if(preg_match($pattern2, $arrPost["pw"]) !== 1) {  //int나 false를 리턴해옴
            $arrChkErr["pw"] = "PW는 영어 소문자, 숫자, 특수문자로 입력해 주세요.";
            $arrPost["pw"] = "";
        }

        //비밀번호와 비밀번호 체크 확인
        if($arrPost["pw"] !== $arrPost["pwc"]){
            $arrChkErr["pwc"] = "비밀번호가 일치하지 않습니다.";
        }

        if(mb_strlen($arrPost["name"]) === 0 || mb_strlen($arrPost["name"]) > 30){
            $arrChkErr["name"] = "이름을 30글자 이하로 입력해주세요.";
        }

        // 유효성 체크 에러일 경우
        if(!empty($arrChkErr)) {
            // 에러메세지 세팅
            $this->addDynamicProperty('arrError', $arrChkErr);
            return "sign"._EXTENSION_PHP;
        }

        $result = $this->model->getUser($arrPost, false);

        //유저 유무 체크
        if(count($result) !== 0) {
            $errMsg = "입력하신 ID가 사용중입니다.";
            $this->addDynamicProperty("errMsg", $errMsg);
            // 회원 가입 페이지
            return "sign"._EXTENSION_PHP;
        }

        // 트랜잭션 스타트
        $this->model->tranBegin();

        // user inert
        if(!$this->model->insertUserInfo($arrPost)) {
            // 예외처리 롤백
            $this->model->tranRollback();
            echo "User Sign Error";
            exit();
        }
        echo "<script>alert('가입 완료');</script>";
        $this->model->tranCommit(); // 정상처리 커밋
        // 트랜잭션 끝

        // 로그인 페이지로 이동
        return _BASE_REDIRECT."/user/login";
        // return "login"._EXTENSION_PHP;
        
    }

    public function detailGet() {
        return "detail"._EXTENSION_PHP;
    }

    // bigbag 카테고리 메소드
    public function bigbagGet() {
        return "bigbag"._EXTENSION_PHP;
    }
    
    //smallbag 카테고리 메소드
    public function smallbagGet() {
        return "smallbag"._EXTENSION_PHP;
    }

    //update 페이지
    public function updateGet() {
        $user = $_SESSION[_STR_LOGIN_ID];   //session에 담긴 u_id가 담김

        //로그인 된 회원 정보 출력
        $arr = ["id" => $user];
        $result = $this->model->getUser($arr,false);

        $this->addDynamicProperty('result_upt', $result);
        return "update"._EXTENSION_PHP;
    }

    public function updateInfo() {
        $result = $this->model->getUser($_SESSION[_STR_LOGIN_ID]);
        $this->model->close();

        return $result[0];
    }

    //수정
    public function updatePost() {
        $arrPost = $_POST;
        $arrChkErr = [];

        // var_dump($arrPost);
        //유효성 체크
        if(mb_strlen($arrPost["pw"]) < 8 || mb_strlen($arrPost["pw"]) > 20){
            $arrChkErr["pw"] = "비밀번호는 8~20글자로 입력해주세요.";
        }

        if($arrPost["pw"] !== $arrPost["pwc"]){
            $arrChkErr["pwc"] = "비밀번호가 일치하지 않습니다.";
        }

        if(mb_strlen($arrPost["name"]) === 0 || mb_strlen($arrPost["name"]) > 30){
            $arrChkErr["name"] = "이름을 30글자 이하로 입력해주세요.";
        }

        //에러메시지 
        if(!empty($arrChkErr)) {
            // 에러메세지 세팅
            $this->addDynamicProperty('arrError', $arrChkErr);
            return "update"._EXTENSION_PHP;
        }

        // select
        // $result = $this->model->getUser($arrPost, false); search한 정보를 불러온걸 업뎃해서 계속 값이 안바꼈음

        $this->model->tranBegin();

        // user insert
        if(!$this->model->userUpdate($arrPost)) { // 넘어온 정보가 없으면 롤백
            // 예외처리 롤백
            $this->model->tranRollback();
            echo "User update Error";
            exit();
        }
        // var_dump($result);
        $this->model->tranCommit(); //성공 시 커밋

        echo "<script>alert('수정 완료');</script>";
        return "login"._EXTENSION_PHP;

        // return _BASE_REDIRECT."/shop/main";
    }

    // 회원 탈퇴 업데이트, 탈퇴
    public function userflgPost() {
        $arrPost = $_POST;

        if($arrPost["u_flg"] === 0){

            $this->model->tranRollback();
            echo "User del Error";
            $this->model->uptUserDelFlg();
        } 
        
        $this->model->tranCommit();

        echo "<script>alert('탈퇴가 완료되었습니다.');</script>";
    }

    // 검색 
    public function searchGet() {
        $arrGet = $_GET;

        $this->model->listSearch($arrGet);
        return "search"._EXTENSION_PHP; 
        
        var_dump($arrGet);
    }
    
}