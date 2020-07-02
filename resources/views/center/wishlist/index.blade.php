@extends('main')
@section('content')
    <!--wishlist area start -->
    <div class="wishlist_area mt-70">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc wishlist">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Delete</th>
                                        <th class="product_thumb">Image</th>
                                        <th class="product_name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product_quantity">Stock Status</th>
                                        <th class="product_total">Add To Cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wishlists as $wishlist)
                                        <tr>
                                            <td class="product_remove"><a href="#">X</a></td>
                                            <td class="product_thumb"><a href="#"><img
                                                        src="{{$wishlist->product->first_image}}" alt=""></a></td>
                                            <td class="product_name"><a href="#">{{$wishlist->product->title}}</a></td>
                                            <td class="product-price">{{number_format($wishlist->product->price,2)}}</td>
                                            <td class="product_quantity">{{$wishlist->product->on_sale}}</td>
                                            <td class="product_total"><a href="#">Add To Cart</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </form>
            <div class="row">
                <div class="col-12">
                    <div class="wishlist_share">
                        <h4>Share on:</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                            <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--wishlist area end -->
@endsection
