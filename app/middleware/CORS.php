<?php
declare (strict_types = 1);

namespace app\middleware;

use app\model\Token;

class CORS
{
    public function handle($request, \Closure $next)
    {


        $origin = isset($_SERVER['HTTP_ORIGIN'])? $_SERVER['HTTP_ORIGIN'] : '';
        $allow_origin = array(
            'http://localhost:8082'
        );
        if(in_array($origin, $allow_origin)){
            header('Access-Control-Allow-Origin:'.$origin);
        }

        header('Access-Control-Allow-Credentials:true');
        header("Access-Control-Allow-Methods:POST, GET, PATCH, DELETE, PUT, OPTION");
        header("Access-Control-Allow-Headers:Origin, X-Requested-With, Content-Type, Accept, Cookie, X-Token");
        return $next($request);
    }
}
