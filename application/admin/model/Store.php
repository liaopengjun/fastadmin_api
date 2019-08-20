<?php

namespace app\admin\model;

use think\Model;


class Store extends Model
{

    

    

    // 表名
    protected $name = 'store';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    protected $deleteTime = false;

    // 追加属性
    protected $append = [

    ];

    /**
     * @return Store[]|false
     * @throws \think\exception\DbException
     */
    public static function getStoreAllData(){
            $result = self::all();
            return $result;
    }

    /**
     * @param $id
     */
    public static function getStoreData($id){
        $result = self::where('id',$id)->find();
        return $result;
    }










}
