<?php

namespace application\controller;

class ShopController extends Controller {
    public function mainGet() {
        return "main"._EXTENSION_PHP;
    }

    // 상품 목록을 모두 가져와서 출력 기능
    public function allList() {
        $result = $this->model->getList();
        //db 연결 종료
        $this->model->closeConn();
        // 가져온 결과의 개수가 0이 라면 오류 메시지 출력 종료
        if (count($result) === 0) {
            echo $errMsg = "상품이 없어여";
            exit;
        }
        // 상품 목록을 출력하는 echoList 메소드 호출
        $this->echoList($result);
    }

    // 특정 카테고리의 상품 목록을 가져와서 출력하는 기능 
    public function viewList($list_cate_no) {
        // getList 메소드 호출, 특정 카테고리 상품 목록 가져옴
        $result = $this->model->getList("list_cate", $list_cate_no);
        //db 연결 종료
        $this->model->closeConn();
        // 결과 없을 시 에러메시지 출력, 종료
        if (count($result) === 0) {
            echo $errMsg = $list_cate."의 상품 정보가 없음.";
            exit;
        }
        // 상품 목록 출력하는 echoList 메소드 호출
        $this->echoList($result);
    }

    // 상품 목록 받아와서 카드 형식으로 html로 출력
    public function echoList($arr_result) {
        // 초기값으로 $i 변수를 0으로 설정
        $i = 0;
        while ($i < count($arr_result)) {
        // arr_result 배열의 길이만큼 반복문 실행
        $val = $arr_result[$i];
        //$val 변수에 $arr_result[$i]의 값 할당해줌
        echo 
        '<div class="col d-flex justify-content-center pt-3 pb-3">
            <div class="card" style="width: 18rem;  float:none; margin:0 auto; border:none;">
                <img src="'.$val['list_img'].'" class="card-img-top">
                <div class="card-body">
                    <a href="/user/detail?list_no='.$val['list_no'].'">
                        <h5 class="card-title">'.$val['list_name'].'</h5>
                        <p class="card-text">'.$val['list_price'].'</p>
                    </a>
                </div>
            </div>
        </div>
        ';
        // 각각 배열의 해당 키에 저장된 값을 사용해서 출력
        $i++;
        }
    }

    // public function echoList($arr_result) {
    //     foreach ($arr_result as $val)
    //     echo 
    //     '<div class="col d-flex justify-content-center pt-3 pb-3">
    //         <div class="card" style="width: 18rem;  float:none; margin:0 auto; border:none;">
    
    //             <img src="'.$val['list_img'].'" class="card-img-top">
    //             <div class="card-body">
    //                 <a href="/user/detail?list_no='.$val['list_no'].'">
    //                     <h5 class="card-title">'.$val['list_name'].'</h5>
    //                     <h5 class="card-title">'.$val['list_detail'].'</h5>
    //                     <p class="card-text">'.$val['list_price'].'</p>
    //                 </a>
    //             </div>
    //         </div>
    //     </div>';
    //     }
}
