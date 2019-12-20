<?php

namespace App\Admin\Controllers;

use App\Models\ArticleList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\Facades\DB;
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
        $grid->column('id', __('编号'))->sortable();
        $grid->column('post.name', __('分类'));
        $grid->column('title', __('作品名'));
        $grid->column('author', __('微信号'));
        $grid->column('state', __('状态'))->using([ 0 => '待上线', 1 => '已上线',  ], '未知')->dot([ 0 => 'danger', 1 => 'success', ], 'danger');
        $grid->column('zan', __('点赞'))->display(function ($zan) {
            $count = count($zan);
            return $count;
        })->label('success'); 
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
        $show->field('id', __('编号'));
        $show->field('catid', __('所属栏目'));
        $show->field('title', __('标题'));
        $show->field('author', __('作者微信号'));
        $show->field('state', __('状态'))->using([ 0 => '待上线', 1 => '已上线',  ], '未知');
        $show->field('description', __('描述'));
        $show->field('pv', __('点赞'))->display(function ($zan) { $count = count($zan); return $count; }) ;  
        $show->field('is_pay', __('是否付费'))->using([ 0 => '否', 1 => '是',  ], '未知');
        $show->field('content', __('内容'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

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
        $list = DB::table('article_category')->select(['id','name'])->where("pid",0)->get()->toArray(); 
        $arr =[];
        foreach ($list as $key => $value) {
            $arr[$value->id] = $value->name;
        } 
        $form->select('pids','一级分类')->options($arr)->load('catid', '/admin/test');
        $form->select('catid','所属栏目'); 
        $form->text('title', __('标题'));
        $form->text('author', __('微信号'));
        $form->switch('state', __('是否上线'))->default(1);
        $form->text('description', __('描述'));
        $form->number('pv', __('浏览量')); 
        $form->switch('is_pay', __('是否付费'))->default(1);;
        $form->textarea('content', __('内容')); 
        $form->saving(function (Form $form){ 
        });  
        $form->ignore(['pids']);
        return $form;
    }
}
