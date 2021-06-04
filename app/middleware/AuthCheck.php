<?php
declare (strict_types = 1);

namespace app\middleware;

use app\model\Token;

class AuthCheck
{
    public function handle($request, \Closure $next)
    {
        if (Request()->header("X-Token") == "" || Request()->header("X-Token") == null) {
            return show(402, 'Token Needed', null, 200);
        }else{
            $thisToken = Request()->header("X-Token");
            if(Token::checkTokenVaild($thisToken) && Token::checkToken($thisToken)){
                $request->thisUserId = Token::getUid($thisToken);
                $request->thisUsername = Token::getUsername($thisToken);
            }else{
                return show(401, 'Unauthorized', null, 200);
            }
        }
        return $next($request);
    }
}
