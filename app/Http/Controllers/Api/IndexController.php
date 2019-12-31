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
    	$mlist = DB::table('article_list')->select(DB::raw('article_list.id,article_list.content,article_list.description,article_list.title,ifnull(article_zan.status,0) as zan'))
    			->join('article_zan',function($join) use($uid){
					$join->on('article_list.id', '=', 'article_zan.aid')
					->where('article_zan.uid',"=",$uid);
				},null,null,'left')
    			->where('catid',$id)
    			->where('state',1)
    			->where('is_pay',0)
    			->whereBetween('uptime',$times)
    			->limit(10)
                ->orderBy('uptime','desc')
    			->get()->toArray(); 
        $plist = DB::select('select b.id,b.content,b.title,b.description,ifnull(c.status,0) as zan from user_score_log as a left join article_list as b on a.memo = b.id left join article_zan as c on b.id=c.aid and c.uid = ? where a.type = 0 and a.user_id=? and b.is_pay=1 and b.catid=?',[$uid,$uid,$id]); 
        $list = array_merge((array)$mlist,(array)$plist);
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
    public function uinfo(Request $request)
    {
        $set = new Setting();
        $re = $set->getType('zuozuan');
        $uid = $request->input("uid",0);
        $user = DB::table("user")->select("score")->where("id",$uid)->first();
        $user->payscore = (int)$re['payzz'];
        return $this->ok(['msg'=>$user]);
    }
    public function getmore(Request $request)
    {
        # 付费获取
        $id  = $request->input("id",0);
        $uid = $request->input("uid",0);
        $set = new Setting();
        $re = $set->getType('zuozuan');
        $now = date("Y-m-d H:i:s");
        #查询用户信息
        $user = DB::table("user")->select("score")->where("id",$uid)->first();
        if ( ($user->score - $re['payzz']) <= 0) {
            return $this->die("100103","左钻不足，请充值后阅读！");
        }
        #查询付费信息 
        $sdata=[ 
            ':id' =>$id,
            ':uid'=>$uid
        ];
        $memo = DB::select('select memo from user_score_log as a left join article_list as b on a.memo = b.id
where a.type = 0 and a.user_id= :uid and b.is_pay=1 and b.catid=:id',$sdata);  
        $ids = [];
        if (!empty($memo)) {
            foreach ($memo as $v) {
                $ids[] = $v->memo ;
            } 
        }
        #查询列表排除已付费的新闻 
        $data = DB::table("article_list")->select(DB::raw("id,content,description,title,0 as zan"))
        ->where("catid",$id)->where('is_pay',1)->whereNotIn('id',$ids)->first(); 
        if (empty($data)) {
            return $this->die("100104","暂无更多文章！");
        } 
        #用户钻石减1
        $nowscore = $user->score - $re['payzz'];
        $resule = DB::update('update user set score=? where id = ?', [$nowscore,$uid]);
        #钻石记录
        DB::insert("insert into user_score_log (`user_id`,`score`,`before`,`after`,`type`,`memo`,`created_at`,`updated_at`) values (?,?,?,?,?,?,?,?)",[$uid,$re['payzz'],$user->score,$nowscore,0,$data->id,$now,$now]);
        return $this->ok(['data'=>$data]);
        
    }
}
