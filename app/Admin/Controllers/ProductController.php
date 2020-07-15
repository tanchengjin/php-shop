<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product());

        $grid->column('id', __('Id'));
        $grid->column('category_id', __('Category id'));
        $grid->column('title', __('Title'));
        $grid->column('price', __('Price'));
        $grid->column('intro', __('Intro'));
        $grid->column('sold_count', __('Sold count'));
        $grid->column('review_count', __('Review count'));
        $grid->column('ratting', __('Ratting'));
        $grid->column('on_sale', __('On sale'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'));
        $show->field('title', __('Title'));
        $show->field('price', __('Price'));
        $show->field('intro', __('Intro'));
        $show->field('description', __('Description'));
        $show->field('sold_count', __('Sold count'));
        $show->field('review_count', __('Review count'));
        $show->field('ratting', __('Ratting'));
        $show->field('on_sale', __('On sale'));
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
        $form = new Form(new Product());
        $form->text('title', __('Title'));

        $form->select('category_id', __('Category id'))->default(null);
        $form->multipleFile('images')->pathColumn('url')->removable();
        $form->textarea('intro', __('Intro'));
        $form->UEditor('description', __('Description'));
        $form->switch('on_sale', __('On sale'))->default(1);
        $form->hasMany('skus', 'sku', function (Form\NestedForm $form) {
            $form->text('title', 'title')->rules('required');
            $form->textarea('description', '描述');
            $form->decimal('original_price', '原价')->rules('required|not_in:0.00')->default(0.00);
            $form->decimal('price', '现价')->rules('required|not_in:0.00')->default(0.00);
            $form->number('stock', '库存')->rules('required|not_in:0|integer')->default(0);
        });

        $form->hasMany('properties', '商品属性', function (Form\NestedForm $form) {
            $form->text('key')->required();
            $form->text('value')->required();
        });
        $form->saving(function ($form) {
            $form->price = collect($form->skus)->where(Form::REMOVE_FLAG_NAME, 0)->max('price');
        });
        return $form;
    }
}
