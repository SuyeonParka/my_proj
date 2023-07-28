<?php
include_once( "db_common.php" );

/*---------------------------------------------
함수명 : todo_insert_recom_routine
기능   : 게시글 작성
파라미터 : Arr      &$param_arr
리턴값  :  int/array     $result_cnt/ERRMSG
-----------------------------------------------*/

function todo_insert_recom_routine( &$param_arr )
{
    $sql =
        " INSERT INTO "
        ." recom_routine "
        ." ( "
        ." recom_title "
        ." ,recom_contents "
        ." ) "
        ." VALUES "
        ." ( "
        ." :recom_title "
        ." ,:recom_contents"
        ." ) "
        ;

    $arr_prepare =
        array(
            ":recom_title" => $param_arr["recom_title"]
            ,":recom_contents" => $param_arr["recom_contents"]
        );

    $conn = null;
    
    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn -> prepare( $sql ); 
        $stmt -> execute( $arr_prepare ); 
        $result_cnt = $stmt->rowCount();
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage(); 
    }
    finally 
    {
        $conn = null;
    }

    return $result_cnt;

}

/*
-게시글 작성
-insert page에 사용
-placeholder로 랜덤값 줄 때 이용됨
-title, contents 추천
*/

/*---------------------------------------------
함수명 : todo_select_todo_detail
기능   : 게시글 정보
파라미터 : int      &$param_no
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/

function todo_select_todo_detail( &$param_no )
{
    $sql =
        " SELECT "
        ." list_no "
        ." ,list_title "
        ." ,list_contents "
        ." ,list_due_time "
        ." ,list_done_flg "
        ." ,list_now_date "
        ." FROM "
        ." routine_list "
        ." WHERE "
        ." list_no = :list_no "
        ;

    $arr_prepare =
        array
        (
            ":list_no"=>$param_no
        );

    $conn = null;

    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e) 
    {
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result[0];

}

/*
-루틴 리스트 페이지에서 게시글 정보 불러옴
-detail page, insert page에서 사용됨
-rountion_list 테이블에서 특정 list_no값을 가진 행 선택
-$arr_prepare 배열에 :list_no와 $param_no값을 연결하여 쿼리를 실행할 때 사용
-db_conn 함수를 이용하여 db에 연결
-fetchAll() 실행결과를 배열에 저장
-$conn = null 배열을 닫음
-result[0]을 반환하여 실행 결과에서 첫번째 행을 가져옴
-이 함수를 호출하며 $param_no에 지정된 list_no 값을 가진행의 정보를 반환
*/

/*---------------------------------------------
함수명 : todo_update_flg
기능   : 게시글 정보
파라미터 : int      &$param_arr
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function todo_update_flg( &$param_arr )
{
    $sql =
        " UPDATE "
        ." routine_info "
        ." SET "
        ." routine_del_flg = :routine_del_flg"
        ." WHERE "
        ." routine_no = :routine_no "
        ;
    
    $arr_prepare =
        array (
            " routine_no " => $param_arr["routine_no"]
            ," routine_del_flg " => $param_arr["routine_del_flg"]
        );

    $conn = null;

    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn->prepare( $sql );
        $stmt->execute( $arr_prepare );
        $result_cnt = $stmt->rowCount(); 
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result_cnt;

}

/*
-routine_info 테이블에서 routine_del_flg필드를 업뎃
-routine_no를 기준
-실행결과로는 업뎃된 레코드 수가 반환
*/

/*---------------------------------------------
함수명 : select_routine_info_cnt
기능   : routine_del_flg 필드가 0인 레코드 수 반환
파라미터 : 
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function select_routine_info_cnt()
{
    $sql = 
        " SELECT "
        ."      COUNT(*) cnt"
        ." FROM "
        ."      routine_info "
        ." WHERE "
        ."      routine_del_flg = '0' "
        ;

    $arr_prepare = array ();

    $conn = null; 
    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e ) 
    {
        return $e->getMessage(); 
    }
    finally
    {
        $conn = null; 
    }

    return $result;
}

/*
-routine_info 테이블에서 routine_del_flg 필드가 0인 레코드 수를 반환함
-결과로는 cnt 필드 값을 가진 배열이 반환됨
*/


//todo 실행
// $a=1;
// var_dump(todo_select_todo_detail($a));
//todo 종료


// ---------------------------------------
// 함수명      : update_check_flg
// 기능        : 체크리스트 update
// 파라미터    : &$param_arr
// 리턴값      : $result_count
// ---------------------------------------

function update_check_flg(&$param_arr)
{
    $sql=
    " UPDATE "
    ." routine_list "
    ." SET "
    ." list_done_flg = :list_done_flg "
    ." WHERE "
    ." list_no = :list_no "
    ;

    $arr_prepare =
    array(
        ":list_no" => $param_arr["list_no"]
        ,":list_done_flg" => $param_arr["list_done_flg"]
    );
    
    $conn = null;
    
    try {
        db_conn($conn);
        $conn->beginTransaction();
        $stmt = $conn ->prepare($sql);
        $stmt->execute($arr_prepare);
        
        $result_count = $stmt->rowCount();
        $conn->commit();
    } 
    catch (Exception $e) {
        $conn->rollBack();
        return $e->getMessage();
    }
    finally{
        $conn =null;
    }
    
    return $result_count;
}

/* 
-routine_list 테이블에서 특정 list_no 값을 가진 행의 list_done_flg 값을 업뎃 하는 함수
-routine_list 테이블에서 list_no 값을 $param_no["list_no"]로 가진 행의
'list_done_flg' 값을 $param_arr["list_done_flg"] 값으로 업뎃
-stmt->rowCount() : 실행 결과로 변경된 행의 수를 가져와 $result_count에 변수 저장
-$conn->commit() : 변경 사항 db에 저장(트랜잭션 커밋)
-$result_count 값 반환하여 업뎃된 행의 수 반환
-routine_list 테이블에서 특정 행의 list_done_flg 값을 업뎃할 때 사용
함수를 호출하면 $param_arr배열에 지정된 list_no 값을 가진 행의 list_done_flg 값을
$param_arr 배열에 지정된 list_done_flg 값으로 업뎃하고 업뎃된 행의 수 반환
*/

/*---------------------------------------------
함수명 : todo_select_recom_routine
기능   : 삽입 페이지 할일 랜덤 추천
파라미터 : int      &$param_no
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function todo_select_recom_routine()
{
    $sql =
        " SELECT "
        ." recom_no "
        ." ,recom_title "
        ." ,recom_contents "
        ." FROM "
        ." recom_routine "
        ;

    $arr_prepare = array();

    $conn = null;

    try 
    {
        db_conn( $conn );
        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $arr_prepare );
        $result = $stmt->fetchAll();
    } 
    catch ( Exception $e) 
    {
        return $e->getMessage();
    }
    finally 
    {
        $conn = null;
    }

    return $result;
}

/*
-recom_routine 테이블에서 추천 루틴 정보를 조회하는 함수
-결과로는 routine_no, title, contents 필드 값을 가진 배열이 반환됨
-insert page에서 사용
*/
// var_dump(todo_select_recom_routine());

/*---------------------------------------------
함수명 : todo_insert_info
기능   : db의 list, info에 둘다 정보가 적용
파라미터 : int      &$param_no
리턴값  :  int/array     $result/ERRMSG
-----------------------------------------------*/
function todo_insert_info( &$param_arr )
{
    $sql =
        " INSERT INTO "
        ." routine_info "
        ." ( "
        ." routine_title "
        ." ,routine_contents "
        ." ,routine_due_time "
        ." ) "
        ." VALUES "
        ." ( "
        ." :routine_title "
        ." ,:routine_contents "
        ." ,:routine_due_time "
        ." ) "
        ;

    $arr_prepare =
    array(
        ":routine_title" => $param_arr["routine_title"]
        ,":routine_contents" => $param_arr["routine_contents"]
        ,":routine_due_time" => $param_arr["routine_due_time"]
    );

    $conn = null;
    
    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn -> prepare( $sql ); 
        $stmt -> execute( $arr_prepare ); 
        $result_cnt = $stmt->rowCount();
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage(); 
    }
    finally 
    {
        $conn = null;
    }

    return $result_cnt;
}

/*
-routine_info 테이블에 새로운 루틴 정보를 추가하는 함수
-함수 실행 시 routine_title, contents, due_time 값을 가진 배열이 
매개변수로 전달되어야 합니다.

*/
//to do 
// $a = array("routine_title"=>"str"
//             ,"routine_contents"=>"sttttt"
//             ,"routine_due_time"=>1212
//             );
// // var_dump($a);
// var_dump(todo_insert_info($a));
// // to do


/*---------------------------------------------
함수명 : todo_select_list
기능   : routine_info에 정보 인서트
파라미터 : array      &$param_arr
리턴값  :  str     $last_no/ERRMSG
-----------------------------------------------*/
function todo_insert_routine_info( &$param_arr )
{
    $sql =
        " INSERT INTO "
        ." routine_info ( "
        ." routine_title "
        ." ,routine_contents "
        ." ,routine_due_time ) "
        ." VALUES ( "
        ." :routine_title "
        ." ,:routine_contents "
        ." ,:routine_due_time "
        ." ) "
        ;

    $arr_prepare =
    array(
        ":routine_title" => $param_arr["routine_title"]
        ,":routine_contents" => $param_arr["routine_contents"]
        ,":routine_due_time" => $param_arr["routine_due_hour"].$param_arr["routine_due_min"].'00'
    );

    $conn = null;
    
    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn -> prepare( $sql ); 
        $stmt -> execute( $arr_prepare ); 
        $last_no = $conn->lastInsertId();
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage(); 
    }
    finally 
    {
        $conn = null;
    }

    return $last_no;
}
/*
-todo list 관련 함수 중
새로운 루틴 정보를 데이터베이스에 추가하는 함수입니다.
-매개변수로는 새로운 루틴 정보를 담은 $param_arr이 전달됩니다. 
이 배열은 routine_title, routine_contents, routine_due_hour와 
routine_due_min등의 정보를 포함
-함수에서는 데이터베이스에 추가하기 위해 사용될 SQL문을 먼저 정의 
그리고 이후에는 $arr_prepare 배열에 매개변수에서 받아온 값들을 대입하고, 
prepare() 함수를 사용하여 SQL문을 데이터베이스에 전달. 
그리고 execute() 함수를 호출하여 SQL문을 실행.
-lastInsertId() 함수를 사용하여 마지막으로 추가된 레코드의 ID를 가져와 $last_no 변수에 저장. 
마지막으로 $last_no 변수를 반환
-insert page에서 사용
*/

/*---------------------------------------------
함수명 : todo_insert_routine_list
기능   : routine_info정보를 select해서 routine_list 테이블에 insert 
파라미터 : int      &$param_no
리턴값  :  int/str     $last_no/ERRMSG
-----------------------------------------------*/
function todo_insert_routine_list( &$param_no )
{
    $sql =
        " INSERT INTO "
        ." routine_list "
        ." ( "
        ." routine_no "
        ." ,list_title "
        ." ,list_contents "
        ." ,list_due_time "
        ." ) "
        ." SELECT "
        ." routine_no "
        ." ,routine_title "
        ." ,routine_contents "
        ." ,routine_due_time "
        ." FROM "
        ." routine_info "
        ." WHERE "
        ." routine_no = :routine_no "
        ;

    $arr_prepare =
    array(
        ":routine_no" => $param_no
    );

    $conn = null;
    
    try 
    {
        db_conn( $conn );
        $conn->beginTransaction();
        $stmt = $conn -> prepare( $sql ); 
        $stmt -> execute( $arr_prepare ); 
        $last_no = $conn->lastInsertId();
        $conn->commit();
    } 
    catch ( Exception $e) 
    {
        $conn->rollBack();
        return $e->getMessage(); 
    }
    finally 
    {
        $conn = null;
    }

    return $last_no;
}
/* 
-루틴 iinfo 테이블에서 루틴no를 가져와 해당 루틴 정보를 루틴 리스트 테이블에
새로운 할 일로 추가하는 작업을 수행함
-루틴 번호를 매개변수로 받아와서 해당 루틴의 정보를 루틴 정보 테이블에서 선택한 후 
이 정보를 기반으로 루틴 리스트에 새로운 할 일을 추가함
이때 추가된 할 일의 번호(PK)를 반환함
-insert page에서 사용


*/









//to do 
// $a = array( 
//             "routine_title"=>"str"
//             ,"routine_contents"=>"sttttt"
//             ,"routine_due_hour"=>12
//             ,"routine_due_min"=>12
//             );
// // var_dump($a);
// var_dump(todo_select_list($a));
// to do


?>