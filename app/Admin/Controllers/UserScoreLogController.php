<?php

namespace App\Admin\Controllers;

use App\Models\UserScoreLog;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UserScoreLogController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '左钻日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserScoreLog); 
        $grid->column('user.wx_name', __('用户名'));
        $grid->column('score', __('消费左钻'));
        $grid->column('before', __('消费前'));
        $grid->column('after', __('消费后'));
        $grid->column('type', __('类型'))->using([ 0 => '消费', 1 => '充值',2 => '邀请',  ], '未知');
        $grid->column('memo', __('文章编号或邀请人编号'));
        $grid->column('created_at', __('时间'));
        $grid->filter(function($filter){
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->like('user_id', '用户编号'); 
            $filter->like('memo', '作品编号'); 
            $filter->date('created_at', "时间"); 
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
        $show = new Show(UserScoreLog::findOrFail($id)); 
        $show->field('user_id', __('用户编号'));
        $show->field('score', __('消费左钻'));
        $show->field('before', __('消费前'));
        $show->field('after', __('消费后'));
        $show->field('type', __('类型'))->using([ 0 => '消费', 1 => '充值',2 => '邀请',  ], '未知');
        $show->field('memo', __('文章编号或邀请人编号'));
        $show->field('created_at', __('时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserScoreLog);

        $form->number('user_id', __('用户编号'));
        $form->number('score', __('消费左钻'));
        $form->number('before', __('消费前'));
        $form->number('after', __('消费后'));
        $form->select('type', __('类型'))->options([0 => '消费', 1 => '充值', 2 => '邀请']);
        $form->number('memo', __('作品编号'));  
        $form->time('created_at', __('创建时间'))->format('YYYY-MM-DD HH:mm:ss');  
        return $form;
    }
}
