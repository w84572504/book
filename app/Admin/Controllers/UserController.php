<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Controllers\ModelForm;  
class UserController extends Controller
{
    use ModelForm;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    public function index(Content $content)
    {
        return $content
            ->header('用户管理')
            ->body($this->grid());
    }
    public function show($id, Content $content)
    {
        return $content
            ->header('用户管理')
            ->body($this->detail($id));
    } 
     
     public function edit($id, Content $content)
    {
        return $content
            ->header('用户管理')
            ->body($this->form()->edit($id));
    } 
    public function create(Content $content)
    {
        return $content
            ->header('创建用户')
            ->withWarning('注意', '手动创建用户并不能关联微信用户，只可以在浏览器中使用！')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);
        $grid->id('编号');
        $grid->invest_uid("邀请人编号");
        $grid->wx_name("微信名");
        $grid->column('wx_img', '头像')->image('',30,30);
        $grid->score("左钻");
        $grid->created_at("注册时间");
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('wx_name', '微信名'); 
            $filter->like('created_at', "注册时间"); 
        });
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));
        $show->invest_uid("邀请人编号");
        $show->wx_name("微信名");
        $show->wx_img("头像")->image(); 
        $show->score("左钻");
       
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User);  
        $form->number('invest_uid','邀请编号'); 
        $form->text('wx_name','微信名'); 
        $form->image('wx_img','头像');
        $form->number('score','左钻');  
        //保存前回调
        $form->saving(function (Form $form){
            $form->password = md5($form->password); 
        }); 

        return $form;
    } 

    
}
