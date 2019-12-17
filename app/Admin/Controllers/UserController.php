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
        $grid->invest_uid("邀请人id");
        $grid->phone("手机号");
        $grid->wx_name("微信名");
        $grid->score("左钻");
        $grid->created_at("注册时间");
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('wx_name', '微信名'); 
            $filter->like('phone', '手机号'); 
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

        $show->invest_uid("邀请人id");
        $show->phone("手机号");
        $show->wx_name("微信名");
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
        $form->number('invest_uid','邀请id'); 
        $form->text('password','密码'); 
        $form->mobile('phone','手机号');
        $form->number('score','左钻'); 
        $form->saving(function (Form $form){
            //填写获取表单内容
            $this->beforePassStatus = $form->model()->is_pass;

        });

        $form->saved(function (Form $form){
            //添加要判断及更改的字段
            if($this->beforePassStatus != $form->model()->is_pass)
            {
                $checkedBy = Admin::user()->name;
                $user = User::find($form->model()->id);
                $user->checked_by = $checkedBy;
                $user->save();
            }
        });

        return $form;
    } 

    
}
