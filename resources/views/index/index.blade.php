@extends('main')
@section('breadcrumbs')
@endsection
@section('content')
    <!--slider area start-->
    <section class="slider_section">
        <div class="slider_area owl-carousel">
            @foreach($banners as $banner)
                <div class="single_slider d-flex align-items-center" data-bgimg="{{$banner->full_image}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="slider_content">
                                    <h1>{{$banner->title}}</h1>
                                    <h2>{{$banner->subtitle}}</h2>
                                    <p>{{$banner->content}}</p>
                                    @if($banner->url_type === \App\Models\Banner::URL_PRODUCT)
                                        <a href="{{route('products.show',$banner->url)}}">{{__('index.show_more')}} </a>
                                    @elseif($banner->url_type === \App\Models\Banner::URL_WEB)
                                        <a href="{{$banner->url}}">{{__('index.show_more')}} </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!--slider area end-->

    <!--shipping area start-->
    <div class="shipping_area">
        <div class="container">
            <div class="row">
                @foreach($supports as $support)
                    <div class="col-lg-3 col-md-6">
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="{{$support->image}}" alt="">
                            </div>
                            <div class="shipping_content">
                                <h3>{{$support->title}}</h3>
                                <p>{{$support->content}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--shipping area end-->

    <!--product area start-->
    <div class="product_area  mb-64">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_header">
                        <div class="section_title">
                            <p>Recently added our store</p>
                            <h2>Trending Products</h2>
                        </div>
                        <div class="product_tab_btn">
                            <ul class="nav" role="tablist">
                                <li>
                                    <a class="active" data-toggle="tab" href="#plant1" role="tab" aria-controls="plant1"
                                       aria-selected="true">
                                        {{__('index.new_product')}}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#plant2" role="tab" aria-controls="plant2"
                                       aria-selected="false">
                                        {{__('index.hot_product')}}
                                    </a>
                                </li>
                                <li>
                                    <a data-toggle="tab" href="#plant3" role="tab" aria-controls="plant3"
                                       aria-selected="false">
                                        {{__('index.sale_product')}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="plant1" role="tabpanel">
                                <div class="product_carousel product_column5 owl-carousel">
                                    @foreach($newProduct as $index=>$item)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['top']['images']) >= 2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_new">New</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['top']['price'])}}">{{$item['top']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span class="current_price">{{$item['top']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['bottom']['images']) >=2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_sale">New</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['bottom']['id'])}}">{{$item['bottom']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span
                                                                class="current_price">{{$item['bottom']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="plant2" role="tabpanel">
                                <div class="product_carousel product_column5 owl-carousel">
                                    @foreach($hotProduct as $index=>$item)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['top']['images']) >= 2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_new">Hot</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['top']['price'])}}">{{$item['top']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span class="current_price">{{$item['top']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['bottom']['images']) >=2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_sale">Hot</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['bottom']['id'])}}">{{$item['bottom']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span
                                                                class="current_price">{{$item['bottom']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane fade" id="plant3" role="tabpanel">
                                <div class="product_carousel product_column5 owl-carousel">
                                    @foreach($saleProduct as $index=>$item)
                                        <div class="product_items">
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['top']['images']) >= 2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['top']['id'])}}"><img
                                                                    src="{{$item['top']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_new">Sale</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['top']['price'])}}">{{$item['top']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span class="current_price">{{$item['top']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
                                            <article class="single_product">
                                                <figure>
                                                    <div class="product_thumb">
                                                        @if(count($item['bottom']['images']) >=2)
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                            <a class="secondary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['secondImage']}}" alt=""></a>
                                                        @else
                                                            <a class="primary_img"
                                                               href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                                    src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                        @endif
                                                        <div class="label_product">
                                                            <span class="label_sale">Sale</span>
                                                        </div>
                                                    </div>
                                                    <figcaption class="product_content">
                                                        <h4 class="product_name"><a
                                                                href="{{route('products.show',$item['bottom']['id'])}}">{{$item['bottom']['title']}}</a>
                                                        </h4>
                                                        <div class="price_box">
                                                            <span
                                                                class="current_price">{{$item['bottom']['price']}}</span>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </article>
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
    <!--product area end-->

    <!--banner area start-->
    <div class="banner_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="assets/img/bg/banner1.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="assets/img/bg/banner2.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banner area end-->

    <!--product area start-->
    <div class="product_area product_deals mb-65">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <p>Recently added our store </p>
                        <h2>Deals Of The Weeks</h2>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        <div class="product_carousel product_column5 owl-carousel">
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product14.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product15.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                            <span class="label_new">New</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Mauris Vel Tellus</a>
                                        </h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$48.00</span>
                                            <span class="old_price">$257.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product16.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product17.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Nunc Neque Eros</a></h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$35.00</span>
                                            <span class="old_price">$245.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product18.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product19.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Proin Lectus Ipsum</a>
                                        </h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product20.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product21.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                            <span class="label_new">New</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Quisque In Arcu</a></h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$55.00</span>
                                            <span class="old_price">$235.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product15.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product14.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Cas Meque Metus</a></h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="product-details.html"><img
                                                src="assets/img/product/product17.jpg" alt=""></a>
                                        <a class="secondary_img" href="product-details.html"><img
                                                src="assets/img/product/product16.jpg" alt=""></a>
                                        <div class="label_product">
                                            <span class="label_sale">Sale</span>
                                        </div>
                                        <div class="product_timing">
                                            <div data-countdown="2021/12/15"></div>
                                        </div>
                                        <div class="action_links">
                                            <ul>
                                                <li class="add_to_cart"><a href="cart.html" title="Add to cart"><span
                                                            class="lnr lnr-cart"></span></a></li>
                                                <li class="quick_button"><a href="#" data-toggle="modal"
                                                                            data-target="#modal_box" title="quick view">
                                                        <span class="lnr lnr-magnifier"></span></a></li>
                                                <li class="wishlist"><a href="wishlist.html"
                                                                        title="Add to Wishlist"><span
                                                            class="lnr lnr-heart"></span></a></li>
                                                <li class="compare"><a href="#" title="Add to Compare"><span
                                                            class="lnr lnr-sync"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <figcaption class="product_content">
                                        <h4 class="product_name"><a href="product-details.html">Aliquam Consequat</a>
                                        </h4>
                                        <p><a href="#">Fruits</a></p>
                                        <div class="price_box">
                                            <span class="current_price">$26.00</span>
                                            <span class="old_price">$362.00</span>
                                        </div>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product area end-->

    <!--banner fullwidth area satrt-->
    <div class="banner_fullwidth">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_full_content">
                        <p>Black Fridays !</p>
                        <h2>Sale 50% OFf <span>all vegetable products</span></h2>
                        <a href="shop.html">discover now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--banner fullwidth area end-->

    <!--product banner area satrt-->
    <div class="product_banner_area mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <p>Recently added our store </p>
                        <h2>Best Sellers</h2>
                    </div>
                </div>
            </div>
            <div class="product_banner_container">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="banner_thumb">
                            <a href="shop.html"><img src="assets/img/bg/banner4.jpg" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <div class="small_product_area product_column2 owl-carousel">
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product1.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product2.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Aliquam
                                                    Consequat</a></h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$26.00</span>
                                                <span class="old_price">$362.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product3.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product4.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Donec Non Est</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$46.00</span>
                                                <span class="old_price">$382.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product5.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product6.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Mauris Vel
                                                    Tellus</a></h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$56.00</span>
                                                <span class="old_price">$362.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product7.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product8.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Quisque In Arcu</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$20.00</span>
                                                <span class="old_price">$352.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product9.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product10.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Cas Meque Metus</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$72.00</span>
                                                <span class="old_price">$352.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product11.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product12.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Proin Lectus
                                                    Ipsum</a></h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$36.00</span>
                                                <span class="old_price">$282.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product13.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product1.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Mauris Vel
                                                    Tellus</a></h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$45.00</span>
                                                <span class="old_price">$162.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product10.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product3.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Donec Non Est</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$46.00</span>
                                                <span class="old_price">$382.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="product-details.html"><img
                                                    src="assets/img/product/product8.jpg" alt=""></a>
                                            <a class="secondary_img" href="product-details.html"><img
                                                    src="assets/img/product/product5.jpg" alt=""></a>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="product-details.html">Donec Non Est</a>
                                            </h4>
                                            <p><a href="#">Fruits</a></p>
                                            <div class="action_links">
                                                <ul>
                                                    <li class="add_to_cart"><a href="cart.html"
                                                                               title="Add to cart"><span
                                                                class="lnr lnr-cart"></span></a></li>
                                                    <li class="quick_button"><a href="#" data-toggle="modal"
                                                                                data-target="#modal_box"
                                                                                title="quick view"> <span
                                                                class="lnr lnr-magnifier"></span></a></li>
                                                    <li class="wishlist"><a href="wishlist.html"
                                                                            title="Add to Wishlist"><span
                                                                class="lnr lnr-heart"></span></a></li>
                                                    <li class="compare"><a href="#" title="Add to Compare"><span
                                                                class="lnr lnr-sync"></span></a></li>
                                                </ul>
                                            </div>
                                            <div class="price_box">
                                                <span class="current_price">$46.00</span>
                                                <span class="old_price">$382.00</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product banner area end-->

    <!--product area start-->
    <div class="product_area mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <p>Most View Products</p>
                        <h2>{{__('index.most_view_product')}}</h2>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        <div class="product_carousel product_column5 owl-carousel">
                            @foreach($mostViewProduct as $item)
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            @if(count($item->images) >= 2)
                                                <a class="primary_img" href="{{route('products.show',$item->id)}}"><img
                                                        src="{{$item->first_image}}" alt=""></a>
                                                <a class="secondary_img"
                                                   href="{{route('products.show',$item->id)}}"><img
                                                        src="{{$item->second_image}}" alt=""></a>
                                            @else
                                                <a class="primary_img" href="{{route('products.show',$item->id)}}"><img
                                                        src="{{$item->first_image}}" alt=""></a>
                                            @endif
                                            <div class="label_product">
                                                @foreach($item->tags as $tag)
                                                    <span class="label_sale">{{$tag}}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a
                                                    href="{{route('products.show',$item['id'])}}">{{$item['title']}}</a>
                                            </h4>
                                            <div class="price_box">
                                                <span class="current_price">{{$item['price']}}</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product area end-->

    <!--blog area start-->
    <section class="blog_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <p>Our Blog Posts</p>
                        <h2>{{__('index.our_post')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog_carousel blog_column3 owl-carousel">
                    @foreach($recentBlogs as $blog)
                        <div class="col-lg-3">
                            <article class="single_blog">
                                <figure>
                                    <div class="blog_thumb">
                                        <a href="{{route('blog.show',hashids_id($blog->id))}}"><img
                                                src="{{$blog->full_image}}" alt=""></a>
                                    </div>
                                    <figcaption class="blog_content">
                                        <div class="articles_date">
                                            <p>{{toDateString($blog->created_at,'en_/')}} | <a
                                                    href="#">{{$blog->author}}</a></p>
                                        </div>
                                        <h4 class="post_title"><a
                                                href="{{route('blog.show',hashids_id($blog->id))}}">{{$blog->title}}</a>
                                        </h4>
                                        <footer class="blog_footer">
                                            <a href="blog-details.html">{{__('website.show')}}</a>
                                        </footer>
                                    </figcaption>
                                </figure>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--blog area end-->

    <!--custom product area start-->
    <div class="custom_product_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>{{__('index.recommend_product')}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="small_product_area product_carousel product_column3 owl-carousel">
                        @foreach($recommendProduct as $item)
                            <div class="product_items">
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            @if(count($item['top']['images']) >= 2)
                                                <a class="primary_img" href="{{route('products.show',$item['top']['id'])}}"><img
                                                        src="{{$item['top']['firstImage']}}" alt=""></a>
                                                <a class="secondary_img" href="{{route('products.show',$item['top']['id'])}}"><img
                                                        src="{{$item['top']['secondImage']}}" alt=""></a>
                                            @else
                                                <a class="primary_img" href="{{route('products.show',$item['top']['id'])}}"><img
                                                        src="{{$item['top']['firstImage']}}" alt=""></a>
                                            @endif
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="{{route('products.show',$item['top']['id'])}}">{{$item['top']['title']}}</a>
                                            </h4>
                                            <p><a href="#"></a></p>
                                            <div class="price_box">
                                                <span class="current_price">{{$item['top']['price']}}</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            @if(count($item['middle']['images']) >= 2)
                                                <a class="primary_img" href="{{route('products.show',$item['middle']['id'])}}"><img
                                                        src="{{$item['middle']['firstImage']}}" alt=""></a>
                                                <a class="secondary_img" href="{{route('products.show',$item['middle']['id'])}}"><img
                                                        src="{{$item['middle']['secondImage']}}" alt=""></a>
                                            @else
                                                <a class="primary_img" href="{{route('products.show',$item['middle']['id'])}}"><img
                                                        src="{{$item['middle']['firstImage']}}" alt=""></a>
                                            @endif
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="{{route('products.show',$item['middle']['id'])}}">{{$item['middle']['title']}}</a>
                                            </h4>
                                            {{--                                            <p><a href="#"></a></p>--}}
                                            <div class="price_box">
                                                <span class="current_price">{{$item['middle']['price']}}</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            @if(count($item['bottom']['images']) >= 2)
                                                <a class="primary_img" href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                        src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                                <a class="secondary_img" href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                        src="{{$item['bottom']['secondImage']}}" alt=""></a>
                                            @else
                                                <a class="primary_img" href="{{route('products.show',$item['bottom']['id'])}}"><img
                                                        src="{{$item['bottom']['firstImage']}}" alt=""></a>
                                            @endif
                                        </div>
                                        <figcaption class="product_content">
                                            <h4 class="product_name"><a href="{{route('products.show',$item['bottom']['id'])}}">{{$item['bottom']['title']}}</a>
                                            </h4>
                                            {{--                                            <p><a href="#"></a></p>--}}
                                            <div class="price_box">
                                                <span class="current_price">{{$item['bottom']['price']}}</span>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--custom product area end-->

    <!--brand area start-->
    <!--brand area start-->
    @if(isset($partners) && count($partners) >= 1)
        <div class="brand_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="brand_container owl-carousel ">
                            @foreach($partners as $partner)
                                <div class="single_brand">
                                    @if($partner->url)
                                        <a href="javascript:void(0)"><img src="{{$partner->full_image}}" alt=""></a>
                                    @else
                                        <a href="{{$partner->url}}"><img src="{{$partner->full_image}}" alt=""></a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!--brand area end-->
    <!--brand area end-->
@endsection
