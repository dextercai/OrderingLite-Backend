<?php
declare (strict_types = 1);

namespace app\controller;

use think\facade\Request;
use app\model\Dtype;
use app\model\Dish;
class Order
{
    public function typeList()
    {
        $Obj = new Dtype();
        return show(200, "OK", $Obj->select(), 200);
    }

    public function menuList(){
        $parm = $param = Request::post(['type']);
        $parm['type'] = intval($parm['type']);
        $Obj = new Dish();
        return show(200, "OK", $Obj->where(['tid'=>$parm['type']])->select(), 200);
    }
}