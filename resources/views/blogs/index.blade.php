@extends('main')
@section('breadcrumbs')
@endsection
@section('page.title',__('website.blog'))
@section('content')
    <!--blog area start-->
    <div class="blog_page_section blog_reverse mt-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <div class="widget_title">
                                <h3>{{__('blog.search')}}</h3>
                            </div>
                            <form action="{{route('blog.index')}}" method="get">
                                <input placeholder="Search..." type="text" name="q">
                                <button type="submit">{{__('blog.search')}}</button>
                            </form>
                        </div>
                        <div class="widget_list comments">
                            <div class="widget_title">
                                <h3>{{__('blog.recent_comment')}}</h3>
                            </div>
                            @foreach($recentComment as $comment)
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="{{route('blog.show',['id'=>hashids_id($comment->article_id)])}}"><img src="{{$comment->user->full_avatar}}" alt=""></a>
                                </div>
                                <div class="post_info">
                                    <span> <a href="#">{{$comment->user->name}}</a> says:</span>
                                    <a href="{{route('blog.show',['id'=>hashids_id($comment->article_id)])}}">{{$comment->content}}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="widget_list widget_post">
                            <div class="widget_title">
                                <h3>{{__('blog.recent_post')}}</h3>
                            </div>
                            @if(isset($recent))
                            @foreach($recent as $item)
                                <div class="post_wrapper">
                                    <div class="post_thumb">
                                        <a href="{{route('blog.show',hashids_id($item->id))}}"><img
                                                src="/assets/img/blog/blogs1.jpg" alt=""></a>
                                    </div>
                                    <div class="post_info">
                                        <h4><a href="{{route('blog.show',hashids_id($item->id))}}">{{$item->title}}</a>
                                        </h4>
                                        <span>{{$item->created_at->toFormattedDateString()}}</span>
                                    </div>
                                </div>
                            @endforeach
                                @endif
                        </div>
                        <div class="widget_list widget_categories">
                            <div class="widget_title">
                                <h3>{{__('blog.category')}}</h3>
                            </div>
                            @if(isset($categories))
                                <ul>
                                    @foreach($categories as $category)
                                        <li><a href="{{route('blog.index',['category_id'=>$category->id])}}">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="widget_list widget_tag">
                            <div class="widget_title">
                                <h3>{{__('blog.tag_products')}}</h3>
                            </div>
                            @if(isset($tags))
                                <div class="tag_widget">
                                    <ul>
                                        @foreach($tags as $tag)
                                            <li><a href="{{route('blog.index',['tags'=>$tag])}}">{{$tag}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="blog_wrapper blog_wrapper_sidebar">
                        <div class="row">
                            @foreach($blogs as $blog)
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <article class="single_blog">
                                        <figure>
                                            <div class="blog_thumb">
                                                <a href="{{route('blog.show',hashids_id($blog->id))}}"><img
                                                        src="assets/img/blog/blog1.jpg" alt=""></a>
                                            </div>
                                            <figcaption class="blog_content">
                                                <h4 class="post_title"><a
                                                        href="{{route('blog.show',hashids_id($blog->id))}}">{{$blog->title}}</a>
                                                </h4>
                                                <div class="articles_date">
                                                    <p>18/01/2019 | <a href="#">{{$blog->author}}</a></p>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--blog pagination area start-->
                    <div class="blog_pagination">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    {{$blogs->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--blog pagination area end-->
                </div>
            </div>
        </div>
    </div>
    <!--blog area end-->


@endsection
