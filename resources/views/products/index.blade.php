@extends('main')
@section('breadcrumb_title',__('cart.product'))
@section('page.title',__('website.products'))
@section('content')
    <!--shop  area start-->
    <div class="shop_area shop_fullwidth mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="page_amount">
                            @if(count($products) < 1)
                                <p>{{__('website.show_result',['first'=>0,'last'=>0,'total'=>0])}}</p>

                            @elseif($products->currentPage() === 1)
                                <p>{{__('website.show_result',['first'=>1,'last'=>$products->perPage() >= $products->total()?$products->total():$products->perPage(),'total'=>$products->total()])}}</p>
                            @else
                                <p>{{__('website.show_result',[
    'first'=>($products->currentPage()-1)+$products->perPage(),
    'last'=>($products->perPage()*$products->currentPage()) >= $products->total() ?$products->total():($products->perPage()*$products->currentPage()),
    'total'=>$products->total()
    ])}}</p>
                            @endif
                        </div>

                        <div class="niceselect_option">
                            <form class="select_option" action="#" id="select_order">
                                <input type="hidden" name="order">
                                <select name="orderby" id="short">
                                    <option value="0">{{__('website.please_select_order')}}</option>
                                    <option
                                        value="price_asc">{{__('website.sort_by_asc',['key'=>__('cart.price')])}}</option>
                                    <option
                                        value="price_desc">{{__('website.sort_by_desc',['key'=>__('cart.price')])}}</option>

                                    <option
                                        value="review_asc">{{__('website.sort_by_asc',['key'=>__('website.review')])}}</option>
                                    <option
                                        value="review_desc">{{__('website.sort_by_desc',['key'=>__('website.review')])}}</option>

                                    <option
                                        value="rating_asc">{{__('website.sort_by_asc',['key'=>__('website.rating')])}}</option>
                                    <option
                                        value="rating_desc">{{__('website.sort_by_desc',['key'=>__('website.rating')])}}</option>

                                    <option
                                        value="sold_asc">{{__('website.sort_by_asc',['key'=>__('website.sold_count')])}}</option>
                                    <option
                                        value="sold_desc">{{__('website.sort_by_desc',['key'=>__('website.sold_count')])}}</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <div class="row shop_wrapper">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-6 ">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        @if(count($product->images) > 0)
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/productbig1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/productbig2.jpg" alt=""></a>
                                        @else
                                            <a class="primary_img" href="{{route('products.show',$product->id)}}"><img
                                                    src="{{asset('assets/images/error.png')}}" alt=""></a>
                                        @endif
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                            <span class="label_new">New</span>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box_{{$product->id}}"
                                                                            title="{{__('website.quick_view')}}">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                @if($product->isWishlist)
                                                    <li class="wishlist"><a href="javascript:void(0)"
                                                                            title="{{__('website.remove')}}"
                                                                            class="remove_wishlist"
                                                                            data-id="{{$product->id}}"
                                                                            style="background:#40A944;color:#ffffff"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                @else
                                                    <li class="wishlist"><a href="javascript:void(0)"
                                                                            title="{{__('website.add_to_wishlist')}}"
                                                                            class="add_to_wishlist"
                                                                            data-id="{{$product->id}}"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                @endif
                                                {{--                                                <li class="compare"><a href="#"--}}
                                                {{--                                                                       title="{{__('website.add_to_compare')}}"><span--}}
                                                {{--                                                            class="lnr lnr-sync"></span></a></li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product_bottom">
                                        <div class="sold_count">销量：<span>{{$product->sold_count}}</span></div>
                                        <div class="reviewed_count">评价：<span>{{$product->review_count}}</span></div>
                                    </div>
                                    <div class="product_content grid_content">
                                        <h4 class="product_name"><a
                                                href="{{route('products.show',$product->id)}}">{{$product->title}}</a>
                                        </h4>
                                        <div class="price_box">
                                            <span class="current_price">￥{{$product->price}}</span>
                                            {{--                                        <span class="old_price">$362.00</span>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($products->total() > $products->perPage())
                    <div class="shop_toolbar t_bottom">
                        {{$products->appends($param)->links()}}
                    </div>
                    @endif
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection


@section('modal_box')
    @foreach($products as $product)
        <div class="modal fade" id="modal_box_{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-x"></i></span>
                    </button>
                    <div class="modal_body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-12">
                                    <div class="modal_tab">
                                        <div class="tab-content product-details-large">
                                            @if(count($product->images) >= 1)
                                                @foreach($product->images as $index=>$image)
                                                    <div class="tab-pane fade @if($index === 0)show active @endif"
                                                         id="tab{{$index++}}" role="tabpanel">
                                                        <div class="modal_tab_img">
                                                            <a href="#"><img
                                                                    src="{{\Illuminate\Support\Facades\Storage::url($image->url)}}"
                                                                    alt="{{$product->title}}"
                                                                    style="width: 100%;height: 100%"></a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                                    <div class="modal_tab_img">
                                                        <a href="#"><img
                                                                src="{{asset('assets/images/error.png')}}"
                                                                alt="{{$product->title}}"
                                                                style="width: 100%;height:100%"></a>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="modal_tab_button">
                                            <ul class="nav product_navactive owl-carousel" role="tablist">
                                                @if(count($product->images) >= 2)
                                                    @foreach($product->images as $index=>$image)
                                                        <li>
                                                            <a class="nav-link active" data-toggle="tab"
                                                               href="#tab{{$index++}}"
                                                               role="tab"
                                                               aria-controls="tab{{$index++}}"
                                                               aria-selected="false"><img
                                                                    src="{{\Illuminate\Support\Facades\Storage::url($image->url)}}"
                                                                    alt=""></a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-12">
                                    <div class="modal_right">
                                        <div class="modal_title mb-10">
                                            <h2>{{$product->title}}</h2>
                                        </div>
                                        <div class="modal_price mb-10">
                                            <span class="new_price">￥{{$product->price}}</span>
                                            {{--                                            <span class="old_price">$78.99</span>--}}
                                        </div>
                                        <div class="modal_description mb-15">
                                            <p>{{$product->intro}}</p>
                                        </div>
                                        <div class="variants_selects">
                                            <div class="variants_size">
                                                <h2>规格</h2>
                                                <div class="">
                                                    @foreach($product->skus as $sku)
                                                        <input type="radio" value="{{$sku->id}}"
                                                               name="sku">{{$sku->title}}</input>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="modal_add_to_cart">
                                                <form action="#">
                                                    <input min="1" max="100" step="2" value="1" type="number"
                                                           class="add_to_cart_amount">
                                                    <button type="button"
                                                            class="add_to_cart">{{__('website.add_to_cart')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="modal_social">
                                            <h2>{{__('blog.share_this_product')}}</h2>
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a>
                                                </li>
                                                <li class="google-plus"><a href="#"><i
                                                            class="fa fa-google-plus"></i></a></li>
                                                <li class="linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection


@section('javascript')
    <script>
        $(document).ready(function () {
            var param = @json($param);

            if (param.search) {
                $('.search_input').val(param.search);
            }
            if (param.order) {
                var $orderLi = $('li[data-value=' + param.order + ']');
                $orderLi.addClass('option selected');
                $('span[class=current]').text($orderLi.html())
            }

            //获取当前url参数
            function getQuery() {
                return window.location.search.substring(1);
            }

            $('body').on('click', '.remove_wishlist', function () {

                $box = $(this);

                let id = $box.data('id');
                axios.delete('/wishlist/' + id).then(function (res) {
                    $box.removeAttr('style');
                    $box.removeClass('remove_wishlist');
                    $box.addClass('add_to_wishlist');
                    swal.fire('success', '{{__('sweetalert.operation_success')}}', 'success')
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
                    $box.css({
                        'background': '#40A944',
                        'color': '#ffffff'
                    });
                    $box.removeClass('add_to_wishlist');
                    $box.addClass('remove_wishlist');
                    swal.fire('success', '{{__('sweetalert.operation_success')}}', 'success')

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


            //加入购物车
            $('body').on('click', '.add_to_cart', function () {
                let id = $('input[type=radio][name=sku]:checked').val();


                let quantity = $(this).prev('.add_to_cart_amount').val();

                if (!id) {
                    return swal.fire('error', '{{__('sweetalert.please_select_sku')}}', 'error');
                }

                if (!quantity) {
                    return swal.fire('error', '{{__('sweetalert.error_quantity')}}', 'error');
                }

                axios.post('{{route('carts.store')}}', {
                    'sku_id': id,
                    'quantity': quantity
                }).then(function (res) {
                    if (res.data.errno === 0) {
                        swal.fire({
                            title: '{{__('sweetalert.operation_success')}}',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: '{{__('sweetalert.go_shopping_cart')}}',
                            cancelButtonText: '{{__('sweetalert.continue_preview')}}',
                            preConfirm: function (val) {
                                if (val) {
                                    location.href = '{{route('carts.index')}}';
                                }
                            }
                        })
                    } else {
                        swal.fire('error', '{{__('sweetalert.operation_error')}}', 'error');
                    }
                }, function (err) {
                    if (err.response.status === 422) {
                        let content = '<div>';
                        _.each(err.response.data.errors, function (errors) {
                            _.each(errors, function (error) {
                                content += error + '<br>';
                            })
                        })
                        content += '</div>';
                        swal.fire('error', content, 'error');
                    }
                });
            });

            $('body').on('click', '.list>li', function () {
                let value = $(this).data('value');
                $('input[name=order]').val(value);
                $('form[id=select_order]').submit();
            });

        });
    </script>
@endsection

