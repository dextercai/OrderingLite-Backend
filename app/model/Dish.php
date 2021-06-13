<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Dish extends Model
{
    protected $table = "t_dish";

    public function dtype()
    {

        return $this->hasOne(Dtype::class, 'id', 'tid');
    }
}
