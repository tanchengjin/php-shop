<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    public function index(Content $content)
    {
        return $content->title($this->title())->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());
        $grid->model()->orderBy('id', 'desc');
        $grid->disableCreateButton();
        $grid->actions(function ($tools) {
            $tools->disableDelete();
            $tools->disableEdit();
        });
        $grid->column('id', __('Id'));
        $grid->column('name', __('用户名'));
        $grid->column('email', __('邮箱'));
        $grid->column('created_at', __('注册时间'))->display(function ($created_at){
            return date('Y-m-d H:i:s',strtotime($created_at));
        });

        return $grid;
    }
}
