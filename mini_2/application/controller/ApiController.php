<?php

namespace application\controller;

class ApiController extends Controller {
    public function userGet() {    //login 접속할 때 이 메소드 호출
        $arrGet = $_GET;
        $arrData = [ "flg" => "0" ]; //flg라는 key의 값을 0으로 설정(=>의 기능)
        // model 호출
        $this->model = $this->getModel("User");

        $result = $this->model->getUser($arrGet, false);    //Model에서의 두번째를 false로 변경->작동 안함

        //유저 유무 체크
        if(count($result) == ""){
            $arrData["flg"] ="0";
            $arrData["msg"] = "ID를 입력하세요.";
        }elseif(count($result) !== 0) {
            $arrData["flg"] ="1"; 
            $arrData["msg"] = "입력하신 ID가 사용중입니다.";
        }
        // if(count($result) !== 0) {
        //     $arrData["flg"] ="1";
        //     $arrData["msg"] = "입력하신 ID가 사용중입니다.";
        // }

        // 배열을 JSON으로 변경
        // json_encode : php array 또는 string 등을 JSON 문자열로 변환하는 php함수
        $json = json_encode($arrData);
        header('Content-type: application/json');
        echo $json;
        exit();
    }
}

// JSON 예시
// echo json_encode( ['fruit1' => 'apple', 'fruit2' => 'banana', 'test' => ['utf8' => 'A가★あ中!@']] );
# {"fruit1":"apple","fruit2":"banana","test":{"utf8":"A\uac00\u2605\u3042\u4e2d!@"}}

// 자료형이 문자열로 변환
// var_dump( json_encode(true) ); # string(4) "true"
// var_dump( json_encode(false) ); # string(5) "false