<?php

namespace app\api\library\exception;

use Exception;
use think\Log;
use think\Request;
use think\exception\Handle;

/**
 * 自定义API模块的错误显示
 */
class ExceptionHandle extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(Exception $e)
    {

        if($e instanceof  BaseException){

            //如果是自定义错误
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;

        }else{
            if(config('app_debug') =='true'){
                return parent::render($e);
            }else{
                //服务器内部错误
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                //记录日志
                $this->rescordErrorLog($e);

            }


        }

        $request = Request::instance();

        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' =>$request->url(),
        ];

        return json($result,$this->code);
    }

    /**
     *  日志手动写入
     */
    public function rescordErrorLog(Exception $e){
        //初始化log
        Log::init([
            'type'  =>  'File',
            'path'  => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }

}
