<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-20
 * Time: 09:33
 */

namespace app\admin\model;
use think\Model;

class Token  extends Model
{
    //获取缓存数据
    public static function getTokenData($openid){
        return self::where('openid',$openid)->find();
    }

    public static function setToken($data){
        return self::insert($data);
    }

//    public static function upToken($id,$data){
//       return self::save($data,['id'=>$id]);
//    }
}