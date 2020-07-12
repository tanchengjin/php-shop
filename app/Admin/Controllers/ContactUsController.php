<?php

namespace App\Admin\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\ContactUs;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

class ContactUsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'ContactUs';

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
        $grid = new Grid(new ContactUs());
        $grid->model()->orderBy('id','desc');
        $grid->disableCreateButton();
        $grid->batchActions(function ($batch){
            $batch->disableDelete();
        });
        $grid->actions(function ($tools) {
            $tools->disableEdit();
            $tools->disableView();
        });
        $grid->disableFilter();
        $grid->column('subject', __('标题'));
        $grid->column('name', __('姓名'));
        $grid->column('email', __('邮箱'));
        $grid->column('message', __('消息'));

        return $grid;
    }
}
