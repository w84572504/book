<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Admin;
use Illuminate\Support\Arr;
use Encore\Admin\Widgets\Box;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('首页')
            ->description('展示当前系统中的统计数据、统计报表及重要实时数据')
            ->row(function (Row $row) {
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('用户总数/个', 'users', 'aqua', '/admin/users', '102'); 
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('支付总额/元', 'shopping-cart', 'green', '/admin/users', '1024');  
                    $column->append($infoBox->render());
                });

                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('作品数量/个', 'book', 'yellow', '/admin/users', '10');  
                    $column->append($infoBox->render());
                });
                $row->column(3, function (Column $column) {
                    $infoBox = new InfoBox('点赞总数/次', 'file', 'red', '/admin/users', '10131232');  
                    $column->append($infoBox->render());
                });
            })
            ->row(function (Row $row)
            { 
                $view = new Box('15天新增用户', view('admin.chartjs',['days'=>['12-01','12-02'],'num'=>[1,100]]));
                $view2 = new Box('15天支付金额', view('admin.chartjs2',['days'=>['12-01','12-02'],'num'=>[1,100]]));
                $row->column(6,$view);   
                $row->column(6,$view2);   
            }) 
            ->row(function (Row $row) { 
                $row->column(12, function (Column $column) {
                    $envs = [
                        ['name' => 'PHP 版本',       'value' => 'PHP/'.PHP_VERSION], 
                        ['name' => '内核信息',             'value' => php_uname()],
                        ['name' => '服务器信息',            'value' => Arr::get($_SERVER, 'SERVER_SOFTWARE')], 
                        ['name' => 'Session 驱动',    'value' => config('session.driver')], 
                        ['name' => '时区',          'value' => config('app.timezone')],
                        ['name' => '语言',            'value' => config('app.locale')],
                        ['name' => '环境',               'value' => config('app.env')],
                        ['name' => '网址',               'value' => config('app.url')],
                    ];

                    $view = view('/admin/environment', compact('envs'));
                    $column->append($view);
                });
            }); 
    } 
    public function test(Request $request)
    {
        $provinceId = $request->get('q');
        $list = DB::table('article_category')->select(['id','name'])->where("pid",$provinceId)->get()->toArray(); 
        $arr =[];
        foreach ($list as $key => $value) {
            $arr[$key]['id'] = $value->id;
            $arr[$key]['text'] = $value->name;
        }  
        return $arr;
    }
}
