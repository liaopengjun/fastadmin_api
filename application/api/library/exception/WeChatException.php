<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-19
 * Time: 16:18
 */

namespace app\api\library\exception;

class WeChatException extends  BaseException
{
    public  $code =404;
    public  $msg = '';
    public  $errorCode = '999';
}