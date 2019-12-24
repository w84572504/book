<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Common\AppAuth;

class ApiBaseController extends Controller{
	
	public function die($code,$msg)
    { 
    	$json = ['code'=>$code,'msg'=>$msg];
        return response()->json($json);
    }
    #操作成功
    public function ok($msg)
    {
    	$json = ['code'=>'200','msg'=>$msg]; 
        return response()->json($json);
    }
}
