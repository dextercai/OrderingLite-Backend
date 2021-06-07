<?php
declare (strict_types = 1);

namespace app\controller;

use think\Request;

class Session
{
    public function list(){
        $Obj = new \app\model\Table();
        $Result = $Obj->selectOrFail();
        $ObjSession = new \app\model\Session();
        $ObjUser = new \app\model\User();
        $ObjOrder = new \app\model\Order();
        $ObjDish = new \app\model\Dish();

        foreach ($Result as &$_t){
            $_t['session'] = $ObjSession->where(["tid"=>$_t['id'],"isDone"=>0])->find();
            if(!empty($_t['session']['uid'])){
                $_t['user'] = $ObjUser->where(["id"=>$_t['session']['uid']])->withoutField('password')->find();
                $_t['dish'] = $ObjOrder->where(['sid'=>$_t['session']['id']])->select();
                foreach ($_t['dish'] as &$_d){
                    $_d['detail'] = $ObjDish->where(['id'=>$_d['did']])->find();
                }
            }

        }
        return show(200, "OK", $Result, 200);
    }

    public function ret(){
        $parm = \think\facade\Request::post(['oid']);
        if(empty($parm['oid'])){
            return show(403, "ERROR", null, 200);
        }
        $Obj = new \app\model\Order();
        $result = $Obj->where(['id'=>$parm['oid']])->find();
        if($result->status != "已下单"){
            return show(403, "菜品已出菜或已退菜，操作失败", null, 200);
        }
        $result->amount = 0;
        $result->status = "已退菜";
        (new \app\model\Table())->where(['id'=>$result['tid']])->find()->save(['token'=>""]);
        if($result->save()){
            return show(200, "操作成功", null, 200);
        }else{
            return show(500, "操作失败", null, 200);
        }
    }

    public function commitPay(){
        $parm = \think\facade\Request::post(['sid']);
        if(empty($parm['sid'])){
            return show(403, "ERROR", null, 200);
        }
        $Obj = new \app\model\Session();
        $result = $Obj->where(['id'=>$parm['sid']])->find();
        $result->isDone = 1;
        $result->endtime = time();
        if($result->save()){
            return show(200, "操作成功", null, 200);
        }else{
            return show(500, "操作失败", null, 200);
        }
    }
    public function start(){
        $parm = \think\facade\Request::post(['tid']);
        if(empty($parm['tid'])){
            return show(403, "ERROR", null, 200);
        }
        (new \app\model\Session())->save(
            [
                "isDone"=>0,
                'tid'=>intval($parm['tid']),
                'uid'=>intval(\request()->thisUserId),
                'starttime'=>time()
            ]
        );
        (new \app\model\Table())->where(['id'=>intval($parm['tid'])])->save(['token'=>$this->GetRandStr(6)]);
        return show(200, "操作成功", null, 200);

    }

    function GetRandStr($len)
    {
        $chars = array(
            "A", "B", "C", "D", "E", "F", "G",
            "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R",
            "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2",
            "3", "4", "5", "6", "7", "8", "9"
        );
        $charsLen = count($chars) - 1;
        shuffle($chars);
        $output = "";
        for ($i=0; $i<$len; $i++)
        {
            $output .= $chars[mt_rand(0, $charsLen)];
        }
        return $output;
    }
}