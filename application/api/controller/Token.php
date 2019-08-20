<?php

namespace app\api\controller;

use app\api\library\validate\TokenValidate;
use app\common\controller\Api;
use app\api\library\service\UserToken;
/**
 * Token接口
 */
class Token
{
    protected $noNeedLogin = [];
    protected $noNeedRight = '*';

    //获取token
    public function getToken($code)
    {
        //验证code
        (new TokenValidate())->goCheck($code);
         $userToken = new UserToken($code);
         $res = $userToken->getWxToken();
         return json($res);

    }

    //验证Token
    public function checkToken($code){

    }
}

