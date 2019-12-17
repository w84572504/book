<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Setting;

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
            $set->where('app', 'basic')
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
        $this->text('key','微信商户支付的密钥')->rules('required'); 
        $this->text('notify_url','回调地址')->rules('required');  
        $this->file('apiclient_cert','证书文件')->rules('required');  
        $this->file('apiclient_key','密钥文件')->rules('required'); 
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
