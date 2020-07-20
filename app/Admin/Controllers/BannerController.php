<?php

namespace App\Admin\Controllers;

use App\Models\Banner;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BannerController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Banner';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Banner());

        $grid->column('id', __('Id'));
        $grid->column('image', __('图片'));
        $grid->column('title', __('标题'));
        $grid->column('subtitle', __('子标题'));
        $grid->column('content', __('内容描述'));
        $grid->column('order', __('排序'));
        $grid->column('enable', __('是否开启'));

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
        $show = new Show(Banner::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('标题'));
        $show->field('subtitle', __('子标题'));
        $show->field('content', __('内容描述'));
        $show->field('order', __('排序'));
        $show->field('enable', __('Enable'));
        $show->field('image', __('图片'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Banner());

        $form->text('title', '标题');
        $form->text('subtitle', '子标题');
        $form->textarea('content', '图片描述');
        $form->number('order', '排序')->default(0);
        $form->switch('enable', '是否启用')->default(1);
        $form->image('image', '图片')->rules('required')->help('请上传1920x550像素图片');
        $form->text('url', '图片跳转链接');
        $form->select('url_type', '图片跳转类型')->help("选择互联网跳转需要填写完整地址(http:// 或https://) </br> 选择本站商品跳转需要填写商品的id")->options(
            Banner::$urlMap
        );
        return $form;
    }
}
