<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('parent_id', __('Parent id'));
        $grid->column('is_directory', __('Is directory'));
        $grid->column('path', __('Path'));
        $grid->column('level', __('Level'));

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
        $show = new Show(Category::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('parent_id', __('Parent id'));
        $show->field('is_directory', __('Is directory'));
        $show->field('path', __('Path'));
        $show->field('level', __('Level'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());
        $form->select('parent_id', __('Parent id'))->ajax('/admin/api/categories');
        $form->text('title', __('Title'));
        $form->radio('is_directory', __('Is directory'))->options([
            1 => '是',
            0 => '否',
        ]);
        return $form;
    }

    public function CategoryApi(Request $request)
    {
        $search = $request->input('q');

        $result = Category::query()
            ->where('title', 'like', '%' . $search . '%')->paginate();

        $result->setCollection($result->getCollection()->map(function (Category $category) {
            return ['id' => $category['id'], 'text' => $category['title']];
        }));

        return $result;

    }
}
