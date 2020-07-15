<?php

namespace App\Admin\Controllers;

use App\Models\PaymentSupportImage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PaymentImageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'PaymentSupportImage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new PaymentSupportImage());
        $grid->column('weight','排序值')->help('值越大图片越靠前');
        $grid->column('image', __('图片'))->image();
        $grid->column('description', __('描述'));

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
        $show = new Show(PaymentSupportImage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('image', __('Image'));
        $show->field('description', __('Description'));
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
        $form = new Form(new PaymentSupportImage());

        $form->image('image', __('图片'))->help('请上传60x36像素图片')->required();
        $form->textarea('description', __('描述'));
        $form->switch('enable')->default(1);
        $form->number('weight')->default(1);

        return $form;
    }
}
