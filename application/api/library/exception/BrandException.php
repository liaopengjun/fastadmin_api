<?php
namespace app\api\library\exception;
class BrandException extends BaseException
{
    public $code = 400;
    public  $msg = '请求的品牌信息不存在';
    public $errorCode = 10000;
}