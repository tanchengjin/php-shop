@extends('main')
@section('content')
    <!--blog body area start-->
    <div class="blog_details">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <!--blog grid area start-->
                    <div class="blog_wrapper blog_wrapper_details">
                        <article class="single_blog">
                            <figure>
                                <div class="post_header">
                                    <h3 class="post_title">{{$article->title}}</h3>
                                    <div class="blog_meta">
                                        <p>Posted by : <a href="#">{{$article->author}}</a> / On : <a
                                                href="#">{{$article->created_at->toFormattedDateString()}}</a>
                                            {{--                                            / tag : <a href="#">Company, Image, Travel</a>--}}
                                        </p>
                                    </div>
                                </div>
                                <div class="blog_thumb">
                                    <a href="#"><img src="assets/img/blog/blog-big1.jpg" alt=""></a>
                                </div>
                                <figcaption class="blog_content">
                                    <div class="post_content">
                                        {!! $article->content !!}
                                    </div>
                                    <div class="entry_content">
                                        <div class="post_meta">
                                            <span>Tags: </span>
                                            <span>
                                            @foreach(explode(',',$article->tags) as $index=>$tag)
                                                    @if($index === 0)
                                                        <a href="#">{{$tag}}</a>
                                                    @else
                                                        <a href="#">,{{$tag}}</a>
                                                    @endif
                                            </span>
                                            @endforeach
                                        </div>

                                        <div class="social_sharing">
                                            <p>share this post:</p>
                                            <ul>
                                                <li><a href="#" title="facebook"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#" title="twitter"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#" title="pinterest"><i class="fa fa-pinterest"></i></a>
                                                </li>
                                                <li><a href="#" title="google+"><i class="fa fa-google-plus"></i></a>
                                                </li>
                                                <li><a href="#" title="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                        <div class="related_posts">
                            <h3>Related posts</h3>
                            <div class="row">
                                @foreach($related as $relate)
                                    <div class="col-lg-4 col-md-4 col-sm-6">
                                        <article class="single_related">
                                            <figure>
                                                <div class="related_thumb">
                                                    <a href="{{route('blog.show',hashids_id($relate->id))}}"><img
                                                            src="/assets/img/blog/blog1.jpg" alt=""></a>
                                                </div>
                                                <figcaption class="related_content">
                                                    <h4><a href="#">{{$relate->title}}</a></h4>
                                                    <div class="blog_meta">
                                                        <span class="author">By : <a href="#">{{$relate->author}}</a> / </span>
                                                        <span
                                                            class="meta_date">{{$relate->created_at->toFormattedDateString()}}</span>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                        </article>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="comments_box">
                            <h3>3 Comments </h3>
                            <div class="comment_list">
                                <div class="comment_thumb">
                                    <img src="assets/img/blog/comment3.png.jpg" alt="">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a href="#">Admin</a></h5>
                                        <span>October 16, 2018 at 1:38 am</span>
                                    </div>
                                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure</p>
                                    <div class="comment_reply">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>

                            </div>
                            <div class="comment_list list_two">
                                <div class="comment_thumb">
                                    <img src="assets/img/blog/comment3.png.jpg" alt="">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a href="#">Demo</a></h5>
                                        <span>October 16, 2018 at 1:38 am</span>
                                    </div>
                                    <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                                    <div class="comment_reply">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="comment_list">
                                <div class="comment_thumb">
                                    <img src="assets/img/blog/comment3.png.jpg" alt="">
                                </div>
                                <div class="comment_content">
                                    <div class="comment_meta">
                                        <h5><a href="#">Admin</a></h5>
                                        <span>October 16, 2018 at 1:38 am</span>
                                    </div>
                                    <p>Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean
                                        at</p>
                                    <div class="comment_reply">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments_form">
                            <h3>Leave a Reply </h3>
                            <p>Your email address will not be published. Required fields are marked *</p>
                            <form action="#">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">Comment </label>
                                        <textarea name="comment" id="review_comment"></textarea>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="author">Name</label>
                                        <input id="author" type="text">

                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="email">Email </label>
                                        <input id="email" type="text">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <label for="website">Website </label>
                                        <input id="website" type="text">
                                    </div>
                                </div>
                                <button class="button" type="submit">Post Comment</button>
                            </form>
                        </div>
                    </div>
                    <!--blog grid area start-->
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <div class="widget_title">
                                <h3>{{__('blog.search')}}</h3>
                            </div>
                            <form action="#">
                                <input placeholder="Search..." type="text">
                                <button type="submit">{{__('blog.search')}}</button>
                            </form>
                        </div>
                        <div class="widget_list comments">
                            <div class="widget_title">
                                <h3>{{__('blog.recent_comment')}}</h3>
                            </div>
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                                </div>
                                <div class="post_info">
                                    <span> <a href="#">demo</a> says:</span>
                                    <a href="blog-details.html">Quisque semper nunc</a>
                                </div>
                            </div>
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                                </div>
                                <div class="post_info">
                                    <span><a href="#">admin</a> says:</span>
                                    <a href="blog-details.html">Quisque orci porta...</a>
                                </div>
                            </div>
                            <div class="post_wrapper">
                                <div class="post_thumb">
                                    <a href="blog-details.html"><img src="assets/img/blog/comment2.png.jpg" alt=""></a>
                                </div>
                                <div class="post_info">
                                    <span><a href="#">demo</a> says:</span>
                                    <a href="blog-details.html">Quisque semper nunc</a>
                                </div>
                            </div>
                        </div>
                        <div class="widget_list widget_post">
                            <div class="widget_title">
                                <h3>{{__('blog.recent_post')}}</h3>
                            </div>
                            @foreach($recent as $item)
                                <div class="post_wrapper">
                                    <div class="post_thumb">
                                        <a href="{{route('blog.show',hashids_id($item->id))}}"><img
                                                src="/assets/img/blog/comment2.png.jpg" alt="{{$item->title}}"></a>
                                    </div>
                                    <div class="post_info">
                                        <h4><a href="{{route('blog.show',hashids_id($item->id))}}">{{$item->title}}</a>
                                        </h4>
                                        <span>{{$item->created_at->toFormattedDateString()}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="widget_list widget_categories">
                            <div class="widget_title">
                                <h3>{{__('blog.category')}}</h3>
                            </div>
                            <ul>
                                @foreach($categories as $category)
                                    <li><a href="#">{{$category}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget_list widget_tag">
                            <div class="widget_title">
                                <h3>{{__('blog.tag_products')}}</h3>
                            </div>
                            <div class="tag_widget">
                                <ul>
                                    @foreach(explode(',',$article->tags) as $tag)
                                        <li><a href="{{route('blog.index',['tags'=>$tag])}}">{{$tag}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--blog section area end-->
@endsection
