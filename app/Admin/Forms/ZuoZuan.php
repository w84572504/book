<?php

namespace App\Admin\Forms;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;
use App\Models\Setting;

class ZuoZuan extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '左钻配置';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        $set = new Setting();
        $input = $request->all(); 
        foreach ($input as $key => $value) {  
            $set->where('app', 'zuozuan')
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
        $this->currency('5','5左钻需要金额')->symbol('￥');
        $this->currency('10','10左钻需要金额')->symbol('￥');
        $this->currency('20','20左钻需要金额')->symbol('￥');
        $this->currency('50','50左钻需要金额')->symbol('￥');
        $this->currency('100','100左钻需要金额')->symbol('￥');
        $this->currency('200','200左钻需要金额')->symbol('￥'); 
        $this->number('yq','邀请获得左钻');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        $set = new Setting();
        $list = $set->select("*")->where("app","zuozuan")->get()->toArray(); 
        $arr = [];
        foreach ($list as $key => $value) {
            $arr[$value['var']] = $value['value'];
        }

        return $arr;
    }
}
