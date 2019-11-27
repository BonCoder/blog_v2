<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Routing\Registrar as RouteRegisterContract;

Route::group([],function (RouteRegisterContract $web){
    //文件上传接口，前后台共用
    $web->post('uploadImg', 'PublicController@uploadImg')->name('uploadImg');
    //发送短信
    $web->post('/sendMsg', 'PublicController@sendMsg')->name('sendMsg');

    $web->get('/','Home\IndexController@index')->name('home');

    $web->get('/article/{id}','Home\IndexController@article');

});


