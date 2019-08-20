<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-19
 * Time: 17:23
 */

namespace app\api\library\service;


class Token
{
    //加密令牌
    public static function generateToken(){
        //32位无意义字符串
        $randStr = getRandStr(32);
        //时间戳
        $timestamp = $_SERVER['REQUEST_TIME'];
        //salt 加密盐
        $salt = config('secure.token_salt');

        return md5($randStr.$timestamp.$salt);
    }

}