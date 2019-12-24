<?php
use Encore\Admin\Facades\Admin;
/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Encore\Admin\Form::forget(['map', 'editor']);

<<<<<<< HEAD

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) { 
    $navbar->right('');

});
=======
Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) { 
//     $navbar->right('<li>
//     <a class="clear-cache" href="/admin/clear-cache">
//       <i class="fa fa-trash"></i>
//       <span>清理缓存</span>
//     </a>
// </li><li>
//     <a href="javascript:void(0);" class="nav-fullscreen">
//       <i class="fa fa-arrows-alt"></i>
//     </a>
// </li>');

});
>>>>>>> 12049f1ad9f423618c768d3ac5c89324b0e46314
