<?php
/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-17
 * Time: 09:45
 */

namespace app\api\controller;

use app\api\library\exception\BrandException;
use app\common\controller\Api;
use app\admin\model\Brand as  BrandModel;

class Brand extends Api
{
    protected $noNeedLogin = ['*'];
    protected $noNeedRight = ['*'];

    //查询品牌
    public function getBrand(){
        $brandData = BrandModel::getBrandData();
        if(!$brandData){
            throw new BrandException();
        }
        return json($brandData);

    }
}