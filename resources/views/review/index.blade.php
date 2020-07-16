@extends('main')
@section('css')
    <style>
        #box {
            top: 100px;
            right: 50%;
            transform: rotateY(180deg);
            position: relative;
        }

        #box > div {
            font-size: 32px;
            line-height: 32px;
            float: left;
            color: wheat;
        }

        #box > input {
            position: absolute;
            top: 0;
            left: 10px;
            transform: scale(2) translateY(40%);
            opacity: 0;
            cursor: pointer;
        }

        #box > input:nth-of-type(2) {
            left: calc(7px + 32px);
        }

        #box > input:nth-of-type(3) {
            left: calc(7px + 64px);
        }

        #box > input:nth-of-type(4) {
            left: calc(7px + 96px);
        }

        #box > input:nth-of-type(5) {
            left: calc(7px + 128px);
        }

        #box > input[name='rate']:hover ~ div,
        #box > input[name='rate']:checked ~ div {
            color: red;
        }
    </style>
@endsection
@section('header_box')
@endsection
@section('breadcrumbs')
@endsection
@section('content')
    <div class="container" style="margin-top: 30px">
        <div class="card">
            <div class="card-header">
                <span class="float-right"><a
                        href="{{route('center.order.show',$item->order->id)}}">{{__('admin.back')}}</a></span>
            </div>
            <div class="card-body">
                <div class="product_d_inner">
                    <div class="tab-pane fade active show" id="reviews" role="tabpanel">
                        <div class="reviews_wrapper">
                            @if(is_null($item->review))
                                <form action="{{route('order.review.store',$item->hash_id)}}" method="post">

                                    <div class="product_ratting mb-10">
                                        <h3>{{__('review.rating')}}</h3>
                                        <ul class="star-box">
                                            <input type="radio" name="rating" value="5" id="1-star-{{$item->id}}"><label
                                                for="1-star-{{$item->id}}"></label>
                                            <input type="radio" name="rating" value="4" id="2-star-{{$item->id}}"><label
                                                for="2-star-{{$item->id}}"></label>
                                            <input type="radio" name="rating" value="3" id="3-star-{{$item->id}}"><label
                                                for="3-star-{{$item->id}}"></label>
                                            <input type="radio" name="rating" value="2" id="4-star-{{$item->id}}"><label
                                                for="4-star-{{$item->id}}"></label>
                                            <input type="radio" name="rating" value="1" id="5-star-{{$item->id}}"><label
                                                for="5-star-{{$item->id}}"></label>
                                        </ul>
                                    </div>
                                    <div class="product_review_form" style="clear: both">
                                        <div class="row">
                                            {{csrf_field()}}
                                            <div class="col-12">
                                                <label for="review_comment">{{__('review.review_content')}} </label>
                                                <textarea name="review" id="review_comment" minlength="1"
                                                          maxlength="255" class="has-error"></textarea>
                                                <span
                                                    class="has-error">{{$errors->has('review')?$errors->get('review'):''}}</span>
                                            </div>
                                        </div>
                                        <button type="submit">{{__('review.submit')}}</button>
                                    </div>
                                </form>

                            @else
                                <div class="product_ratting mb-10">
                                    <h3>{{__('review.rating')}}</h3>
                                    <ul>
                                        <span class="star-t">{{str_repeat('♥',$item->rating)}}</span><span
                                            class="star-f">{{str_repeat('♥',5-$item->rating)}}</span>
                                    </ul>
                                </div>
                                <div class="product_review_form">
                                    <div class="row">
                                        <div class="col-12">
                                            <label for="review_comment">{{__('review.review_content')}} </label>
                                            <textarea name="review" id="review_comment" minlength="1"
                                                      maxlength="255" disabled>{{$item->review}}</textarea>
                                            <input type="hidden" name="rating">
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $('input[name=rat]').click(function () {
            $('input[name=rating][type=hidden]').val($(this).val());
        })
    </script>
@endsection
