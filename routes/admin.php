<?php

$api = app('Dingo\Api\Routing\Router');

$params = [
    'middleware' => [
        'api.throttle',
        'bindings'
    ],
    'limit' => 100,
    'expires' => 5
];


$api->version('v1', $params,function ($api) {


    $api->group(['prefix'=>'admin'],function ($api){

        $api->get('tieying',[\App\Http\Controllers\Admin\StatisticController::class,'tieying']);

        $api->group(['middleware' => 'api.auth'],function ($api){
            /*
             * 用户管理
             * 使用管理资源
             * */
            $api->patch('users/{user}/lock',[\App\Http\Controllers\Admin\UserController::class,'lock']);



            $api->resource('users',\App\Http\Controllers\Admin\UserController::class, [
                'only' => ['index','show']
            ]);
            //网页目录相关
            $api->resource('menus',\App\Http\Controllers\Admin\MenuController::class,[
                'except' => ['destroy']
            ]);

            //铁鹰报备
            $api->resource('baobeis',\App\Http\Controllers\Admin\BaobeiController::class,[
                'except' => ['destroy']
            ]);



        });

    });
});




