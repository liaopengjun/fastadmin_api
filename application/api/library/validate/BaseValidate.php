<?php
namespace app\api\library\validate;
use app\api\library\exception\ParameterException;
use think\Validate;
use think\Request;
class BaseValidate extends Validate
{
    public function  goCheck(){

        $params = Request::instance()->param();
        $result = $this->batch()->check($params);

        if(!$result){
            //参数异常抛出
            $e = new ParameterException([
                'msg' => $this->error,
            ]);
            throw $e;

        }else{
            return true;
        }

    }

    //验证整数类型
    public function isPositiveInteger($value,$rule='',$data='',$field=''){
        if( is_numeric($value) && is_int($value + 0) && ($value+0)>0){
            return true;
        }else{
            return false;
        }
    }

    //验证是否为空
    public function isNotEmpty($value,$rule='',$data='',$field=''){
        if(!$value){
            return false;
        }else{
            return true;
        }
    }
    //获取指定参数的值
    public function  getDataByRule($arrays){

        //验证恶意提交用户标识
        if(array_key_exists('user_id',$arrays) || array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg'=>'传递非法参数user_id或uid',
            ]);
        }

        $newsArray = [];
        foreach ($this->rule as $k=>$v){
            $newsArray[$k] = $arrays[$k];
        }
        return $newsArray;
    }
    //验证手机号
    protected function isMobile($value)
    {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


}