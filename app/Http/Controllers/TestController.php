<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends BaseController
{
    public function index()
    {

//       return User::all();
       return User::find(1);
    }

    public function users(){
//        return User::find(1);
//        获取当前登录的用户,四种方式
//        $user = app('Dingo\Api\Auth\Auth')->user();
//        return $user;

//        $user = auth('api')->user();
//        return $user;

//        $user = $this->auth()->user();
//        return $user;


//        $user = Auth::guard('api')->user();
//        return $user;

        auth('api')->login(1);
        $user = $this->auth->user();
        return $user;

    }

    public function login(Request $request){
//        dd(bcrypt('123'));

        $credentials = request(['email', 'password']);


        if(!$token = auth('api')->attempt($credentials)){
//            return response()->json(['error' => 'Unauthorized'], 401);
            return $this->response->errorUnauthorized();
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }



}
