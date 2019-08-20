<?php
namespace app\api\controller;
use app\api\library\validate\IDMustBePostiveInt;
use app\admin\model\Pmodel as PmodelModel;

class Pmodel
{
    //获取指定型号
    public function getPmodel($id){
        //验证
        (new IDMustBePostiveInt())->goCheck();
        $result = PmodelModel::getAllBrandData($id);
        return json($result);

    }
    //获取全部型号
    public function getPmodelAll(){
        $result = PmodelModel::getAllBrandData();
        return json($result);

    }

}