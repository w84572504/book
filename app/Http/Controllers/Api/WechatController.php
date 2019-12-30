<?php
namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Common\WeChat;
use Illuminate\Support\Facades\Storage;
class WechatController extends ApiBaseController
{
    public function config(Request $request)
    {
    	$set = new Setting();
        $re = $set->getType('basic');
    	$url  = $request->input("url","");
    	$uid = $request->input("uid",0);
    	$wechat = new WeChat();
    	$access_token = $wechat->access_token();
    	$ticket = $wechat->jsapi_ticket($access_token);
    	$data = $wechat->getconfig($ticket,$url);
    	$link = $url.'?yid='.$uid;
    	$share =[
    		'title'=>$re['title'],
    		'desc'=>$re['description'],
    		'link'=>$link,
    		'imgUrl'=>$re['icon'],
    	];
    	return $this->ok(['data'=>$data,'share'=>$share]);
    }
    public function shareimg(Request $request)
    {
        $uid = $request->input("uid",0);
        $aid = $request->input("aid",0);
        $text =  $request->input("text",0);
        $baseurl = config("app.url"); 
        $filename = 'shareimg/'.$uid.'_'.$aid.'.jpg';
        $exists = Storage::disk('admin')->exists($filename); 
        if ($exists) {
            return $this->ok(['img'=>$baseurl.'/upload/'.$filename]);
        }
        $text = DeleteHtml($text);
        $textarr = explode("\n",$text);
        if (count($textarr) > 2) {
            $text = $textarr[0]."\n\n".$textarr[1];
        }
        $title =  $request->input("title",0);
        $title = DeleteHtml($title);
        $title = "《".$title."》";
        $set = new Setting();
        $wechat = new WeChat();
        $re = $set->getType('wechat');
        $basic = $set->getType('basic');

        $url = $basic['apiurl'].'/index/index?yid='.$uid;
        $qr = $wechat->getQRcode($url,$uid);
        $bg = public_path('upload').'/'.$re['shareimg'];
        $font =  public_path('upload').'/pingfang.otf'; 
        $config = array(
            'text'=>array(
                    array(
                        'text'=>$text,
                        'left'=>100,
                        'top'=>700,
                        'fontPath'=>$font, //字体文件
                        'fontSize'=>24, //字号
                        'fontColor'=>'37,31,31', //字体颜色
                        'angle'=>0,
                    ),
                    array(
                        'text'=>$title,
                        'left'=>600,
                        'top'=>900,
                        'fontPath'=>$font, //字体文件
                        'fontSize'=>20, //字号
                        'fontColor'=>'147,147,147', //字体颜色
                        'angle'=>0,
                    )
                ),
            'image'=>array(
                array(
                    'url'=>$qr, //图片资源路径
                    'left'=>270,
                    'top'=>-150,
                    'stream'=>0, //图片资源是否是字符串图像流
                    'right'=>0,
                    'bottom'=>0,
                    'width'=>300,
                    'height'=>300,
                    'opacity'=>100
                ),
            ),
            'background'=>$bg,
        );
        $url = $baseurl.'/'.$wechat->createPoster($config,'upload/'.$filename);  
        return $this->ok(['img'=>$url]);
    }
}
