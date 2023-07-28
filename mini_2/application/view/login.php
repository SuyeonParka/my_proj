
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/application/view/css/view.css">
    <title>Login</title>
</head>
<body>
<div class="container">
    <form class="my_form" method="post" action="/user/login">
        <h1>로그인</h1>
        <input type="text" name = "id" id="u_id" placeholder="id" required>
        <br>
        <br>
        <input type="password" name = "pw" id="u_pw" placeholder="password" required>
        <br>
        <br>
        <span>
            <input style='zoom:0.7;' type="checkbox" class="stay">
            로그인 상태 유지
        </span>
        <br>
        <span style="color: red; font-size=10px"><?php echo isset($this->errMsg) ? $this->errMsg : ""; ?></span>
        <br>
        <br>
        <input type="submit" value="Login" class="btn">
        <br>
        <br>
        <span><a href="/user/sign">회원가입</a></span>
        <span class="stick">|</span>
        <span><a href="">ID/PW 찾기 </a></span>
    </form>
</div>

    
</body>
</html>