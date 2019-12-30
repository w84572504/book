<?php
namespace App\Common;
use App\Common\Curls;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use tekintian\qrcode_tiny\QRcode;

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
    public function getQRcode($url,$uid)
    {
        $existsurl = 'qr/'.$uid.'.png';
        $qr_name = 'upload/qr/'.$uid.'.png';
        $exists = Storage::disk('admin')->exists($existsurl);
        if ($exists) {
            return $qr_name;
        }
        $qr_data = $url; //二维码数据
        $qr_error_correction_level = 'L'; //纠错级别：L、M、Q、H
        $qr_matrix_point_size = 10; //二维码矩阵点大小，单位：点， 1到10 数值越大生成的图片就越大
        $qrcode = new QRcode();
        # 使用方法一
        $re = $qrcode::png($qr_data, $qr_name, $qr_error_correction_level, $qr_matrix_point_size, 2);
        return $qr_name; 
    }
    /**
    生成宣传海报
    @param array 参数,包括图片和文字
    @param string $filename 生成海报文件名,不传此参数则不生成文件,直接输出图片
    @return [type] [description]
    */
    function createPoster($config=array(),$filename=""){
        //如果要看报什么错，可以先注释调这个header
        // if(empty($filename)) header("content-type: image/png");
        $imageDefault = array(
            'left'=>0,
            'top'=>0,
            'right'=>0,
            'bottom'=>0,
            'width'=>100,
            'height'=>100,
            'opacity'=>100
        );
        $textDefault = array(
            'text'=>'',
            'left'=>0,
            'top'=>0,
            'fontSize'=>32, //字号
            'fontColor'=>'255,255,255', //字体颜色
            'angle'=>0,
        );
        $background = $config['background'];//海报最底层得背景
        //背景方法
        $backgroundInfo = getimagesize($background);
        $backgroundFun = 'imagecreatefrom'.image_type_to_extension($backgroundInfo[2], false);
        $background = $backgroundFun($background);
        $backgroundWidth = imagesx($background); //背景宽度
        $backgroundHeight = imagesy($background); //背景高度
        $imageRes = imageCreatetruecolor($backgroundWidth,$backgroundHeight);
        $color = imagecolorallocate($imageRes, 0, 0, 0);
        imagefill($imageRes, 0, 0, $color);
        // imageColorTransparent($imageRes, $color); //颜色透明
        imagecopyresampled($imageRes,$background,0,0,0,0,imagesx($background),imagesy($background),imagesx($background),imagesy($background));
        //处理了图片
        if(!empty($config['image'])){
            foreach ($config['image'] as $key => $val) {
                $val = array_merge($imageDefault,$val);
                $info = getimagesize($val['url']);
                $function = 'imagecreatefrom'.image_type_to_extension($info[2], false);
                if($val['stream']){ //如果传的是字符串图像流
                $info = getimagesizefromstring($val['url']);
                $function = 'imagecreatefromstring';
                }
                $res = $function($val['url']);
                $resWidth = $info[0];
                $resHeight = $info[1];
                //建立画板 ，缩放图片至指定尺寸
                $canvas=imagecreatetruecolor($val['width'], $val['height']);
                imagefill($canvas, 0, 0, $color);
                //关键函数，参数（目标资源，源，目标资源的开始坐标x,y, 源资源的开始坐标x,y,目标资源的宽高w,h,源资源的宽高w,h）
                imagecopyresampled($canvas, $res, 0, 0, 0, 0, $val['width'], $val['height'],$resWidth,$resHeight);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']) - $val['width']:$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']) - $val['height']:$val['top'];
                //放置图像
                imagecopymerge($imageRes,$canvas, $val['left'],$val['top'],$val['right'],$val['bottom'],$val['width'],$val['height'],$val['opacity']);//左，上，右，下，宽度，高度，透明度
            }
        }
        //处理文字
        if(!empty($config['text'])){
            foreach ($config['text'] as $key => $val) {
                $val = array_merge($textDefault,$val);
                list($R,$G,$B) = explode(',', $val['fontColor']);
                $fontColor = imagecolorallocate($imageRes, $R, $G, $B);
                $val['left'] = $val['left']<0?$backgroundWidth- abs($val['left']):$val['left'];
                $val['top'] = $val['top']<0?$backgroundHeight- abs($val['top']):$val['top'];
                imagettftext($imageRes,$val['fontSize'],$val['angle'],$val['left'],$val['top'],$fontColor,$val['fontPath'],$val['text']);
            }
        }
        //生成图片
        if(!empty($filename)){
            $res = imagejpeg ($imageRes,$filename,90); //保存到本地
            imagedestroy($imageRes);
            if(!$res) return false;
            return $filename;
        }else{
            imagejpeg ($imageRes); //在浏览器上显示
            imagedestroy($imageRes);
        }
    }
}
