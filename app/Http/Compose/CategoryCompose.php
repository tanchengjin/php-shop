<?php


namespace App\Http\Compose;


use App\Models\Category;
use Illuminate\View\View;

class CategoryCompose
{
    protected $categoryTree;

    public function __construct(Category $category)
    {
        $this->categoryTree = $category;
    }

    public function compose(View $view)
    {
        return $view->with('categoryTree', $this->categoryTree->getCategoryTree());
    }
}
