<?php
namespace App\Http\Controllers\Api;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends ApiBaseController
{
    public function index(Request $request)
    {
    	$set = new Setting();
        $re = $set->getType('basic');
    	$time = $re['time']; 
    	$banner = DB::table('banner')->select(["id","url","img"])->where('status',1)->orderBy('sort','asc')->get();
    	$list = DB::table('article_category')->select(["id","name"])->where('state',1)->where('pid',1)->get();
    	foreach ($banner as &$value) { 
    		$value->img = config("app.url").'/upload/'.$value->img;
    	}
    	return $this->ok(['time'=>$time,'banner'=>$banner,'list'=>$list]);
    }
    public function getlist(Request $request)
    {
    	$set = new Setting();
    	$re = $set->getType('basic'); 
    	$times = gettimes($re['time']); 
    	$id = $request->input("id",0);
    	$uid = $request->input("uid",0); 
    	$list = DB::table('article_list')->select(DB::raw('article_list.id,article_list.content,article_list.description,article_list.title,ifnull(article_zan.status,0) as zan'))
    			->join('article_zan',function($join) use($uid){
					$join->on('article_list.id', '=', 'article_zan.aid')
					->where('article_zan.uid',"=",$uid);
				},null,null,'left')
    			->where('catid',$id)
    			->where('state',1)
    			->where('is_pay',0)
    			->whereBetween('created_at',$times)
    			->limit(10)
    			->get();
    	return $this->ok(['data'=>$list]);
    }
    public function changezan(Request $request)
    {
        # 点赞
        $id  = $request->input("id",0);
        $status = $request->input("status",0);
        $uid = $request->input("uid",0);
        $re = DB::table("article_zan")->updateOrInsert(['uid' => $uid, 'aid' => $id],['status' => $status]);
        return $this->ok(['msg'=>'成功！']);
    }
}
