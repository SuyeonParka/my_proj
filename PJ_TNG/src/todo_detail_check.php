<?php

include_once( "common/fnc_park.php" );

$arr_get=$_GET;
    
    $resert_check=todo_select_todo_detail($arr_get["list_no"]);

    if ($resert_check["list_done_flg"]==0) {
        $arr_get["list_done_flg"]=1;
        update_check_flg($arr_get);
    }
    elseif ($resert_check["list_done_flg"]==1) {
        $arr_get["list_done_flg"]=0;
        update_check_flg($arr_get);
    }

    header("Location: todo_detail.php?list_no=".$arr_get["list_no"]);
    exit();


/*
-GET 방식으로 전달된 파라미터를 $arr_get 변수에 저장하고, 
todo_select_todo_detail 함수를 호출하여 해당 일정 정보를 가져옴.
-그리고 가져온 일정 정보에 대해서 list_done_flg 값이 0이면 1로, 
1이면 0으로 변경하여 $arr_get 배열에 저장하고
update_check_flg 함수를 호출하여 해당 일정 정보를 업데이트합니다.
-header 함수를 이용하여 todo_detail.php 페이지로 이동
*/
?>