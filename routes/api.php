<?php

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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1','prefix' => 'api/v1'], function ($api) {
    $api->post('register', 'AuthController@register');
    $api->post('login', 'AuthController@login');
    $api->post('logout', 'AuthController@logout');
    $api->get('test', 'AuthController@test');

    //验证token
    $api->group(['middleware' => 'refresh'],function ($api){
        $api->post('me', 'AuthController@me');
        $api->post('refresh', 'AuthController@refresh');
    });

    //获取文章
    $api->get('article','IndexController@index');
    //获取广告位
    $api->get('adverts','IndexController@adverts');
    //获取所有标签
    $api->get('tag','IndexController@tag');
});
