<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login() {
        return view('login');
    }

    public function loginpost(Request $req) {
        Log::debug('Login Start', $req->only('email', 'password'));
        // 유효성 체크
        $validate = Validator::make(
            $req->only('email', 'password'),[
                'email' => 'required|email|max:30'
                ,'password' => 'required|max:30'
        ]);
        //log start와 end사이의 시간도 체크됨
        Log::debug("Validator end");

        if($validate->fails()) {
            Log::debug("Validator fails Start");

            //with에러 $validate를 세션에 담음
            return redirect()->back()->withErrors($validate);
        }

        //유저 정보 습득
        //돌아오는 형식이 엘로퀀트 떄랑 다름
        //pdo클래스랑 돌아오는 형식이 같음
        //각각 인덱스 0,1,2번방 식으로 하나하나 행이 드가있고
        //그 하나하나 행에는 해당하는 레코드의 모든 값이 연상배열로 들어가있음
        $user = DB::select('select id, email, password from users where email = ?', [
            $req->email
        ]);
        
        //자료가 없거나 비밀번호가 다르다면
        //req로 넘어온(입력된) 비밀번호랑 db에 있는 user의 비밀번호가 같지 않다면
        if(!$user || $req->password !== $user[0]->password) {
            //witherrors로 에러메시지 보낼때 배열로 보내기
            //그냥 문자열로 보내도 상관없긴함
            //이유가 witherrors드가보면 받는 파라미터가 문자열로 변경해주는 것도 있음
            //그래서 둘다 가능한듯
            //witherrors에서 에러메시지 담으면 헤더에서 알아서 처리해줌
            //view에서 $errors로 변수로 불러와서 사용 가능함!
            return redirect()->back()->withErrors("아이디와 비밀번호를 확인해주세요.");
        }
        //배열로 안담으면 에러남
        //배열이 아니라서 배열타입으로 만들어줌
        //$user[0]로 하면 객체로 돼서 배열로 만들어줘야함
        //디버그하는 위치 중요(에러남)
        Log::debug("Select user", [$user[0]]);
        
        //유저 인증 작업
        //에러작동 확인할려면 바로밑에있는줄 주석처리하고 아이디, 비번 맞게 쳐보면 됨
        Auth::loginUsingId($user[0]->id);
        if(!Auth::check()) {
            session($user[0]->id);
            Log::debug("유저인증 NG", [session()->all()]);
            return redirect()->back()->withErrors("인증처리 에러");
        } else {
            Log::debug("유저인증 OK", [session()->all()]);
            //로그인되면 홈으로 가도록
            //web.php에서 홈으로가는 route켜져있어야함
            return redirect('/');
        }
    }
}
