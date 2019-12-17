<?php

namespace App\Admin\Controllers;

use App\Admin\Forms;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\Tab;

class SettingController extends Controller
{
    public function index(Content $content)
    {
        $forms = [
            'basic'    => Forms\Basic::class, 
            'zuozuan'    => Forms\ZuoZuan::class, 
            'wehchat'    => Forms\WeChat::class, 
        ];

        return $content
            ->title('系统设置')
            ->body(Tab::forms($forms));
    }
}