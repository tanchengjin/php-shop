@if(isset($comment))
    @if(isset($comment['children']))
        <div class="comment_list list_two">
            <div class="comment_thumb">
                <img src="{{$comment['avatar']}}" alt="avatar">
            </div>
            <div class="comment_content">
                <div class="comment_meta">
                    <h5><a href="#">{{$comment['username']}}</a>@<a href="#">{{$comment['reply']}}</a></h5>
                    <span>{{$comment['created_at']}}</span>
                </div>
                <p>{{$comment['content']}}</p>
                <div class="comment_reply">
                    @if($comment['isReply'])
                        <a href="javascript:void(0)" class="answer" data-username="{{$comment['username']}}"
                           data-id="{{$comment['id']}}">{{__('comment.reply')}}</a>
                    @else
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <a href="{{route('login')}}">{{__('comment.reply')}}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        @each('common.comment',$comment['children'],'comment')
    @else
        <div class="comment_list list_two">
            <div class="comment_thumb">
                <img src="{{$comment['avatar']}}" alt="avatar">
            </div>
            <div class="comment_content">
                <div class="comment_meta">
                    <h5><a href="#">{{$comment['username']}}</a>@<a href="#">{{$comment['reply']}}</a></h5>
                    <span>{{$comment['created_at']}}</span>
                </div>
                <p>{{$comment['content']}}</p>
                <div class="comment_reply">
                    @if($comment['isReply'])
                        <a href="javascript:void(0)" class="answer" data-username="{{$comment['username']}}"
                           data-id="{{$comment['id']}}">{{__('comment.reply')}}</a>
                    @else
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <a href="{{route('login')}}">{{__('comment.reply')}}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endif
@endif
