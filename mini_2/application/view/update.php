<?php

// $user = $_SESSION[_STR_LOGIN_ID];

// //로그인 된 회원 정보 출력
// $arr = ["id" => $_SESSION["u_id"]];
// $result = $this->model->getUser($arr,false);
// var_dump($result);

//수정 된 회원 정보 업뎃
// $result_upt = $this->userUpdate($user);

// $this->result_upt;

// var_dump($this->result_upt);
$httpMethod = $_SERVER["REQUEST_METHOD"];
$pwVal = "";
$nameVal = "";

if ( $httpMethod === "POST" ) {
    $getPost = $_POST;

    $idVal = $getPost["id"];
    $pwVal = $getPost["pw"];
    $nameVal = $getPost["name"];
    // $noVal = $getPost["no"];
}
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/application/view/css/view.css">
    <title>Update</title>
</head>
<body>
<?php
        require_once(_HEADER._EXTENSION_PHP)
    ?>
<div class="container">
    <form action="/user/update" method="post">
    <h1>회원정보 수정</h1>
    <br>
    <br>
    <?php if(isset($this->errMsg)) { ?>
            <div>   
                <span>
                    <?php echo $this->errMsg ?>
                </span>
            </div> 
    <? } ?>
            <div>
            <div class="lab"><label for="id">아이디</label></div>
            <input type="text" name="id" id="id" value="<?php echo $httpMethod === 'POST' ? $idVal : $this->result_upt[0]["u_id"]?>" size="30">  <!-- 처음에 넘어올 때 get으로 넘어와서 -->
            <span style="color: red;">
            <br>
                <?php if(isset($this->arrError["id"])) {
                        echo $this->arrError["id"];
                } ?>
            </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="pw">비밀번호</label></div>
            <input type="text" name="pw" id="pw" value="<?php echo $httpMethod === 'POST' ? $pwVal : $this->result_upt[0]["u_pw"]?>" size="30" placeholder="비밀번호를 입력하세요.">
            <br>
            <span style="color: red;">
                <?php if(isset($this->arrError["pw"])) {
                    echo $this->arrError["pw"];
                } ?>
            </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="pwc">비밀번호 확인</label></div>
            <input type="text" name="pwc" id="pwc" placeholder="비밀번호 확인." size="30">
            <span  style="color: red;">
            <br>
                <?php if(isset($this->arrError["pwc"])) { 
                    echo $this->arrError["pwc"];
                } ?>
            </span>
            </div>
            <br>
            <div>
            <div class="lab"><label for="name">이름</label></div>
            <input type="text" name="name" id="name" value="<?php echo $httpMethod === 'POST' ? $nameVal : $this->result_upt[0]["u_name"]?> "placeholder="이름을 입력하세요." size="30">
            <span style="color: red;"> 
            <br>
                <?php if(isset($this->arrError["name"])) {
                    echo $this->arrError["name"];
                } ?>
            </span>
        </div>
        <br>
        <div class="button">
            <input type="submit" value="수정" class="btn1" style="width:148px; height:30px; border-radius: 5px">
            <input type="submit" value="탈퇴" class="btn1" style="width:148px; height:30px; border-radius: 5px">
        </div>
    </form>
</div> 

<?php
        require_once(_FOOTER._EXTENSION_PHP)
?>

<script>
        function redirectLogout() {
            location.href = "/user/logout";
        }
</script>

<script src="/application/view/js/common.js"></script>
</body>
</html>