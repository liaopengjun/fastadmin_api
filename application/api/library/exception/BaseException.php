<?php
namespace app\api\library\exception;
use think\Exception;
class BaseException extends Exception
{
    // HTTP 状态码 400 200 402
    public $code = 400;

    //错误信息
    public $msg = '参数错误';

    //自定义的错误码
    public $errorCode = 10000;

    //构造
    public function __construct($params = [])
    {
        //判断是否为数组
        if(!is_array($params)){
            return ;
            //       throw new  Exception("参数必须是数组");
        }
        //初始化
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }

        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }

        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }

    }

}