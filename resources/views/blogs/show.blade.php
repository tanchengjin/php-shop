@extends('main')
@section('page.title','Blog |'.$article->title)
@section('breadcrumbs')
@endsection
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
                            <h3>{{$article->articleCommentLength()}} {{__('comment.comments')}} </h3>
                            @foreach($article->articleComments() as $comment)
                                <div class="comment_list">
                                    <div class="comment_thumb">
                                        <img src="{{$comment['avatar']}}" alt="">
                                    </div>
                                    <div class="comment_content">
                                        <div class="comment_meta">
                                            <h5><a href="#">{{$comment['username']}}</a></h5>
                                            <span>{{$comment['created_at']}}</span>
                                        </div>
                                        <p>{{$comment['content']}}</p>
                                        <div class="comment_reply">
                                            @if(isset($comment['isReply']) && $comment['isReply'])
                                                <a href="javascript:void(0)" class="answer"
                                                   data-username="{{$comment['username']}}"
                                                   data-id="{{$comment['id']}}">{{__('comment.reply')}}</a>
                                            @else
                                                @if(!\Illuminate\Support\Facades\Auth::check())
                                                    <a href="{{route('login')}}">{{__('comment.reply')}}</a>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(isset($comment['children']))
                                    @each('common.comment',$comment['children'],'comment')
                                @endif
                            @endforeach
                        </div>
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <div class="comments_form">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="review_comment">{{__('comment.comment')}} </label>
                                            <input type="hidden" name="id">
                                            <input type="hidden" name="article" value="{{hashids_id($article->id)}}">
                                            <textarea name="comment" id="review_comment" required minlength="2"
                                                      maxlength="255" disabled placeholder="请先登录"></textarea>
                                        </div>
                                    </div>
                                    <button class="button" type="button"><a
                                            href="{{route('login')}}">{{__('sweetalert.please_login')}}</a></button>
                                </form>
                            </div>
                        @else
                            <div class="comments_form">
                                <form action="{{route('blog.comment')}}" method="post" id="send_comment">

                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="review_comment">{{__('comment.comment')}} </label>
                                            <input type="hidden" name="id">
                                            <input type="hidden" name="article" value="{{hashids_id($article->id)}}">
                                            <textarea name="comment" id="review_comment" required minlength="2"
                                                      maxlength="255"></textarea>
                                        </div>
                                    </div>
                                    <button class="button" type="submit">{{__('comment.post_comment')}}</button>
                                </form>
                            </div>
                        @endif
                    </div>
                    <!--blog grid area start-->
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="blog_sidebar_widget">
                        <div class="widget_list widget_search">
                            <div class="widget_title">
                                <h3>{{__('blog.search')}}</h3>
                            </div>
                            <form action="{{route('blog.index')}}">
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
                                        <a href="{{route('blog.show',['id'=>hashids_id($comment->article_id)])}}"><img
                                                src="{{$comment->user->full_avatar}}" alt=""></a>
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


@section('javascript')
    <script>
        $(document).ready(function () {
            $('body').on('click', '.answer', function () {
                $('#review_comment').val('{{__('comment.reply')}}' + '@' + $(this).data('username') + ':');
                $('input[type=hidden][name=id]').val($(this).data('id'));

            })

            $('#send_comment').on('submit', function (e) {
                e.preventDefault();
                    @if(\Illuminate\Support\Facades\Auth::check())
                let username = '{{\Illuminate\Support\Facades\Auth::user()->name}}';
                @else
                swal.fire('{{__('sweetalert.please_login')}}', '', 'error')
                    @endif

                let content = $('#review_comment').val();
                let byReply = $('#byReply').val();
                let currentTime = '{{toDateString(date('Y-m-d H:i:s'))}}';
                let answer = $('.answer').data('username');

                let data = $(this).serialize();
                axios.post('{{route('blog.comment')}}', data).then(function (res) {
                    if (res.data.errno === 0) {
                        let c_id = $('input[type=hidden][name=id]').val();
                        if (c_id) {
                            let $html = '<div class="comment_list list_two">\n' +
                                '            <div class="comment_thumb">\n' +
                                '                <img src="/assets/img/blog/comment3.png.jpg" alt="">\n' +
                                '            </div>\n' +
                                '            <div class="comment_content">\n' +
                                '                <div class="comment_meta">\n' +
                                '                    <h5><a href="#">' + username + '</a>@<a href="#">' + answer + '</a></h5>\n' +
                                '                    <span>' + currentTime + '</span>\n' +
                                '                </div>\n' +
                                '                <p>' + content + '</p>\n' +
                                '            </div>\n' +
                                '        </div>';

                            let id = $('input[type=hidden][name=id]').val();
                            let $box = $('a[data-id=' + id + ']').closest('.comment_list');
                            console.log($box);
                            $box.after($html);

                        } else {

                            let $html = '<div class="comment_list">\n' +
                                '                                    <div class="comment_thumb">\n' +
                                '                                        <img src="/assets/img/blog/comment3.png.jpg" alt="">\n' +
                                '                                    </div>\n' +
                                '                                    <div class="comment_content">\n' +
                                '                                        <div class="comment_meta">\n' +
                                '                                            <h5><a href="#">' + username + '</a></h5>\n' +
                                '                                            <span>' + currentTime + '</span>\n' +
                                '                                        </div>\n' +
                                '                                        <p>' + content + '</p>\n' +
                                '                                    </div>\n' +
                                '                                </div>';
                            $('.comments_box').append($html);

                        }
                        $('#review_comment').val('');
                        return swal.fire('{{__('sweetalert.operation_success')}}', '', 'success');

                    } else {
                        swal.fire('{{__('sweetalert.operation_error')}}', '', 'error');
                        return;
                    }
                }, function (error) {
                    if (error.response.status === 401) {
                        swal.fire('{{__('sweetalert.please_login')}}', '', 'error');
                    } else {
                        swal.fire('{{__('sweetalert.operation_error')}}', '', 'error');
                    }
                })
            })
        })
    </script>
@endsection
