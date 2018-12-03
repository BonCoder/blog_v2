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
$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1','prefix' => 'api/v1','middleware'=>'entrance'], function ($api) {
    $api->post('register', 'AuthController@register');
    $api->post('login', 'AuthController@login');
    $api->post('logout', 'AuthController@logout');
    $api->get('test', 'AuthController@test');

    //验证token
    $api->group(['middleware' => 'refresh'],function ($api){
        $api->post('me', 'AuthController@me');
        $api->post('refresh', 'AuthController@refresh');
    });

    //开发文档说明
    $api->get('doc',function (){
        $doc = file_get_contents(base_path().DIRECTORY_SEPARATOR.'doc'.DIRECTORY_SEPARATOR.'blog-api.md');
        return view('home.doc.index',['doc'=>$doc]);
    });

    //站点基本信息
    $api->get('site','IndexController@site');
    //获取广告位
    $api->get('adverts','IndexController@adverts');
    //获取所有标签
    $api->get('tag','IndexController@tag');
    //获取所有友链
    $api->get('links','IndexController@links');

    $api->group(['prefix' => 'article'],function ($api){
        //文章列表
        $api->get('/','IndexController@index');
        //获取文章详情
        $api->get('/{article}','ArticleController@detail')->where(['article' => '[0-9]+']);
        //获取文章评论列表
        $api->get('/{article}/comments','CommentsController@index')->where(['article' => '[0-9]+']);
        //文章评论
        $api->post('/{article}/comments','CommentsController@store')->middleware('refresh');
    });

});
