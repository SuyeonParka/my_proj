<?php

namespace application\controller;

class ProductController extends Controller {
    public function mainGet() {    //login 접속할 때 이 메소드 호출
        return "main"._EXTENSION_PHP;
    }

    public function listGet() {
        return "list"._EXTENSION_PHP;
    }

    public function detailGet() {
        return "detail"._EXTENSION_PHP;
    }

    }

    
