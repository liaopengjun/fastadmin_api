<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-17
 * Time: 14:47
 */

namespace app\api\library\exception;


class ParameterException extends BaseException
{
    public $code = 400;
    public  $msg = '参数错误';
    public $errorCode = 10000;
}