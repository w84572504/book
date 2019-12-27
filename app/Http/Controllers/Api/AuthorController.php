<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use App\Common\Curls;
use App\Common\AppAuth;
class AuthorController extends ApiBaseController
{
    public function index(Request $request)
    {
    	return $this->ok(['data'=>'ok']);
    }
    public function geturl(Request $request)
    {
        $reurl = $request->input("reurl",""); 
        $type = $request->input("type",""); 
    	$url = $this->re_url($reurl,$type);
    	return $this->ok(['url'=>$url,'reurl'=>$reurl]);
    }
    public function getopenid(Request $request)
    {
        $code = $request->input("code",0);
        $set = new Setting();
        $re = $set->getType('wechat');
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$re['app_id']}&secret={$re['app_secret']}&code={$code}&grant_type=authorization_code";
        $curl = new Curls();
        $body = $curl->goCurl(
                $url,  
                "",
                $headers = array('Content-Type' => 'charset=utf-8'),
                'get'
            );
        $body = json_decode($body, true); 
        if (!empty($body['errcode']) && $body['errcode']) {
            return $this->die($body['errcode'],"获取失败！".$url);
        } 
        $user = DB::table("user")->select("*")->where("wx_id",$body['openid'])->first();
        $token = "";
        $reurl = "";
        $status = 0;
        if ($user) {
            $auth = new AppAuth('',$user->id); 
            $token = $auth->loginToken();
            $status = 1; 
        }else{
            if ($body['scope'] == 'snsapi_userinfo') { 
                $infourl = "https://api.weixin.qq.com/sns/userinfo?access_token={$body['access_token']}&openid={$body['openid']}&lang=zh_CN";
                $body = $curl->goCurl(
                    $infourl,  
                    "",
                    $headers = array('Content-Type' => 'application/json; charset=utf-8'),
                    'get'
                );
            $body = json_decode($body, true);
            $dataIn=[ 
                "wx_name"=>$body['nickname'],
                "wx_id"=>$body['openid'],  
                "wx_img"=>$body['headimgurl'],
                "score"=>0, 
            ];
            $id = DB::table("user")->insertGetId($dataIn); 
            $auth = new AppAuth('',$id); 
            $token = $auth->loginToken(); 
            $status=1;
            }else{
               $reurl = $this->re_url("",1); 
            }  
        }
        return $this->ok(['url'=>$reurl,'token'=>$token,'status'=>$status,'replace'=>'']);
    }
    private function re_url($reurl,$type)
    {
        $set = new Setting();
        $re = $set->getType('wechat'); 
        $url = config("app.url").'/author';  
        if (env('APP_NAME') == 'zuoxiang') {
           $redirect_uri = urlencode($url);
        }else{
            $redirect_uri = urlencode("http://192.168.7.111:8080/author");
        }
        $scope = $type ==1 ?  "snsapi_userinfo" : "snsapi_base";
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$re['app_id']}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=STATE#wechat_redirect"; 
    }
}
