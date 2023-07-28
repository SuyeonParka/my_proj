<?php
namespace application\model;

class ShopModel extends Model{
    //제품 목록 조회 기능
    public function getList($listFlg = "", $num = 0) {
        $sql = 
            " SELECT "
            ." * "
            ." FROM "
            ." product_list "  
            ;
        // $num가 0이 아니고 listFlg가 빈문자열 일때 $sql 변수에 문자열을 추가
        // .= : 접합한 값을 왼쪽 변수에 할당
        if($num !== 0 && $listFlg = ""){
            $sql .= " WHERE ".$listFlg." = :".$listFlg;
        }

        $prepare = [];

        if($num !== 0) {
            $prepare[":".$listFlg] = $num;
        }


        $conn = null;

        try {
                // 데이터베이스 연결 객체($this->conn)을 사용하여 sql문장 준비
                $stmt = $this->conn->prepare($sql);
                // sql 문장 실행
                $stmt->execute($prepare);
                // 실행 결과 모두 가져옴
                $result = $stmt->fetchAll();
                
        } catch (Exception $e) {
            // 오류 발생시 오류 메시지 출력, 프로그램 종료
            echo "ProductModel->getList Error : ".$e->getMessage();
            exit();

        }
        // 결과 반환
        return $result;
    }

    // 상품 검색 기능
    // public function listSearch() {
    //     $sql =
    //         " SELECT "
    //         ." * "
    //         ." FROM "
    //         ." product_info "
    //         ." WHERE "
    //         ." list_name LIKE '%$search_word%$' ";

    //     $t = $_GET['want'];
    //     $result = mysqli_query($conn, $sql);

    //     while($board = $sql->fetch_array()) {
    //         $list = $board["list_name"];
    //     }
    //     return $result;
    // }
}