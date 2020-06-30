@extends('main')
@section('content')
    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">
                            <div class="widget_list widget_categories">
                                <h3>Women</h3>
                                <ul>
                                    <li class="widget_sub_categories sub_categories1"><a
                                            href="javascript:void(0)">Shoes</a>
                                        <ul class="widget_dropdown_categories dropdown_categories1">
                                            <li><a href="#">Document</a></li>
                                            <li><a href="#">Dropcap</a></li>
                                            <li><a href="#">Dummy Image</a></li>
                                            <li><a href="#">Dummy Text</a></li>
                                            <li><a href="#">Fancy Text</a></li>
                                        </ul>
                                    </li>
                                    <li class="widget_sub_categories sub_categories2"><a
                                            href="javascript:void(0)">Bags</a>
                                        <ul class="widget_dropdown_categories dropdown_categories2">
                                            <li><a href="#">Flickr</a></li>
                                            <li><a href="#">Flip Box</a></li>
                                            <li><a href="#">Cocktail</a></li>
                                            <li><a href="#">Frame</a></li>
                                            <li><a href="#">Flickrq</a></li>
                                        </ul>
                                    </li>
                                    <li class="widget_sub_categories sub_categories3"><a
                                            href="javascript:void(0)">Clothing</a>
                                        <ul class="widget_dropdown_categories dropdown_categories3">
                                            <li><a href="#">Platform Beds</a></li>
                                            <li><a href="#">Storage Beds</a></li>
                                            <li><a href="#">Regular Beds</a></li>
                                            <li><a href="#">Sleigh Beds</a></li>
                                            <li><a href="#">Laundry</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="widget_list widget_filter">
                                <h3>Filter by price</h3>
                                <form action="#">
                                    <div id="slider-range"></div>
                                    <button type="submit">Filter</button>
                                    <input type="text" name="text" id="amount"/>

                                </form>
                            </div>
                            <div class="widget_list widget_color">
                                <h3>Select By Color</h3>
                                <ul>
                                    <li>
                                        <a href="#">Black <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> Blue <span>(8)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Brown <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> Green <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Pink <span>(4)</span></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="widget_list widget_color">
                                <h3>Select By SIze</h3>
                                <ul>
                                    <li>
                                        <a href="#">S <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> M <span>(8)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">L <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> XL <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">XLL <span>(4)</span></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="widget_list widget_manu">
                                <h3>Manufacturer</h3>
                                <ul>
                                    <li>
                                        <a href="#">Brake Parts <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Accessories <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Engine Parts <span>(4)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">hermes <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="#">louis vuitton <span>(8)</span></a>
                                    </li>

                                </ul>
                            </div>
                            <div class="widget_list tags_widget">
                                <h3>Product tags</h3>
                                <div class="tag_cloud">
                                    <a href="#">Men</a>
                                    <a href="#">Women</a>
                                    <a href="#">Watches</a>
                                    <a href="#">Bags</a>
                                    <a href="#">Dress</a>
                                    <a href="#">Belt</a>
                                    <a href="#">Accessories</a>
                                    <a href="#">Shoes</a>
                                </div>
                            </div>
                            <div class="widget_list banner_widget">
                                <div class="banner_thumb">
                                    <a href="#"><img src="assets/img/bg/banner17.jpg" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">

                            <button data-role="grid_3" type="button" class=" btn-grid-3" data-toggle="tooltip"
                                    title="3"></button>

                            <button data-role="grid_4" type="button" class=" btn-grid-4" data-toggle="tooltip"
                                    title="4"></button>

                            <button data-role="grid_list" type="button" class="active btn-list" data-toggle="tooltip"
                                    title="List"></button>
                        </div>
                        <div class=" niceselect_option">
                            <form class="select_option" action="#">
                                <select name="orderby" id="short">

                                    <option selected value="1">Sort by average rating</option>
                                    <option value="2">Sort by popularity</option>
                                    <option value="3">Sort by newness</option>
                                    <option value="4">Sort by price: low to high</option>
                                    <option value="5">Sort by price: high to low</option>
                                    <option value="6">Product Name: Z</option>
                                </select>
                            </form>
                        </div>
                        <div class="page_amount">
                            <p>Showing 1–9 of 21 results</p>
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <div class="row shop_wrapper grid_list">
                        @foreach($products as $product)
                            <div class="col-12 ">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        @if(count($product->images) > 0)
                                            <a class="primary_img"
                                               href="{{route('products.show',['id'=>$product->id])}}"><img
                                                    src="assets/img/product/productbig1.jpg" alt=""></a>
                                            <a class="secondary_img"
                                               href="{{route('products.show',['id'=>$product->id])}}"><img
                                                    src="assets/img/product/productbig2.jpg" alt=""></a>
                                            <div class="label_product">
                                                <span class="label_sale">Sale</span>
                                                <span class="label_new">New</span>
                                            </div>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view">
                                                            <span class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="javascript:void(0);"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                        @else
                                            <a class="primary_img"
                                               href="{{route('products.show',['id'=>$product->id])}}"><img
                                                    src="{{asset('assets/img/error.png')}}" alt=""></a>
                                        @endif
                                    </div>
                                    <div class="product_content grid_content">
                                        <h4 class="product_name"><a
                                                href="{{route('products.show',['id'=>$product->id])}}">Aliquam
                                                Consequat</a></h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                    </div>
                                    <div class="product_content list_content">
                                        <h4 class="product_name"><a
                                                href="{{route('products.show',['id'=>$product->id])}}">{{$product->title}}</a>
                                        </h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">￥{{number_format($product->price,2)}}</span>
                                        </div>
                                        <div class="product_desc">
                                            <p>{{$product->intro}}</p>
                                        </div>
                                        <div class="action_links list_action_right">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html"
                                                                           title="Add to cart">{{__('website.add_to_cart')}}</a>
                                                </li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box"
                                                                            title="{{__('website.quick_view')}}"> <span
                                                            class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="javascript:void(0);"
                                                                        title="{{__('website.add_to_wishlist')}}"
                                                                        class="add_to_wishlist"
                                                                        data-id="{{$product->id}}"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#"
                                                                       title="{{__('website.add_to_compare')}}"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            {{$products->links()}}
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('body').on('click','.remove_wishlist',function(){

                $box = $(this);

                let id = $box.data('id');
                axios.delete('/wishlist/'+id).then(function (res) {
                    console.log(res)
                    $box.removeAttr('style');
                    $box.removeClass('remove_wishlist');
                    $box.addClass('add_to_wishlist');
                    swal.fire('success','{{__('sweetalert.operation_success')}}','success')
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


            $('body').on('click','.add_to_wishlist',function () {
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
                    swal.fire('success','{{__('sweetalert.operation_success')}}','success')

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


        });
    </script>
@endsection
