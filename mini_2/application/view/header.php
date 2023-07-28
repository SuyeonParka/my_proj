<?php


?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
        <a class="navbar-brand" href="/shop/main">OTIE</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Shop
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="/user/bigbag">big-bag</a></li>
                <li><a class="dropdown-item" href="/user/smallbag">small-bag</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">item</a></li>
                </ul>
            </li>
            
            <?php 
                if(isset($_SESSION[_STR_LOGIN_ID]))
            {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#" id="logout" onclick="redirectLogout();">
                    Logout
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/update" id="update">
                    정보수정
                </a>
            </li>
            <?
            } 
                else
            {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="/user/login">
                    Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/sign" id="sign">
                    Sign up
                </a>
            </li>
            <?
            }
            ?>
            </ul>
            <form class="d-flex" method="GET" action="/user/search">
                <!-- <select name="catgo" id="">
                    <option value="list_name"></option>
                </select> -->
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="want">
            <input class="btn btn-light" type="submit" name="search" value="검색">
            </form>
        </div>
        </div>
    </nav>
</body>
</html>