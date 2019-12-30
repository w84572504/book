<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
class WeChat extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '微信配置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $set = new Setting();
        $input = $request->all(); 
        foreach ($input as $key => $value) { 
            if ($key == "state" ) {
                if ($value == "on") {
                    $value = 1;
                }else{
                    $value = 0;
                }
            }
            if ($key == "icon" || $key == "shareimg" ||$key == "apiclient_cert" ||$key == "apiclient_key" ) { 
                $FileType = $value->getClientOriginalExtension(); //获取文件后缀
                $FilePath = $value->getRealPath(); //获取文件临时存放位置
                $FileName = 'wechat/'.date('Ymd') . uniqid() . '.' . $FileType; //定义文件名 
                $rel = Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
                $value = $FileName; 
            }
            $set->where('app', 'wechat')
                ->where('var', $key)
                ->update(['value' => $value]);
            
        } 
        admin_success('修改配置成功！');

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->text('app_id','公众号的appid')->rules('required');
        $this->text('app_secret','公众号的secret')->rules('required');
        $this->image('shareimg','分享背景图片'); 
        $this->image('icon','分享图标'); 
        $this->text('mc_id','商户id')->rules('required');
        $this->text('key','微信商户支付的密钥')->rules('required');
        $this->text('notify_url','回调地址')->rules('required');  
        $this->file('apiclient_cert','证书文件');  
        $this->file('apiclient_key','密钥文件'); 
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $set = new Setting();
        $list = $set->select("*")->where("app","wechat")->get()->toArray(); 
        $arr = [];
        foreach ($list as $key => $value) {
            $arr[$value['var']] = $value['value'];
        }

        return $arr;
    }
}
