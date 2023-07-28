<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/application/view/css/view.css">
    <title>sign up</title>
</head>
<body>

<?php
        require_once(_HEADER._EXTENSION_PHP)
    ?>

<div class="container">
    <form action="/user/sign" method="post">
    <h1>회원가입</h1>
    <br>
    <br>
    <!-- if로 작성 -->
    <?php if(isset($this->errMsg)) { ?>
            <div>   
                <span>
                    <?php echo $this->errMsg ?>
                </span>
            </div> 
    <? } ?>
    <!-- 삼항연산자로 작성 -->
            <div>
            <div class="lab"><label for="id">아이디</label></div>
            <input type="text" name="id" id="id" placeholder="아이디를 입력하세요.">
            <button type="button" onclick="chkDuplicationId()">id중복확인</button>
            <br>
            <span id="errMsgId">
                <?php if(isset($this->arrError["id"])) {
                        echo $this->arrError["id"];
                } ?>
            </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="pw">비밀번호</label></div>
            <input type="text" name="pw" id="pw" placeholder="비밀번호를 입력하세요.">
            <br>
            <span>
                <?php if(isset($this->arrError["pw"])) {
                    echo $this->arrError["pw"];
                } ?>
            </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="pwc">비밀번호 확인</label></div>
            <input type="text" name="pwc" id="pwc" placeholder="비밀번호 확인.">
            <br>
            <span>
                <?php if(isset($this->arrError["pwc"])) { 
                    echo $this->arrError["pwc"];
                } ?>
                </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="name">이름</label></div>
            <input type="text" name="name" id="name" placeholder="이름을 입력하세요.">
            <br>
            <span>
                <?php if(isset($this->arrError["name"])) {
                    echo $this->arrError["name"];
                } ?>
            </span>
        </div>
        <br>
        <div class="button">
            <input type="submit" value="Sign up" class="btn" style="width:220px">
        </div>
    </form>
</div> 

<?php
        require_once(_FOOTER._EXTENSION_PHP)
?>

<script src="/application/view/js/common.js"></script>
</body>
</html>