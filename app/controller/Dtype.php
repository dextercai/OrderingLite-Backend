<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;

class Dtype
{
    public function list()
    {
        $Obj = new \app\model\Dtype();
        return show(200, "OK", $Obj->selectOrFail(), 200);
    }

    public function update()
    {
        if (\request()->thisUserType == 1){
            return show(403, "ERROR", null, 200);
        }else{
            $parm = \think\facade\Request::post(['id', 'name']);
            $Obj = new \app\model\Dtype();
            if(!empty($parm['id'])){
                $parm['id'] = intval($parm['id']);
                $Obj = $Obj->where(['id'=>$parm['id']]);
            }
            return show(200, "操作完成", $Obj->data($parm)->save(), 200);
        }

    }
    public function delete()
    {
        if (request()->thisUserType == 1){
            return show(403, "您当前身份无权操作", null, 200);
        }else{
            $parm = \think\facade\Request::post(['id']);
            $Obj = new \app\model\Dtype();
            if(!empty($parm['id'])){
                $parm['id'] = intval($parm['id']);
                $Obj = $Obj->where(['id'=>$parm['id']]);
            }else{
                return show(403, "非法操作", null, 200);
            }
            return show(200, "操作完成", $Obj->find()->delete(), 200);
        }

    }
}