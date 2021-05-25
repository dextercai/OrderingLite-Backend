<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Token;
use app\model\UserAuth;
use think\Request;

class Auth
{
    public function Login()
    {
        $param =  \think\facade\Request::post(['username', 'password']);
        if(empty($param['username']) || empty($param['password'])){
            return show(400, "Invalid input", null, 200);
        }else{
            $Auth = new UserAuth();
            if ($Auth->verifyPassword($param['username'], $param['password'])) {
                //验证成功，生成Token
                try {
                    $token = Token::creatToken($Auth->getLastUserId(),$Auth->getLastUsername(), $Auth->getLastUserType());
                    Token::cacheToken($Auth->getLastUserId(), $token);
                    return show(200, "Login success", ['token' => $token], 200);
                }catch (\Exception $e){
                    //Token生成失败
                    return show(200, "Login Process Failed", null, 200);
                }
                # code...
            }else{
                return show(401, "Login Failed", null, 200);
            }
        }
    }
}
