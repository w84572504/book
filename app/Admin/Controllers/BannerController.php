<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Models\Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner);

        $grid->column('id', __('编号')); 
        $grid->column('url', __('地址')); 
        $grid->column('img', __('图片'))->image('',100,60); 
        $grid->column('sort', __('排序'));
        $grid->column('status', __('状态'))->using([ 0 => '待上线', 1 => '已上线',  ], '未知')->dot([ 0 => 'danger', 1 => 'success', ], 'danger');; 
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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));   
        $show->field('url', __('地址'));
        $show->field('img', __('图片'))->image();
        $show->field('sort', __('排序'));
        $show->field('status', __('状态'))->using([ 0 => '待上线', 1 => '已上线',  ], '未知')->dot([ 0 => 'danger', 1 => 'success', ], 'danger');; 

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Banner);

        $form->url('url','地址');
        $form->image('url','头像');
        $form->number('sort', __('排序'));
        $form->switch('status', __('状态'))->default(1);

        return $form;
    }
}
