<?php

namespace App\Admin\Controllers;

use App\Models\WxOrder;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WxOrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '微信订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WxOrder);
        $grid->column('id', __('编号'));
        $grid->column('user.wx_name', __('用户'));
        $grid->column('money', __('金额'));
        $grid->column('type', __('类型'))->using([ 0 => '充值', 1 => '打赏',2 => '获取微信' ], '未知');
        $grid->column('aid', __('作品id'));
        $grid->column('order_no', __('订单号'));
        $grid->column('platform_number', __('微信订单号'));
        $grid->column('platform_status', __('支付状态 '))->using([ 0 => '处理中', 1 => '已完成',2 => '失败'  ], '未知')->dot([ 0 => 'warning', 1 => 'success',2 => 'danger', ], 'danger');
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));
        $grid->filter(function($filter){ 
            $filter->expand();
            $filter->disableIdFilter();
            $filter->column(1/2, function ($filter) {
                $filter->equal('id', '编号')->integer();
                $filter->equal('user.wx_name', '用户');
                $filter->equal('type', '类型')->radio([''=>"全部",0 => '充值', 1 => '打赏',2 => '获取微信' ]);
            });
            $filter->column(1/2, function ($filter) {
                $filter->equal('order_no', '订单号');
                $filter->equal('platform_status', '支付状态')->radio([''=>"全部",0 => '处理中', 1 => '已完成',2 => '失败' ]);
                $filter->date('created_at', "创建时间");
            }); 
        });
         $grid->disableCreateButton();
         $grid->actions(function ($actions) {
            // 去掉删除
            $actions->disableDelete();
            // 去掉编辑
            $actions->disableEdit();   
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
        $show = new Show(WxOrder::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('uid', __('Uid'));
        $show->field('money', __('Money'));
        $show->field('type', __('Type'));
        $show->field('aid', __('Aid'));
        $show->field('order_no', __('Order no'));
        $show->field('platform_number', __('Platform number'));
        $show->field('platform_status', __('Platform status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WxOrder);

        $form->number('uid', __('Uid'));
        $form->decimal('money', __('Money'));
        $form->switch('type', __('Type'));
        $form->number('aid', __('Aid'));
        $form->text('order_no', __('Order no'));
        $form->text('platform_number', __('Platform number'));
        $form->switch('platform_status', __('Platform status'));

        return $form;
    }
}
