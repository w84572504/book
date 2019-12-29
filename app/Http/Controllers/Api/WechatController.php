<?php
namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Common\WeChat;

class WechatController extends ApiBaseController
{
    public function config(Request $request)
    {
    	$url  = $request->input("url","");
    	$wechat = new WeChat();
    	$access_token = $wechat->access_token();
    	$ticket = $wechat->jsapi_ticket($access_token);
    	$data = $wechat->getconfig($ticket,$url);
    	return $this->ok(['data'=>$data]);
    }
}
