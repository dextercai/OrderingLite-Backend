<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\ODS;
use think\Request;

class Stat
{
    public function now(){
        $Obj = new \app\model\Table();
        $result = [
            [
                'name'=> "暂未使用",
                'value'=> $Obj->where(['token'=>''])->count()
            ],
            [
                'name'=> "正在使用",
                'value'=> $Obj->where('token','<>','')->count()
            ],
        ];
        return show(200,"OK",$result,200);
    }

    public function dish(){

        $Obj = new ODS();
        $result = [
            'x'=> array_reduce($Obj->field('name')->select()->toArray(), function ($result, $value) {
                return array_merge($result, array_values($value));
            }, array()),
            'y'=> array_reduce($Obj->field('amount')->select()->toArray(), function ($result, $value) {
                return array_merge($result, array_values($value));
            }, array()),
        ];
        return show(200,"OK",$result,200);
    }
}