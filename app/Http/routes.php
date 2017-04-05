<?php


//接入路由
Route::any(env('URL_CONNECT'), 'WechatController@valid');
//配置授权回调域名
Route::any(env('URL_AUTH_CONNECT'),'WechatController@checkSignature');


Route::get('/les1','CollectionController@les1');
Route::get('/les2','CollectionController@les2');
