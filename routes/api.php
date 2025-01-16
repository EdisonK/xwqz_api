<?php

//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
| 这个没啥用，暂时注释掉
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


$api = app('Dingo\Api\Routing\Router');



$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 100, 'expires' => 5],function ($api) {


    $api->group(['middleware' => 'api.auth'],function ($api){

    });
});




