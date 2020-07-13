@if(isset($comment))
    @if(isset($comment['children']))
        <div class="comment_list list_two">
            <div class="comment_thumb">
                <img src="/assets/img/blog/comment3.png.jpg" alt="">
            </div>
            <div class="comment_content">
                <div class="comment_meta">
                    <h5><a href="#">{{$comment['username']}}</a>@<a href="#">{{$comment['reply']}}</a></h5>
                    <span>{{$comment['created_at']}}</span>
                </div>
                <p>{{$comment['content']}}</p>
                <div class="comment_reply">
                    <a href="javascript:void(0)" class="answer" data-username="{{$comment['username']}}" data-id="{{$comment['id']}}">{{__('comment.reply')}}</a>
                </div>
            </div>
        </div>
        @each('common.comment',$comment['children'],'comment')
    @else
        <div class="comment_list list_two">
            <div class="comment_thumb">
                <img src="/assets/img/blog/comment3.png.jpg" alt="">
            </div>
            <div class="comment_content">
                <div class="comment_meta">
                    <h5><a href="#">{{$comment['username']}}</a>@<a href="#">{{$comment['reply']}}</a></h5>
                    <span>{{$comment['created_at']}}</span>
                </div>
                <p>{{$comment['content']}}</p>
                <div class="comment_reply">
                    <a href="javascript:void(0)" class="answer" data-username="{{$comment['username']}}" data-id="{{$comment['id']}}">{{__('comment.reply')}}</a>
                </div>
            </div>
        </div>
    @endif
@endif
