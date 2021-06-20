<?php


namespace app\controller;


class Kitchen
{
    public function alllist(){
        $Obj = new \app\model\OSTU();
        $Result = $Obj->select();
        return show(200, "OK", $Result, 200);
    }

    public function prelist(){
        $Obj = new \app\model\OSTU();
        $Result = $Obj->whereRaw("status <> '拒单' AND status <> '已出菜'")->select();
        return show(200, "OK", $Result, 200);
    }

    public function donelist(){
        $Obj = new \app\model\OSTU();
        $Result = $Obj->whereRaw("status = '拒单' OR status = '已出菜'")->select();
        return show(200, "OK", $Result, 200);
    }

    public function toPre()
    {
        $parm = \think\facade\Request::post(['id', 'amount', 'status']);
        if(empty($parm['id'])){
            return show(403, "ERROR", null, 200);
        }
        $Obj = new \app\model\Order();
        $result = $Obj->where(['id'=>$parm['id']])->find();
        $result->status = $parm['status'] ? $parm['status'] : $result->status;
        $result->amount = isset($parm['amount']) ? $parm['amount'] : $result->amount  ;
        if($result->save()){
            return show(200, "操作成功", $result->getLastSql(), 200);
        }else {
            return show(500, "操作失败", null, 200);
        }
    }
}