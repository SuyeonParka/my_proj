<?php

// config 파일
require_once("application/lib/config.php");  // config 파일, require_once:에러 판별 쉬움
require_once("application/lib/autoload.php");   // autoload 파일

// echo _ROOT;
// echo $_GET["url"];

// require_once("application/lib/Application.php");
new application\lib\Application();  // Application 호출(어디에 있는 class인지 적어주고 class 호출)