<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;

class User
{
    public function list()
    {
        $Obj = new \app\model\User();
        return show(200, "OK", $Obj->withoutField('password')->select(), 200);
    }

    public function update()
    {
        if (\request()->thisUserType == 1){
            return show(403, "ERROR", null, 200);
        }else{
            $parm = \think\facade\Request::post(['id', 'username', 'password', 'type']);
            $Obj = new \app\model\User();
            if(!empty($parm['id'])){
                if($parm['id'] == 1 && $parm['type'] == 1){
                    return show(403, "创始用户不可操作", null, 200);
                }
                $parm['id'] = intval($parm['id']);
                $Obj = $Obj->where(['id'=>$parm['id']]);

            }
            if(empty($parm['password'])){
                unset($parm['password']);
            }else{
                $parm['password'] = password_hash($parm['password'], PASSWORD_BCRYPT);
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
            $Obj = new \app\model\User();
            if(!empty($parm['id'])){
                $parm['id'] = intval($parm['id']);
                $Obj = $Obj->where(['id'=>$parm['id']]);
            }else{
                return show(403, "非法操作", null, 200);
            }
            if($parm['id'] == 1){
                return show(403, "创始用户不可操作", null, 200);
            }
            return show(200, "操作完成", $Obj->find()->delete(), 200);
        }

    }
}
