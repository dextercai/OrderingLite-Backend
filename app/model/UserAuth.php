<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class UserAuth extends Model
{
    protected $table = "t_user";
    protected $pk = 'id';
    protected $readonly = ['id','username'];
    private $thisUser;
    public function verifyPassword($username, $password)
    {
        $this->thisUser = self::where(['username' => $username])->find();
        if($this->thisUser != null){
            return password_verify($password,$this->thisUser->getAttr('password'));
        }else{
            return false;
        }

    }
    public function getLastUsername(){
        return $this->thisUser->getAttr('username');
    }
    public function getLastUserId(){
        return $this->thisUser->getAttr('id');
    }
    public function getLastUserType(){
        return $this->thisUser->getAttr('type');
    }

    public function findUser($userId){
        $this->thisUser = self::find($userId);
        return $this->thisUser;
    }
    public function getUserType($userId = ""){
        if($userId != ""){
            $this->thisUser = self::find($userId);
        }
        return $this->thisUser->getAttr('type');
    }
}
