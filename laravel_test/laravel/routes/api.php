<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiUserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//{}안에 들어가는거는 유저가 우리한테 보내주는 거라서
//유저가 아는 값이어야함, id는 db를 보면 유저가 알 수가 없는 값이라서
//id아니고 email을 줌 email은 유저가 알고 본인이 입력하는 값이기 때문에

//restfull api 특징(쌤 깃허브 참고)
//최소한 이정도만 지키면 restfull api라고 생각된다고 함
//1.메소드에서 어떤 처리를 하는지가 다름
//get조회, post리소스 생성 인서트, upt 풋, del은 del
//2.url의 형태
//되도록이면 동사보다는 명사를 사용
//되도록이면 복수형 사용
//3.어떠한 행위가 들어가지 않아야 한다. 

//인증절차
//유저 정보는 아무한테나 주면 안돼서 인증돼있는 사람에게만 주도록 해야함
//진짜 유저가 맞는지 아닌지 인증하고 토큰을 주고 토큰을 통해서 get등을 통해서
//확인하고 json으로 보내줌
Route::get('/users/{email}', [ApiUserController::class, 'getuser']);
Route::post('/users', [ApiUserController::class, 'postuser']);
//특정값으로 조회한다는 거를 위해서 대상이되는걸 세그먼트 파라미터로 담아줌
//put은 세그먼트 파라미터가 있어도 되고 없어도됨
//??그 이유  못들음ㅋㅋ
Route::put('/users/{email}', [ApiUserController::class, 'putuser']);
//중복되는 레코드가 없어서 얘를 특정해서 삭제할 수 있음
Route::delete('/users/{email}', [ApiUserController::class, 'deleteuser']);
