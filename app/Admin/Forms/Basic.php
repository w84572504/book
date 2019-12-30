<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '基础设置';

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
            if ($key == "icon") { 
                $FileType = $value->getClientOriginalExtension(); //获取文件后缀
                $FilePath = $value->getRealPath(); //获取文件临时存放位置
                $FileName = 'basic/'.date('Ymd') . uniqid() . '.' . $FileType; //定义文件名 
                $rel = Storage::disk('admin')->put($FileName, file_get_contents($FilePath)); //存储文件
                $value = $FileName; 
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
        $this->switch('state', '站点开关');
        $this->url('apiurl', '前端网站地址');
        $this->text('title','站点名称')->rules('required');
        $this->text('description','站点描述')->rules('required');
        $this->text('keywords','站点关键词')->rules('required'); 
        $this->image('icon','图标')->rules('required'); 
        $this->text('icp','备案信息')->rules('required');  
        $this->time('time','文章更新时间')->rules('required')->format('HH:mm');;  
        $this->text('phone','电话')->rules('required');  
        $this->text('email','邮箱')->rules('required');  
        $this->text('address','地址')->rules('required');  
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $set = new Setting();
        $list = $set->all()->toArray(); 
        $arr = [];
        foreach ($list as $key => $value) {
            $arr[$value['var']] = $value['value'];
        } 
        return $arr;
    }
}
