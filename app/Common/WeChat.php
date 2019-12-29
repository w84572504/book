<?php
namespace App\Common;
use App\Common\Curls;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class WeChat
{
    private static $app_id; 
    private static $app_secret;
    function __construct() 
    {
        $Setting = new Setting(); 
        $re = $Setting->getType('wechat');
        
        self::$app_id = $re['app_id'];#$param['ACCESS_ID'];
        self::$app_secret = $re['app_secret'];#$param['ACCESS_KEY']
    }
    public function access_token()
    { 
        $now = time();
        $exists = Storage::disk('local')->exists('wechat/access_token.txt');
        if (!$exists) {
            return $this->gettoken();
        }
        $time = Storage::lastModified('wechat/access_token.txt');
        $contents = Storage::get('wechat/access_token.txt');
        $contents = json_decode($contents,true);
        if (( $time+$contents['expires_in'] ) - $now > 10) {
            #未过期 直接返回token
            return $contents['access_token'];
        }else{
            #过期 返回新的token
            return $this->gettoken();
        }
    }
    public function jsapi_ticket($token)
    {
        $now = time();
        $exists = Storage::disk('local')->exists('wechat/jsapi_ticket.txt');
        if (!$exists) {
            return $this->getticket($token);
        }
        $time = Storage::lastModified('wechat/jsapi_ticket.txt');
        $contents = Storage::get('wechat/jsapi_ticket.txt');
        $contents = json_decode($contents,true);
        if (( $time+$contents['expires_in'] ) - $now > 10) {
            #未过期 直接返回token
            return $contents['ticket'];
        }else{
            #过期 返回新的token
            return $this->getticket($token);
        }
    }
    private function gettoken(){
        $data=[
            'grant_type'=>'client_credential',
            'appid'=>self::$app_id,
            'secret'=>self::$app_secret,
        ];
        $curl = new Curls();
        $body = $curl->goCurl(
                "https://api.weixin.qq.com/cgi-bin/token", 
                $data, 
                $headers = array('Content-Type' => 'application/json; charset=utf-8'),
                'get'
            );
        $body = json_decode($body, true);
        if(isset($body['errcode'])){
            return false;
        } 
        #做文件存储
        $filename = "wechat/access_token.txt";
        $contents = json_encode($body);
        Storage::put($filename, $contents);
        return $body['access_token'];
    }
    private function getticket($token){
        $data=[
            'access_token'=>$token,
            'type'=>'jsapi',
        ];
        $curl = new Curls();
        $body = $curl->goCurl(
                "https://api.weixin.qq.com/cgi-bin/ticket/getticket", 
                $data, 
                $headers = array('Content-Type' => 'application/json; charset=utf-8'),
                'get'
            );
        $body = json_decode($body, true); 
        if($body['errcode'] != 0){
            return false;
        } 
        #做文件存储
        $filename = "wechat/jsapi_ticket.txt";
        $contents = json_encode($body);
        Storage::put($filename, $contents);
        return $body['ticket'];
    }
    public function getconfig($ticket,$url)
    {
        // $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        // dd($url);
        $noncestr = $this->createNonceStr();
        $timestamp = time();
        $string1 = "jsapi_ticket={$ticket}&noncestr={$noncestr}&timestamp={$timestamp}&url={$url}";
        $signature = sha1($string1);    
        $signPackage = array(        
            'appId'     => self::$app_id,        
            'nonceStr'  => $noncestr,        
            'timestamp' => $timestamp,        
            'signature' => $signature,
        );    
        return $signPackage;
    }
    public function createNonceStr()
    {
        //取随机10位字符串
        $codeSet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i<16; $i++) {
            $codes[$i] = $codeSet[mt_rand(0, strlen($codeSet)-1)];
        }
        $nonceStr = implode($codes);
        return $nonceStr;
    }
}
