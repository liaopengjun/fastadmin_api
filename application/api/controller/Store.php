<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-17
 * Time: 16:18
 */

namespace app\api\controller;
use app\admin\model\Store as StoreModel;
use app\api\library\validate\IDMustBePostiveInt;
use app\admin\model\Pmodel as PmodelModel;

class Store
{

    //获取全部门店
    public function getStoreAll(){
        $list = StoreModel::getStoreAllData();
        return json($list);
    }

    //获取门店详情
    public function getStoreDetail($id){
        //验证
        (new IDMustBePostiveInt())->goCheck();
        $result = StoreModel::getStoreData($id);
        return json($result);
    }

}