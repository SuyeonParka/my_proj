<?php

// 객체지향에서는 하나의 메소드가 하나의 기능만 할 수 있도록 쪼갬

namespace application\util;

class UrlUtil{

    // $_GET["url"]을 분석해서 리턴
    public static function getUrl() {
        // $_GET["url"]에 값이 있으면 그 값을, 없으면 빈 문자열 리턴
        // localhost/user/login 이라면 user/login을 리턴
        return $path = isset($_GET["url"]) ? $_GET["url"] : ""; //$_GET["url"]에는 서브디렉토리인 user/login이 담겨있음
    }

    // URL을 "/"로 구분해서 배열을 만들고 리턴
    public static function getUrlArrPath() {

        //static으로 선언된 메소드는 ::사용 / $url에는 user/login이 들어가있음 이걸 분석
        //static으로 선언된 메소드는 인스턴스화 하지 않음
        // UrlUtil::getUrl() 메소드를 호출하여 $url 변수에 할당
        $url = UrlUtil::getUrl();
        // $url이 빈 문자열("")이 아니면 "/"를 구분자로 사용해서 문자열을 분할한 배열을, 빈 문자열이면 그대로 리턴
        // 최종적으로 0번 방에 user, 1번 방에 login이 담김 그리고 이거를 리턴
        return $url !== "" ? explode("/", $url) : "";   
    }

    // "/"를 "\"로 치환해주는 메소드
    public static function replaceSlashToBackslash($str) {
        return str_replace("/", "\\", $str);
    }
}