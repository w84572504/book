<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\ArticleCategory;

class ArticleCategoryController extends AdminController
{
    protected function grid()
    {
        $grid = new Grid(new ArticleCategory);

        $grid->catid('ID')->sortable();
        $grid->title('文章标题');
        $grid->pid('父级id');
        $grid->name('名称');
        $grid->alias('别名');
        $grid->keywords('关键字');
        $grid->description('描述');
        $grid->sort('排序');
        $grid->state('状态');
        $grid->updated_at('修改时间');

        return $grid;
    }
    protected function form()
    {
        $form = new Form(new ArticleCategory);

        $form->text('title','文章标题');
        $form->textarea('content','文章内容');

        $form->display('id', '文章ID');
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');

        return $form;
    }
    protected function detail($id)
    {
        $show = new Show(ArticleCategory::findOrFail($id));

        $show->id('文章ID');
        $show->title('文章标题');
        $show->content('文章内容');
        $show->created_at('创建时间');
        $show->updated_at('修改时间');

        return $show;
    }

}
