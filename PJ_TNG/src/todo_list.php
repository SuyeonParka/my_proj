<?php
include_once( "common/fnc_park.php" );

    //게시판 정보 테이블 전체 카운트 획득
    $result_cnt = select_routine_info_cnt();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/board_list.css">
    <title>게시판</title>
</head>
<body>
    <img src="title.gif" alt="board">
    <div id="con">
    <table class='table'>
        <button class="new" type="button"><a href="routine_insert.php">게시글 작성</a></button>
        <thead>
            <tr>
                <th>게시글 번호</th>
                <th>게시글 제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody class="table-group-divider"> 
                <tr> 
                    <td><?php echo $record["routine_no"] ?></td> 
                    <td><a href="todo_detail.php?routine_no=<?echo $record['routine_no']?>"><?echo $record["routine_title"] ?></a></td>
                    <td><?php echo $record["routine_write_date"] ?></td>
                </tr>
        </tbody>
    </table>
</body>
</html>

?>