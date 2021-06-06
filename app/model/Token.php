<?php
declare (strict_types = 1);

namespace app\model;

use Firebase\JWT\JWT;
use think\facade\Cache;
use think\Model;

class Token
{

    static function creatToken($userId, $username, $userType){
        $time = time(); //签发时间
        $expire = $time + 10800 ; //过期时间 3小时后
        $payload = array(
            "user_id" => $userId,
            "username" => $username,
            "user_type" => $userType,
            "iss" => "demo.dextercai.com",
            "aud" => "dextercai",
            "iat" => $time,
            "nbf" => $time,
            "exp" => $expire
        );
        $token = JWT::encode($payload, config('token.token_private_pem'),'RS512');
        return $token;
    }
    static function cacheToken($token){
        return Cache::set(self::getUid($token) . '-Token', $token, 10800);
    }
    static function checkToken($token){
        return Cache::get(self::getUid($token) . '-Token') === $token;
    }
    static function removeToken($token){
        if(\app\model\Token::checkTokenVaild($token) === true && Token::checkToken($token) === true){
            Cache::delete(self::getUid($token) . '-Token');
            return true;
        }else{
            return false;
        }
    }
    static function getUid($token){
        if(self::checkTokenVaild($token)){
            $jwtAuth = json_encode(JWT::decode($token,config('token.token_public_pem'), array('RS512')));
            $authInfo = json_decode($jwtAuth, true);
            return $authInfo['user_id'];
        }else{
            return false;
        }
    }
    static function getUserType($token){
        if(self::checkTokenVaild($token)){
            $jwtAuth = json_encode(JWT::decode($token,config('token.token_public_pem'), array('RS512')));
            $authInfo = json_decode($jwtAuth, true);
            return $authInfo['user_type'];
        }else{
            return false;
        }
    }
    static function getUsername($token){
        if(self::checkTokenVaild($token)){
            $jwtAuth = json_encode(JWT::decode($token,config('token.token_public_pem'), array('RS512')));
            $authInfo = json_decode($jwtAuth, true);
            return $authInfo['username'];
        }else{
            return false;
        }
    }
    static function checkTokenVaild($token){
        try {
            $jwtAuth = json_encode(JWT::decode($token,config('token.token_public_pem'), array('RS512')));
            $authInfo = json_decode($jwtAuth, true);
            if (!empty($authInfo['user_id']) && !empty($authInfo['username'])) {
                return true;
            } else {
                return $jwtAuth;
            }
        } catch (\Firebase\JWT\ExpiredException $e) {
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

}
