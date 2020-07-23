<?php

namespace App\Admin\Controllers\products;

use App\Models\Product;
use Encore\Admin\Form;
use Encore\Admin\Grid;

/**
 * normal product
 * Class ProductController
 * @package App\Admin\Controllers\products
 */
class ProductController extends AbstractCommonProductController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Product';


    function getProductType()
    {
        return Product::TYPE_NORMAL;
    }

    function customGrid(Grid $grid)
    {
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
    }

    function customForm(Form $form)
    {

    }
}
