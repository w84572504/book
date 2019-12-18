<?php

namespace App\Admin\Controllers;

use App\Models\ArticleList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ArticleListController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '作品列表';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleList);
        $grid->column('contentid', __('编号'))->sortable();
        $grid->column('post.name', __('分类'));
        $grid->column('title', __('作品名'));
        $grid->column('author', __('作者'));
        $grid->column('state', __('状态'))->using([ 0 => '待上线', 1 => '已上线',  ], '未知')->dot([ 0 => 'danger', 1 => 'success', ], 'danger');
        $grid->column('pv', __('点击量'))->label('success'); 
        $grid->column('is_pay', __('是否付费'))->bool(['1' => true, '0' => false]); 
        $grid->column('created_at', __('创建时间'))->sortable(); 
        $grid->filter(function($filter){ 
            $filter->expand();
            $filter->disableIdFilter();
            $filter->column(1/2, function ($filter) {
                $filter->equal('id', '编号')->integer();
                $filter->equal('post.name', '分类名称');
                $filter->equal('state', '状态')->radio([''=>"全部",0 => '待上线', 1 => '已上线', ]);
            });
            $filter->column(1/2, function ($filter) {
                $filter->equal('author', '作者');
                $filter->equal('is_pay', '是否付费')->radio([''=>"全部",0 => '否', 1 => '是', ]);
                $filter->date('created_at', "创建时间");
            }); 
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
        $show = new Show(ArticleList::findOrFail($id));

        $show->field('contentid', __('Contentid'));
        $show->field('catid', __('Catid'));
        $show->field('title', __('Title'));
        $show->field('author', __('Author'));
        $show->field('state', __('State'));
        $show->field('description', __('Description'));
        $show->field('pv', __('Pv'));  
        $show->field('is_pay', __('Is pay'));
        $show->field('content', __('Content'));
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
        $form = new Form(new ArticleList);
        $form->number('contentid', __('Contentid'));
        $list = DB::table('article_category')->select(['id','name'])->where("pid",0)->get()->toArray(); 
        $arr =[];
        foreach ($list as $key => $value) {
            $arr[$value->id] = $value->name;
        } 
        $form->select('pid','父级名称')->options($arr);
        $form->number('catid', __('Catid'));
        $form->text('title', __('Title'));
        $form->text('author', __('Author'));
        $form->switch('state', __('State'))->default(1);
        $form->text('description', __('Description'));
        $form->number('pv', __('Pv')); 
        $form->switch('is_pay', __('Is pay'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
