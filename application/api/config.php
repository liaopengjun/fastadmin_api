<?php

//配置文件
return [
    'exception_handle'        => '\\app\\api\\library\\exception\\ExceptionHandle',
    // 小程序app_id
    'app_id' => 'wx85e5d198e25f13f4',
    // 小程序app_secret
    'app_secret' => 'e055a1d2de8cda3c8062a5a1454f4829',

    // 微信使用code换取用户openid及session_key的url地址
    'login_url' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",

];
