<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Safira - product details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">

    <!-- CSS
     ========================= -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <!--font awesome css-->
    <link rel="stylesheet" href="{{asset('assets/css/font.awesome.css')}}">
    <!--ionicons css-->
    <link rel="stylesheet" href="{{asset('assets/css/ionicons.min.css')}}">
    <!--linearicons css-->
    <link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}">
    <!--animate css-->
    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{asset('assets/css/jquery-ui.min.css')}}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{asset('assets/css/slinky.menu.css')}}">
    <!--plugins css-->
    <link rel="stylesheet" href="{{asset('assets/css/plugins.css')}}">

    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <!--modernizr min js here-->
    <script src="{{asset('assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
</head>

<body>

<!--header area start-->

<!--offcanvas menu area start-->
<div class="off_canvars_overlay">

</div>
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="canvas_open">
                    <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                </div>
                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>
                    <div class="language_currency">
                        <ul>
                            <li class="language"><a href="#"> Language <i class="icon-right ion-ios-arrow-down"></i></a>
                                <ul class="dropdown_language">
                                    <li><a href="{{route('lang','en')}}">English</a></li>
                                    <li><a href="{{route('lang','zh')}}">简体中文</a></li>
                                    <li><a href="#">Russian</a></li>
                                </ul>
                            </li>
                            <li class="currency"><a href="#"> Currency <i class="icon-right ion-ios-arrow-down"></i></a>
                                <ul class="dropdown_currency">
                                    <li><a href="#">€ Euro</a></li>
                                    <li><a href="#">£ Pound Sterling</a></li>
                                    <li><a href="#">$ US Dollar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="header_social text-right">
                        <ul>
                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                            <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                            <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="search_container">
                        <form action="#">
                            <div class="hover_category">
                                <select class="select_option" name="select" id="categori1">
                                    <option selected value="1">Select a categories</option>
                                    <option value="2">Accessories</option>
                                    <option value="3">Accessories & More</option>
                                    <option value="4">Butters & Eggs</option>
                                    <option value="5">Camera & Video</option>
                                    <option value="6">Mornitors</option>
                                    <option value="7">Tablets</option>
                                    <option value="8">Laptops</option>
                                    <option value="9">Handbags</option>
                                    <option value="10">Headphone & Speaker</option>
                                    <option value="11">Herbs & botanicals</option>
                                    <option value="12">Vegetables</option>
                                    <option value="13">Shop</option>
                                    <option value="14">Laptops & Desktops</option>
                                    <option value="15">Watchs</option>
                                    <option value="16">Electronic</option>
                                </select>
                            </div>
                            <div class="search_box">
                                <input placeholder="Search product..." type="text">
                                <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                            </div>
                        </form>
                    </div>
                    <div class="header_account_area">
                        <div class="header_account_list register">
                            <ul>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <li><a href="{{route('center.index')}}">{{__('user.center')}}</a></li>
                                @else
                                    <li><a href="{{route('login')}}">{{__('website.register')}}</a></li>
                                    <li><span>/</span></li>
                                    <li><a href="{{route('login')}}">{{__('website.login')}}</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="header_account_list header_wishlist">
                            <a href="{{route('wishlist.index')}}"><span class="lnr lnr-heart"></span> <span
                                    class="item_count">3</span> </a>
                        </div>
                        <div class="header_account_list  mini_cart_wrapper">
                            <a href="{{route('carts.index')}}"><span class="lnr lnr-cart"></span><span
                                    class="item_count">2</span></a>
                        </div>
                    </div>
                    <div class="call-support">
                        <p>
                            <a href="tel:{{config('base.telephone')}}">{{config('base.telephone')}}</a> {{__('customer_support')}}
                        </p>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">
                            <li class="menu-item-has-children active">
                                <a href="#">Home</a>
                                <ul class="sub-menu">
                                    <li><a href="index.html">Home 1</a></li>
                                    <li><a href="index-2.html">Home 2</a></li>
                                    <li><a href="index-3.html">Home 3</a></li>
                                    <li><a href="index-4.html">Home 4</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">Shop</a>
                                <ul class="sub-menu">
                                    <li class="menu-item-has-children">
                                        <a href="#">Shop Layouts</a>
                                        <ul class="sub-menu">
                                            <li><a href="shop.html">shop</a></li>
                                            <li><a href="shop-fullwidth.html">Full Width</a></li>
                                            <li><a href="shop-fullwidth-list.html">Full Width list</a></li>
                                            <li><a href="shop-right-sidebar.html">Right Sidebar </a></li>
                                            <li><a href="shop-right-sidebar-list.html"> Right Sidebar list</a></li>
                                            <li><a href="shop-list.html">List View</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">other Pages</a>
                                        <ul class="sub-menu">
                                            <li><a href="cart.html">cart</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="my-account.html">my account</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Product Types</a>
                                        <ul class="sub-menu">
                                            <li><a href="product-details.html">product details</a></li>
                                            <li><a href="product-sidebar.html">product sidebar</a></li>
                                            <li><a href="product-grouped.html">product grouped</a></li>
                                            <li><a href="variable-product.html">product variable</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">blog</a>
                                <ul class="sub-menu">
                                    <li><a href="blog.html">blog</a></li>
                                    <li><a href="blog-details.html">blog details</a></li>
                                    <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                    <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                </ul>

                            </li>
                            <li class="menu-item-has-children">
                                <a href="#">pages </a>
                                <ul class="sub-menu">
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="services.html">services</a></li>
                                    <li><a href="faq.html">Frequently Questions</a></li>
                                    <li><a href="{{route('contactUs.index')}}">contact</a></li>
                                    <li><a href="login.html">login</a></li>
                                    <li><a href="404.html">Error 404</a></li>
                                </ul>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="my-account.html">my account</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="about.html">about Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{route('contactUs.index')}}"> Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="offcanvas_footer">
                        <span><a href="#"><i class="fa fa-envelope-o"></i> info@yourdomain.com</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->

<header>
    <div class="main_header">
        <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                        <div class="language_currency">
                            <ul>
                                <li class="language"><a href="#"> Language <i class="icon-right ion-ios-arrow-down"></i></a>
                                    <ul class="dropdown_language">
                                        <li><a href="{{route('lang','en')}}">English</a></li>
                                        <li><a href="{{route('lang','zh')}}">简体中文</a></li>
                                        <li><a href="#">Russian</a></li>
                                    </ul>
                                </li>
                                <li class="currency"><a href="#"> Currency <i class="icon-right ion-ios-arrow-down"></i></a>
                                    <ul class="dropdown_currency">
                                        <li><a href="#">€ Euro</a></li>
                                        <li><a href="#">£ Pound Sterling</a></li>
                                        <li><a href="#">$ US Dollar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header_social text-right">
                            <ul>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{route('index')}}"><img src="{{asset('assets/img/logo/logo.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="header_right_info">
                            <div class="search_container">
                                <form action="#">
                                    <div class="hover_category">
                                        <select class="select_option" name="select" id="categori2">
                                            <option selected value="1">Select a categories</option>
                                            <option value="2">Accessories</option>
                                            <option value="3">Accessories & More</option>
                                            <option value="4">Butters & Eggs</option>
                                            <option value="5">Camera & Video</option>
                                            <option value="6">Mornitors</option>
                                            <option value="7">Tablets</option>
                                            <option value="8">Laptops</option>
                                            <option value="9">Handbags</option>
                                            <option value="10">Headphone & Speaker</option>
                                            <option value="11">Herbs & botanicals</option>
                                            <option value="12">Vegetables</option>
                                            <option value="13">Shop</option>
                                            <option value="14">Laptops & Desktops</option>
                                            <option value="15">Watchs</option>
                                            <option value="16">Electronic</option>
                                        </select>
                                    </div>
                                    <div class="search_box">
                                        <input placeholder="Search product..." type="text">
                                        <button type="submit"><span class="lnr lnr-magnifier"></span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="header_account_area">
                                <div class="header_account_list register">
                                    <ul>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <li><a href="{{route('center.index')}}">{{__('user.center')}}</a></li>
                                        @else
                                            <li><a href="{{route('login')}}">{{__('website.register')}}</a></li>
                                            <li><span>/</span></li>
                                            <li><a href="{{route('login')}}">{{__('website.login')}}</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="header_account_list header_wishlist">
                                    <a href="{{route('wishlist.index')}}"><span class="lnr lnr-heart"></span> <span
                                            class="item_count">3</span> </a>
                                </div>
                                <div class="header_account_list  mini_cart_wrapper">
                                    <a href="{{route('carts.index')}}"><span class="lnr lnr-cart"></span><span
                                            class="item_count">2</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="categories_menu">
                            <div class="categories_title">
                                <h2 class="categori_toggle">{{__('website.all_category')}}</h2>
                            </div>
                            {{--                            分类列表--}}
                            @if(isset($categoryTree))
                                <div class="categories_menu_toggle">
                                    <ul>
                                        @each('layouts.nav',$categoryTree,'category')
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--main menu start-->
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li><a href="{{route('index')}}">{{__('website.home')}}</a>
                                    </li>
                                    <li class="mega_items">
                                        @if(url()->current() === route('products.index'))
                                            <a class="active"
                                               href="{{route('products.index')}}">{{__('website.shop')}}</a>
                                        @else
                                            <a href="{{route('products.index')}}">{{__('website.shop')}}</a>
                                        @endif
                                    </li>
                                    <li>
                                        @if(url()->current() === route('blog.index'))
                                            <a class="active" href="{{route('blog.index')}}">{{__('website.blog')}}</a>
                                        @else
                                            <a href="{{route('blog.index')}}">{{__('website.blog')}}</a>
                                        @endif
                                    </li>
                                    <li><a href="#">pages <i class="fa fa-angle-down"></i></a>
                                        <ul class="sub_menu pages">
                                            <li><a href="about.html">About Us</a></li>
                                            <li><a href="services.html">services</a></li>
                                            <li><a href="faq.html">Frequently Questions</a></li>
                                            <li><a href="{{route('contactUs.index')}}">contact</a></li>
                                            <li><a href="login.html">login</a></li>
                                            <li><a href="404.html">Error 404</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        @if(url()->current() === route('contactUs.index'))
                                            <a class="active"
                                               href="{{route('contactUs.index')}}"> {{__('website.contact_us')}}</a>
                                        @else
                                            <a href="{{route('contactUs.index')}}"> {{__('website.contact_us')}}</a>
                                        @endif
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                    </div>
                    <div class="col-lg-3">
                        <div class="call-support">
                            <p>
                                <a href="tel:{{config('base.telephone')}}">{{config('base.telephone')}}</a> {{__('website.customer_support')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--header area end-->

@section('breadcrumbs')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{route('index')}}">home</a></li>
                            <li>@yield('breadcrumb_title')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
@show

@yield('content')

<!--footer area start-->
<footer class="footer_widgets footer_border">
    <div class="container">
        <div class="footer_top">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-7">
                    <div class="widgets_container contact_us">
                        <div class="footer_logo">
                            <a href="index.html"><img src="{{asset('assets/img/logo/logo.png')}}" alt=""></a>
                        </div>
                        <p class="footer_desc">We are a team of designers and developers that create high quality
                            eCommerce, WordPress, Shopify .</p>
                        <p><span>Address:</span> {{config('base.address')}}</p>
                        <p><span>Email:</span> <a href="#">{{config('base.email')}}</a></p>
                        <p><span>Call us:</span> <a
                                href="tel:{{config('base.telephone')}}">{{config('base.telephone')}}</a></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-5">
                    <div class="widgets_container widget_menu">
                        <h3>Information</h3>
                        <div class="footer_menu">

                            <ul>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="#">Delivery Information</a></li>
                                <li><a href="#"> Privacy Policy</a></li>
                                <li><a href="#"> Terms & Conditions</a></li>
                                <li><a href="{{route('contactUs.index')}}"> Contact Us</a></li>
                                <li><a href="#"> Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="widgets_container widget_menu">
                        <h3>Extras</h3>
                        <div class="footer_menu">
                            <ul>
                                <li><a href="#">Brands</a></li>
                                <li><a href="#"> Gift Certificates</a></li>
                                <li><a href="#">Affiliate</a></li>
                                <li><a href="#">Specials</a></li>
                                <li><a href="#">Returns</a></li>
                                <li><a href="#"> Order History</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="widgets_container widget_newsletter">
                        <h3>{{__('website.subscribe_title')}}</h3>
                        <p class="footer_desc">{{__('website.subscribe_content')}}</p>
                        <div class="subscribe_form">
                            <form id="mc-form" class="mc-form footer-newsletter">
                                <input id="mc-email" type="email" autocomplete="off"
                                       placeholder="{{__('website.enter_you_email')}}"/>
                                <button id="mc-submit">{{__('website.subscribe')}}</button>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div><!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-7">
                    <div class="copyright_area">
                        <p>{{config('base.copyright')}}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="footer_payment">
                        <ul>
                            <li><a href="#"><img src="{{asset('assets/img/icon/paypal1.jpg')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('assets/img/icon/paypal2.jpg')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('assets/img/icon/paypal3.jpg')}}" alt=""></a></li>
                            <li><a href="#"><img src="{{asset('assets/img/icon/paypal4.jpg')}}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer area end-->


<!-- modal area start-->
@yield('modal_box')
<!-- modal area end-->


<!-- JS
============================================ -->
<!--jquery min js-->
<script src="{{asset('assets/js/vendor/jquery-3.4.1.min.js')}}"></script>
<!--popper min js-->
<script src="{{asset('assets/js/popper.js')}}"></script>
<!--bootstrap min js-->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!--owl carousel min js-->
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<!--slick min js-->
<script src="{{asset('assets/js/slick.min.js')}}"></script>
<!--magnific popup min js-->
<script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<!--counterup min js-->
<script src="{{asset('assets/js/jquery.counterup.min.js')}}"></script>
<!--jquery countdown min js-->
<script src="{{asset('assets/js/jquery.countdown.js')}}"></script>
<!--jquery ui min js-->
<script src="{{asset('assets/js/jquery.ui.js')}}"></script>
<!--jquery elevatezoom min js-->
<script src="{{asset('assets/js/jquery.elevatezoom.js')}}"></script>
<!--isotope packaged min js-->
<script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
<!--slinky menu js-->
<script src="{{asset('assets/js/slinky.menu.js')}}"></script>
<!-- Plugins JS -->
<script src="{{asset('assets/js/plugins.js')}}"></script>

<!-- Main JS -->
<script src="{{asset('assets/js/main.js')}}"></script>


@yield('javascript')
</body>

</html>
