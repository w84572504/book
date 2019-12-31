<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use Encore\Admin\Form;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Tree;
use Illuminate\Support\Facades\DB;

class ArticleCategoryController extends Controller
{
    use ModelForm;

    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('作品分类');
            $content->body(ArticleCategory::tree(function ($tree) {
                $tree->branch(function ($branch) {
                    $state = $branch['state'] == 0 ? "关闭" :"启用";
                    return " {$branch['name']} ( 是否开启：$state)";
                });
            }));
        });
    }
    protected function form()
    {
        $form = new Form(new ArticleCategory);
        $list = DB::table('article_category')->select(['id','name'])->where("pid",0)->get()->toArray(); 
        $arr =[];
        foreach ($list as $key => $value) {
            $arr[$value->id] = $value->name;
        } 
        $form->select('pid','父级名称')->options($arr)->required();
        $form->text('name','名称')->required();
        $form->number('sort', '排序')->required();
        $form->switch('state', '显示开启')->required();
        $form->display('created_at', '创建时间');
        $form->display('updated_at', '修改时间');
        return $form;
    }
    public function create(Content $content)
    {
        return $content
            ->header('作品分类')
            ->description('创建一个作品分类')
            ->body($this->form());
    }
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }
}
