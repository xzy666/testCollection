<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AuthCallController extends Controller
{
    public function getCode(Request $request)
    {
        $appid=$request->get('appid');
        $redirect_uri=$request->get(env('REDIRECT_URI'));//这里是指定在服务号上指定的回调路由，就是直接调用下面geToken方法
        $scope=$request->get('scope');// snsapi_base/snsapi_userinfo
        $state=$request->get('state');//我觉得这个参数基本没啥用 默认可以使用1
        $get_code_url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='
            .$appid. '&redirect_uri='.
            $redirect_uri. '&response_type=code&scope='
            .$scope.'&state='
            .$state.
            '#wechat_redirect';
        return redirect()->to($get_code_url);
    }

    public function getToken(Request $request)
    {
        $code = json_decode($request->all());

        Code::create(['code'=>$code]);//code存入数据库 虽然5分钟会过期 蛮存
        if (isset($code->errcode)){
            //获取code失败后操作重新获取和其他一些操作...
            return redirect()->action('getCode');
        }
        $url=env('你要回调的地址').'/code='.$code;
        return redirect()->to($url);
        //或者你可以这样
        file_get_contents('URL');//多个路由被调用
        file_get_contents('URL');
        file_get_contents('URL');
        file_get_contents('URL');






        /*$access_token=$request->get('access_token');
        $appid=env('appid');
        $secret=env('secret');
        $get_info_url='https://api.weixin.qq.com/sns/oauth2/'
            .$access_token. '?appid='
            .$appid .'&secret='
            .$secret.'&code=CODE&grant_type=authorization_code';
        $userInfo = json_decode(file_get_contents($get_info_url));
        if (isset($userInfo->errcode)){
            //获取用户信息失败后操作重新获取和其他一些操作...
            return redirect()->action('getCode');
        }
        dd($userInfo);*/
    }

}
