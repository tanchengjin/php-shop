@extends('main')
@section('page.title',$product->title)
@section('breadcrumb_title',$product->title)
@section('content')
    <!--product details start-->
    <div class="product_details mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            @if(count($product->images) > 0)
                                <a href="#">
                                    <img id="zoom1"
                                         src="{{$product->first_image}}"
                                         data-zoom-image="{{$product->first_image}}"
                                         alt="big-1" style="width: 100%;height: 100%;">
                                </a>
                            @else
                                <a href="#">
                                    <img id="zoom1"
                                         src="{{asset('assets/images/error.png')}}"
                                         data-zoom-image="{{asset('assets/images/error.png')}}"
                                         alt="big-1" style="width: 100%;height: 100%;">
                                </a>
                            @endif
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">
                                @if(count($product->images) > 1)
                                    @foreach($product->images as $image)
                                        <li>
                                            <a href="#" class="elevatezoom-gallery active" data-update=""
                                               data-image="{{($image->full_url)}}"
                                               data-zoom-image="{{$image->full_url}}">
                                                <img src="{{$image->full_url}}"
                                                     alt="zo-th-1"/>
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="#">

                            <h1><a href="#" class="product_title">{{$product->title}}</a></h1>
                            <div class=" product_ratting">
                                <ul>
                                    @for($i=0;$i<$product->rating;$i++)
                                        <li><a href="#"><i class="icon-star icon-star2"></i></a></li>
                                    @endfor
                                    @for($i=0;$i<(5-$product->rating);$i++)
                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                    @endfor
                                    <li class="review"><a href="#"> ({{__('website.ratting')}}) </a></li>
                                </ul>

                            </div>
                            @if(count($product->skus) === 1)
                                <p id="product_sku"
                                   data-id="{{$product->skus[0]['id']}}">{{$product->skus[0]['title']}}</p>
                                库存: {{$product->skus[0]['stock']}}
                            @endif
                            <div class="price_box">
                                <span class="current_price">￥{{number_format($product->price,2)}}</span>
                                <span class="old_price" style="display: none"></span>

                            </div>
                            <div class="product_desc">
                                <p>{{$product->intro}}</p>
                            </div>
                            @if(count($product->skus) >= 2)
                                <div class="product_variant color">
                                    <h3>{{__('website.options')}}</h3>
                                    <label>sku</label>
                                    <ul>
                                        @foreach($product->skus as $sku)
                                            <li class=""><input type="radio" name="skus" value="{{$sku->id}}"
                                                                data-title="{{$sku->title}}"
                                                                data-stock="{{$sku->stock}}"
                                                                data-price="{{number_format($sku->price,2)}}"
                                                                data-old_price="{{number_format($sku->original_price,2)}}">{{$sku->title}}
                                            </li>
                                        @endforeach
                                    </ul>

                                    <label for="">{{__('website.stock')}}</label>
                                    <span id="stock">请选择商品规格</span>
                                </div>
                            @endif

                            {{--                            cart and quantity--}}
                            @if(count($product->skus) !== 0)
                                {{--                                判断商品类型--}}
                                @if($product->type === \App\Models\Product::TYPE_NORMAL)
                                    <div class="product_variant quantity">
                                        <label>{{__('website.quantity')}}</label>
                                        <input min="1" max="100" value="1" type="number" name="quantity">
                                        <button class="button btn_add_to_cart"
                                                type="button">{{__('website.add_to_cart')}}</button>
                                    </div>
                                @elseif($product->type === \App\Models\Product::TYPE_SECKILL)
                                    <div class="product_variant quantity">
                                        <label>{{__('website.quantity')}}</label>
                                        <input min="1" max="100" value="1" type="number" name="quantity">
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            @if(!$product->seckill->isStart)
                                                <button class="button unstart-seckill"
                                                        type="button" disabled>秒杀未开始
                                                </button>
                                            @elseif($product->seckill->isOver)
                                                <button class="button"
                                                        type="button" disabled>秒杀已结束
                                                </button>
                                            @else
                                                <button class="button btn_seckill"
                                                        type="button">{{__('index.seckill_now')}}</button>
                                            @endif
                                        @else
                                            <button class="button"
                                                    type="button" id="login">{{__('website.login')}}</button>
                                        @endif
                                    </div>
                                @endif
                            @endif
                            <div class=" product_d_action">
                                <ul>
                                    @if($product->isWishlist)
                                        <li><a href="#" title="Remove to wishlist" data-id="{{$product->id}}"
                                               class="remove_wishlist">- {{__('website.remove_wishlist')}}</a></li>
                                    @else
                                        <li><a href="#" title="Add to wishlist" data-id="{{$product->id}}"
                                               class="add_to_wishlist">+ {{__('website.add_to_wishlist')}}</a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="product_meta">
                                <span>{{__('website.category')}}: <a href="#">Clothing</a></span>
                            </div>

                        </form>
                        <div class="priduct_social">
                            <ul>
                                <li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i>
                                        Like</a>
                                </li>
                                <li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a>
                                </li>
                                <li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a>
                                </li>
                                <li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i>
                                        share</a>
                                </li>
                                <li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info"
                                       aria-selected="false">{{__('website.description')}}</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet"
                                       aria-selected="false">{{__('website.specification')}}</a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews"
                                       aria-selected="false">{{__('website.reviews')}} ({{count($product->comments)}}
                                        )</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="product_info_content">
                                    {{$product->description}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet" role="tabpanel">
                                <div class="product_d_table">
                                    <form action="#">
                                        <table>
                                            <tbody>
                                            @foreach($product->properties as $property)
                                                <tr>
                                                    <td class="first_child">{{$property->key}}</td>
                                                    <td>{{$property->value}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>{{$product->intro}}</p>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reviews" role="tabpanel">
                                <div class="reviews_wrapper">
                                    @foreach($product->comments as $comment)
                                        <div class="reviews_comment_box">
                                            <div class="comment_thmb">
                                                <img src="{{asset('assets/images/avatar.jpg')}}" alt="">
                                            </div>
                                            <div class="comment_text">
                                                <div class="reviews_meta">
                                                    <div class="star_rating">
                                                        <ul>
                                                            @for($i=0;$i<$product->rating;$i++)
                                                                <li><a href="#"><i class="icon-star icon-star2"
                                                                                   style="color: gold"></i></a></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        <strong>{{$comment->order->user->name}} </strong>- {{$comment->reviewed_at}}
                                                    </p>
                                                    <span>{{$comment->review}}</span>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>{{__('website.relate_product')}} </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product_carousel product_column5 owl-carousel">
                        @foreach($product_relate as $relate)
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        @if(count($relate->images) >= 2)
                                            <a class="primary_img" href="{{route('products.show',$relate->id)}}"><img
                                                    src="{{$relate->first_image}}" alt="{{$relate->title}}"></a>
                                            <a class="secondary_img" href="{{route('products.show',$relate->id)}}"><img
                                                    src="{{$relate->second_image}}" alt="{{$relate->title}}"></a>
                                        @else
                                            <a class="primary_img" href="{{route('products.show',$relate->id)}}"><img
                                                    src="{{$relate->first_image}}" alt="{{$relate->title}}"></a>
                                        @endif
                                        <div class="label_product">
                                            @if($relate->tags)
                                                @foreach($relate->tags as $tag)
                                                    <span class="label_{{$tag}}">{{$tag}}</span>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a
                                                href="{{route('products.show',$relate->id)}}">{{$relate->title}}</a>
                                        </h4>
                                        <div class="price_box">
                                            <span class="current_price">￥{{number_format($product->price,2)}}</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->
    @if(count($product_sale) >= 1)
        <!--product area start-->
        <section class="product_area upsell_products">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_title">
                            <h2>{{__('website.upsell_product')}} </h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="product_carousel product_column5 owl-carousel">
                            @foreach($product_sale as $sale)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            @if(count($sale->images) >= 2)
                                                <a class="primary_img" href="{{route('products.show',$sale->id)}}"><img
                                                        src="{{$sale->first_image}}" alt="picture"></a>
                                            @else
                                                <a class="primary_img" href="{{route('products.show',$sale->id)}}"><img
                                                        src="{{$sale->second_image}}" alt="picture"></a>
                                            @endif
                                            <div class="label_product">
                                                <span class="label_sale">Sale</span>
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a
                                                    href="{{route('products.show',$sale->id)}}">{{$sale->title}}</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">￥{{number_format($product->price,2)}}</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--product area end-->
    @endif
@endsection

@section('javascript')
    <script src="https://cdn.bootcss.com/moment.js/2.22.1/moment.min.js"></script>
    <script>
        $(document).ready(function () {
            @if($product->type === \App\Models\Product::TYPE_SECKILL)
                @if(!$product->seckill->isStart)
                var startTime=moment.unix({{$product->seckill->start_at->getTimeStamp()}});
                var h1=setInterval(function(){
                    var now=moment();
                    if(now.isAfter(startTime)){
                        clearInterval();
                        return;
                    }
                    var hour=startTime.diff(now,'hours');
                    var minute=startTime.diff(now,'minute')%60;
                    var seconds=startTime.diff(now,'seconds')%60;
                    $('.unstart-seckill').text('抢购倒计时:'+hour+':'+minute+':'+seconds)
                },500);
                @endif
            $('.btn_seckill').click(function () {
                var addresses =@json(\Illuminate\Support\Facades\Auth::check()?\Illuminate\Support\Facades\Auth::user()->addresses:[]);
                var addressSelect = $("<select class='form-control'></select>");
                addresses.forEach(function (add) {
                    addressSelect.append("<option value=" + add.id + ">" + add.full_address + add.contact_name + add.contact_phone + "</option>");
                })
                swal.fire({
                    title: '请选择收货地址',
                    html: addressSelect[0],
                    preConfirm: function (pre) {
                        if (!pre) {
                            return;
                        }

                            @if(count($product->skus) === 1)
                        var sku_id = $('#product_sku').data('id');
                            @else
                        var sku_id = $('input[type=radio]:checked').val();
                            @endif

                        var res = {
                                address_id: addressSelect.val(),
                                sku_id: sku_id,
                                quantity: $('input[name=quantity]').val()
                            };

                        axios.post('{{route('orders.seckill.store')}}', res).then(function (res) {
                            if(res.data.errno === 0){
                                location.href = '/orders/' + res.data.data.order_id + '/confirm'
                            }else{
                                swal.fire('error',res.data.message,'error')
                            }
                        }, function (err) {
                            if(err.response.status === 422){
                                let error_h='<div>';
                                _.each(err.response.data.errors,function(errors){
                                    _.each(errors,function(error){
                                        error_h+=error;
                                    });
                                });
                                error_h+="</div>";
                                swal.fire({
                                    title:'error',
                                    html:error_h,
                                    icon:'error'
                                });
                            }
                        });
                    },
                });
            })
            @endif
            $('.btn_add_to_cart').click(function () {
                let sku_id = $('input[type=radio]:checked').val();
                if (!sku_id) {
                    swal.fire('error', '{{__('sweetalert.product_sku')}}', 'error');
                    return;
                }

                let quantity = $('input[name=quantity]').val();
                if (quantity <= 0 || isNaN(quantity)) {
                    swal.fire('error', '{{__('sweetalert.error_quantity')}}', 'error');
                    return;
                }

                let stock = $('input[type=radio]:checked').data('stock');
                if (quantity > stock) {
                    swal.fire('error', '{{__('sweetalert.low_stock')}}', 'error');
                    return;
                }
                axios.post('{{route('carts.store')}}', {
                    sku_id: sku_id,
                    quantity: quantity
                }).then(function (res) {
                    if (res.data.errno === 0) {
                        swal.fire({
                            'title': 'success',
                            text: '{{__('sweetalert.go_shopping_cart_confirm')}}',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: '{{__('sweetalert.go_shopping_cart')}}',
                            preConfirm(inputValue) {
                                if (inputValue) {
                                    location.href = "{{route('carts.index')}}";
                                }
                            }
                        });
                    } else {
                        if (res.data.message) {
                            swal.fire('error', res.data.message, 'error');
                        } else {
                            swal.fire('error', '{{__('sweetalert.operation_error')}}', 'error');
                        }
                    }
                }, function (err) {
                    if (err.response.status === 401) {
                        swal.fire({
                            title: '{{__('sweetalert.please_login')}}',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: '{{__('sweetalert.go_login')}}',
                            preConfirm(inputValue) {
                                if (inputValue) {
                                    return location.href = '{{route('login')}}';
                                }
                            }
                        });
                        return;
                    }
                    swal.fire('error', '{{__('sweetalert.error_internal_server')}}', 'error');
                });
            });

            $('input[type=radio]').click(function () {
                let stock = $(this).data('stock');
                let price = $(this).data('price');
                let old_price = $(this).data('old_price');

                $('#stock').text(stock);
                $('.current_price').text('￥' + price);
                $('.old_price').text('￥' + old_price);
                $('.old_price').css('display', 'inline-block');
            });


            $('body').on('click', '.remove_wishlist', function () {

                $box = $(this);

                let id = $box.data('id');
                axios.delete('/wishlist/' + id).then(function (res) {
                    if (res.data.errno === 0) {
                        swal.fire('success', '{{__('sweetalert.operation_success')}}', 'success');
                        location.reload();
                    } else {
                        swal.fire('error', res.data.message, 'error');
                    }
                }, function (err) {
                    if (err.response.status === 401) {
                        swal.fire({
                            title: 'error',
                            text: '{{__('sweetalert.please_login')}}',
                            icon: 'error',
                            preConfirm(inputValue) {
                                if (inputValue) {
                                    location.href = "{{route('login')}}";
                                }
                            }
                        });
                    } else {
                        swal.fire('error', '{{__('sweetalert.error_internal_server')}}', 'error')
                    }
                });
            });


            $('body').on('click', '.add_to_wishlist', function () {
                $box = $(this);

                let id = $(this).data('id');
                axios.post('{{route('wishlist.store')}}', {
                    id: id
                }).then(function (res) {
                    swal.fire('success', '{{__('sweetalert.operation_success')}}', 'success')
                    location.reload();
                }, function (err) {
                    if (err.response.status === 401) {
                        swal.fire({
                            title: 'error',
                            text: '{{__('sweetalert.please_login')}}',
                            icon: 'error',
                            preConfirm(inputValue) {
                                if (inputValue) {
                                    location.href = "{{route('login')}}";
                                }
                            }
                        });
                    } else {
                        swal.fire('error', '{{__('sweetalert.error_internal_server')}}', 'error')
                    }
                });
            });

            $('#login').click(function () {
                location.href = "{{route('login')}}";
            })
        })
    </script>
@endsection
