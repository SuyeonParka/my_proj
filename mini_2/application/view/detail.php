<?php

$arr_get = $_GET;
$result_info = $arr_get["list_no"];

?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="application/view/css/view.css">
    <title>Detail</title>
</head>
<body>
    <!-- 헤더 -->
    <?php
        include_once $_SERVER["DOCUMENT_ROOT"]."/application/view/header.php";
    ?>
    <div class="con">
        <?php $this->listInfo($list_no) ?>
        <button>Cart</button>
        <button>Buy</button>
    </div>
    

</body>
</html>