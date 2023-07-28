<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    public function getuser($email) {
        //[$email]은 ?에 들어갈 거
        //원래 보통 유저 정보 가져올 때는 비번은 안가져옴
        $user = DB::select('select name, email from users where email = ?', [$email]);
        $arr = [
            'code' => '0'
            ,'msg' => ''
        ];

        if($user) {
            $arr['code'] = '0';
            $arr['msg'] = 'Success Get User';
            //가져온 유저 0번
            $arr['data'] = $user[0];
        } else {
            $arr['code'] = 'E01';
            $arr['msg'] = 'No Data';
        }
        //stdClass
        //배열을 리턴해주면 json(라라벨이 자동으로 바꿔줌)형태로 시리얼라이징 해줌
        //localhost/api/users/a@a.a쳐보깅~!
        return $arr;
    }

    public function postuser(Request $req) {
        $arr = [
            'code' => '0'
            ,'msg' => ''
        ];
        $result = DB::insert('insert into users(name, email, password) values(?, ?, ?)'
        ,[
            $req->name 
            ,$req->email
            ,Hash::make($req->password)
        ]);

        if($result) {
            $arr['code'] = '0';
            $arr['msg'] = 'Success Registration';
            $arr['data'] = [$req->email];
        }else {
            $arr['code'] = 'E01';
            $arr['msg'] = 'Faild Registration';
        }
        return $arr;
    }

    public function putuser(Request $req, $email) {
        $arr = [
            'code' => '0'
            ,'msg' => ''
        ];
        $result = DB::update('update users set name = ? where email = ?'
        ,[
            $req->name 
            ,$email
        ]);

        if($result) {
            $arr['code'] = '0';
            $arr['msg'] = 'Success Update';
            $arr['data'] = [$req->name];
        }else {
            $arr['code'] = 'E01';
            $arr['msg'] = 'Faild Update';
        }
        return $arr;
    }

    public function deleteuser($email) {
        $arr = [
            'code' => '0'
            ,'msg' => ''
        ];
        $date = Carbon::now();
        $result = DB::update(
            'update users set deleted_at = ?, deleted_flg = ? where email = ?'
            ,[
                $date
                ,'1'
                ,$email
            ]);

            if($result) {
                $arr['code'] = '0';
                $arr['msg'] = 'Success Delete';
                $arr['data'] = ['deleted_at' => $date, 'email' => $email];
            }else {
                $arr['code'] = 'E01';
                $arr['msg'] = 'Faild Delete';
            }
            return $arr;
    }

}

    

