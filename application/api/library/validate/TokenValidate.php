<?php

/**
 * Created by PhpStorm.
 * User: liaopengjun
 * Date: 2019-08-19
 * Time: 11:09
 */
namespace app\api\library\validate;

class TokenValidate extends BaseValidate
{
    protected $rule = [
        'code' => 'require|isNotEmpty',
    ];
    protected $message = [
        'code' => '需要code才能获取token',
    ];
}