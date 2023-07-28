<?php

// sql_autoload_register 함수는 클래스가 호출되어 생성될 때 PHP엔진에서 실행되는 콜백 함수를 등록함
// 해당 클래스명을 가진 파일을 자동으로 include/require 해줌 
spl_autoload_register( function($path) {
    $path = str_replace("\\", "/", $path);  // "\"를 "/"로 바꿈(php는 /가 기본)

    // 해당 파일 require
    require_once($path._EXTENSION_PHP);
});