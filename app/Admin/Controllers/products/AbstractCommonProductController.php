<?php


namespace App\Admin\Controllers\products;


use App\Models\Product;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;

abstract class AbstractCommonProductController extends AdminController
{
    public function index(Content $content)
    {
        return $content->title(Product::$typeMap[$this->getProductType()] . '列表')->body($this->grid());
    }

    public function edit($id, Content $content)
    {
        return $content->title('编辑' . Product::$typeMap[$this->getProductType()] . '列表')->body($this->form()->edit($id));
    }

    public function create(Content $content)
    {
        return $content->title('创建' . Product::$typeMap[$this->getProductType()])->body($this->form());
    }


    protected function grid()
    {
        $grid = new Grid(new Product());
        $grid->model()->where('type', $this->getProductType())->orderBy('id', 'desc');
        $this->customGrid($grid);
        return $grid;
    }

    protected function form()
    {
        $form = new Form(new Product());
        $form->text('title', __('Title'))->required();
        $form->hidden('type')->value($this->getProductType());
        $form->multipleSelect('tags', '标签')->options(Product::$tabsMap);
        $form->select('category_id', __('Category id'))->default(null);
        $form->multipleFile('images')->pathColumn('url')->removable()->required();
        $form->textarea('intro', __('Intro'));
        $form->UEditor('description', __('Description'))->rules('required');
        $form->switch('on_sale', __('On sale'))->default(1);

        $this->customForm($form);

        $form->hasMany('skus', '商品规格', function (Form\NestedForm $form) {
            $form->text('title', 'title')->rules('required');
            $form->textarea('description', '描述');
            $form->decimal('original_price', '原价')->rules('not_in:0.00');
            $form->decimal('price', '现价')->rules('required|not_in:0.00')->default(0.00);
            $form->number('stock', '库存')->rules('required|not_in:0|integer')->default(0);
        });

        $form->hasMany('properties', '商品属性', function (Form\NestedForm $form) {
            $form->text('key')->required();
            $form->text('value')->required();
        });
        $form->saving(function ($form) {
            $form->model()->price = collect($form->skus)->where(Form::REMOVE_FLAG_NAME, 0)->min('price')??0;
            $form->model()->max_price = collect($form->skus)->where(Form::REMOVE_FLAG_NAME, 0)->max('price')??0;
        });
        return $form;
    }

    abstract function getProductType();

    abstract function customGrid(Grid $grid);

    abstract function customForm(Form $form);

}
