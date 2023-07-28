<?php
namespace application\model;

class UserModel extends Model{
    public function getUser($arrUserInfo, $pwFlg = true) { // 두개가 있으면 두개 쓰고 하나만 있으면 하나만 씀
        $sql = " SELECT "
            ." * "
            ." FROM "
            ." user_info "
            ." WHERE "
            ." u_id = :id "
            ;
        
            if($pwFlg) {
                $sql .= " and u_pw = :pw";  // 아이디 중복 (아이디는 같고 비번을 다를 때 아이디 중복이 안된다고 해서 하는 작업)
            }

        $prepare = [
            ":id" => $arrUserInfo["id"]
        ];

        // pw 추가한 동적 쿼리
        if($pwFlg) {
            $prepare[":pw"] = $arrUserInfo["pw"];
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($prepare);
            $result = $stmt->fetchAll(); 
        } catch (Exception $e) {
            echo "UserModel->getUser Error : ".$e->getMessage();
            exit();
        }

        return $result;
    }
    
    public function insertUserInfo($arrUserInfo) {

        $sql =
        " INSERT INTO "
        ." user_info "
        ." ( "
        ." u_id "
        ." ,u_pw "
        ." ,u_name "
        ." ) "
        ." VALUES "
        ." ( "
        ." :u_id "
        ." , :u_pw "
        ." , :u_name "
        ." ) "
        ;

        $arr_prepare =
            [
                ":u_id" => $arrUserInfo["id"]
                ,":u_pw" => $arrUserInfo["pw"]
                ,":u_name" => $arrUserInfo["name"]
            ];

        
        try 
        {
            $stmt = $this->conn -> prepare( $sql ); 
            $result = $stmt -> execute( $arr_prepare ); 
            return $result;
        } 
        catch ( Exception $e) 
        {
            return false;
        }
    }
    
    //회원정보 수정
    public function userUpdate($arrUpt) {
        $sql =
            " UPDATE "
            ." user_info "
            ." SET "
            ." u_name = :name " //:name은 변수같은 느낌. 아무거나 적어도 됨
            ." ,u_pw = :pw "
            ." WHERE "
            ." u_id = :id "
            ;

        $arr_prepare = array( 
            ":id" => $arrUpt["id"]
            ,":pw" => $arrUpt["pw"]
            ,":name" => $arrUpt["name"]
        );

        $conn = null;

        try 
        {
            $stmt = $this->conn -> prepare( $sql ); 
            $result = $stmt -> execute( $arr_prepare ); 
            return $result;
        } 
        catch ( Exception $e) 
        {
            return false; //에러났을 때 리턴 false
        }
    }

    // 회원정보 삭제 플래그 설정
    public function uptUserDelFlg( $uDelFlg )
    {
    $sql = 
        " UPDATE routine_info "
        ." SET "
        ."  u_flg = '1' "
        ." WHERE u_no = :u_no "  
        ;
    
    $arr_prepare = 
        array(
            ":u_no" => $uDelFlg["u_no"]
        );
    
    $conn = null;

    try 
    {
        $stmt = $this->conn -> prepare( $sql ); 
        $result = $stmt -> execute( $arr_prepare ); 
        return $result;
    } 
    catch ( Exception $e) 
    {
        return false; //에러났을 때 리턴 false
    }
    }

// 회원정보 삭제
    public function listDel($list_del){
        $sql =
            " DELETE "
            ." FROM "
            ." user_info "
            ." WHERE "
            ." u_no = :u_no "
            ;
        
    $arr_prepare =
    array(
        "u_no" => $list_del["u_no"]
    );

    $conn = null;
    try 
    {
        $stmt = $this->conn -> prepare( $sql ); 
        $result = $stmt -> execute( $arr_prepare ); 
        return $result;
    } 
    catch ( Exception $e) 
    {
        return false; //에러났을 때 리턴 false
    }
            return $result;
        }
    }
