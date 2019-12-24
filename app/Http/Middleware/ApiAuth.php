<?php

namespace App\Http\Middleware;

use Closure;
use App\Common\AppAuth; 
use Illuminate\Support\Str;
class ApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = "";
        $authorization = $request->header('authorization');
        if (Str::startsWith($authorization, 'Bearer ')) {
            $token  = Str::substr($authorization, 7);
        }
        if(!empty($token)){ 
            $auth  = new AppAuth($token);
            if($auth->getToken() && $auth->role()){
                $request->merge(['uid'=>$auth->getUid()]);
                return $next($request);
            }else{
                $errMsg = $auth->getErrMsg();
                $json = ['code'=>"100",'msg'=>$errMsg];
                return response()->json($json); 
            }
            
        }else{
                $json = ['code'=>"101",'msg'=>"接口错误!"];
                return response()->json($json); 

        }
    }
}
