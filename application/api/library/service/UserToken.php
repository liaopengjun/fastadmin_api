<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-19
 * Time: 11:32
 */
namespace app\api\library\service;
use app\api\library\exception\WeChatException;
use think\Exception;

use app\admin\model\Token as TokenModel;


class UserToken  extends Token
{
    protected $code;
    protected $wxAppid;
    protected $wxSecret;
    protected $wxUrl;

    public function __construct($code)
    {
        $this->code = $code;
        $this->wxAppid= config('app_id');
        $this->wxSecret = config('app_secret');
        $this->wxUrl = sprintf( config('login_url'),$this->wxAppid,$this->wxSecret,$this->code);

    }

    //获取用户信息
    public function getWxToken(){
        $result = curl_get($this->wxUrl);
        $wxResult = json_decode($result,true);
        if(empty($wxResult)){
            throw new Exception("获取session_key及Openid时异常，微信内部错误");
        }else{
            $loinFail = array_key_exists('errcode',$wxResult);
            //是否成功
            if($loinFail){
                //返回错误码
                $this->processLoginErorr($wxResult);
            }else{
                //
                return $this->grantToken($wxResult);
            }
        }
    }
    //正确返回Token 存token
   private function grantToken($wxResult){

        //需要缓存数据
        $time = time()+7200;
        $data = [
            'openid'=>$wxResult['openid'],
            'session_key'=>$wxResult['session_key'],
            'expiretime'=>$time,
        ];

       //生产令牌 写入缓存数据库
       $token = $this->saveToDb($data);
       //返回令牌
       return $token;

   }

   //将需要缓存的数据保存数据库
   private function saveToDb($param){

        //是否存表过
       $tokenData = TokenModel::getTokenData($param['openid']);

       if($tokenData){

            $token = $this->ckeckToken($tokenData,$param);

       }else{

           //写入缓存
           $token =  self::generateToken();
           $param['expiretime'] = time()+7200;
           $param['token'] = $token;
           TokenModel::setToken($param);
       }
       return $token;

   }

   //验证token是否过期 (过期则更新）
    public function ckeckToken($tokenData,$param){

            if($tokenData['expiretime']<time()){
                //更新缓存表
                $token= self::generateToken();
                $data['expiretime'] = time()+7200;

                $data['token'] = $token;
                $tokenModel = new TokenModel();
                $tokenModel->save($data,['id'=>$tokenData['id']]);
                return $token;
            }else{
                return $tokenData['token'];
            }

    }


    protected function processLoginErorr($wxResult){
        throw new WeChatException([
            'msg' => $wxResult['errmsg'],
            'errorCode' => $wxResult['errcode'],
        ]);
    }

}