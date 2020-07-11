@if(isset($category['children']) && count($category['children']) >= 1)
<li class="menu_item_children"><a href="#">{{$category['title']}}<i
            class="fa fa-angle-right"></i></a>
    <ul class="categories_mega_menu">
        @each('layouts.nav',$category['children'],'category')
    </ul>
</li>

{{--查看更多分类--}}
{{--<li id="cat_toggle" class="has-sub"><a href="#"> More Items</a>--}}
{{--    <ul class="categorie_sub">--}}
{{--        <li><a href="#">Hide Categories</a></li>--}}
{{--    </ul>--}}

{{--</li>--}}
@else
    <li><a href="#">{{$category['title']}}</a></li>
@endif
