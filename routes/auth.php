<?php

$api = app('Dingo\Api\Routing\Router');



$api->version('v1', ['middleware' => 'api.throttle', 'limit' => 100, 'expires' => 5],function ($api) {

    $api->group(['prefix' => 'auth'],function ($api){
        $api->post('register',[\App\Http\Controllers\Auth\RegisterController::class,'store']);
        $api->post('login',[\App\Http\Controllers\Auth\LoginController::class,'login']);



        $api->group(['middleware' => 'api.auth'],function ($api){
            $api->post('logout',[\App\Http\Controllers\Auth\LoginController::class,'logout']);
            $api->post('refresh',[\App\Http\Controllers\Auth\LoginController::class,'refresh']);

        });

    });


});




