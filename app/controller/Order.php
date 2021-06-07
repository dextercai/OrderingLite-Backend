<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Session;
use think\facade\Request;
use app\model\Dtype;
use app\model\Dish;
use app\model\Table;
class Order
{
    public function typeList()
    {
        $Obj = new Dtype();
        return show(200, "OK", $Obj->select(), 200);
    }

    public function menuList(){
        $parm = Request::post(['type']);
        $parm['type'] = intval($parm['type']);
        $Obj = new Dish();
        return show(200, "OK", $Obj->where(['tid'=>$parm['type']])->select(), 200);
    }
    public function vaildTable(){
        $parm = Request::post(['tableToken']);
        $Obj = new Table();
        $parm['tableToken'] = trim($parm['tableToken']);
        if($parm['tableToken'] == null || $parm['tableToken'] == ""){
            return show(404, "NOT FOUNT", null, 200);
        }
        $result = $Obj->where(['token'=>$parm['tableToken']])->find();
        if($result != null){
            return show(200, "OK", $result, 200);
        }else{
            return show(404, "NOT FOUNT", null, 200);
        }

    }

    public function orderCommit(){
        $parm = Request::post(['list', 'tableToken']);
        $Obj = new Table();
        $parm['tableToken'] = trim($parm['tableToken']);
        $result = $Obj->where(['token'=>$parm['tableToken']])->find();
        if($result != null){
            $Obj = new \app\model\Session();
            $Session = $Obj->where(["tid"=>$result['id'], "isDone"=>"0"])->find();
            $Obj = new \app\model\Order();
            foreach ($parm['list'] as $item){
                $Obj->save(
                    [
                        "tid"=>$result['id'],
                        "did"=>$item['id'],
                        "amount"=>$item['amount'],
                        "sid"=>$Session['id'],
                        "status"=>"已下单"
                    ]
                );
            }
        }

        return show(200, "OK", null, 200);
    }

    public function orderList(){
        $parm = Request::post(['tableToken']);
        $Obj = new Table();
        $result = $Obj->where(['token'=>$parm['tableToken']])->find();
        $Obj = new Session();
        $result = $Obj->where(['tid'=>$result['id'], 'isDone'=>0])->find();

        if($result != null){
            return show(200, "OK", (new \app\model\Order())->where(['sid'=>$result['id']])->select(), 200);
        }else{
            return show(404, "NOT FOUNT", null, 200);
        }
    }


}