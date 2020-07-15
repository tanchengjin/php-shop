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
                                        <th class="product_remove">{{__('website.delete')}}</th>
                                        <th class="product_thumb">{{__('cart.image')}}</th>
                                        <th class="product_name">{{__('cart.product')}}</th>
                                        <th class="product-price">{{__('cart.price')}}</th>
                                        <th class="product_total">{{__('website.options')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wishlists as $wishlist)
                                        <tr>
                                            <td class="product_remove"><a href="#" class="wishlist_delete"
                                                                          data-id="{{$wishlist->id}}">X</a></td>
                                            <td class="product_thumb"><a
                                                    href="{{route('products.show',$wishlist->product->id)}}"><img
                                                        src="{{$wishlist->product->first_image}}" alt=""></a></td>
                                            <td class="product_name"><a href="#">{{$wishlist->product->title}}</a></td>
                                            <td class="product-price">{{number_format($wishlist->product->price,2)}}</td>
                                            <td class="product_total"><a
                                                    href="{{route('products.show',$wishlist->product->id)}}">{{__('website.show')}}</a>
                                            </td>
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

@section('javascript')
    <script>
        $('.wishlist_delete').on('click', function () {
            let id = $(this).data('id');

            swal.fire({
                title: '确定要删除吗？',
                showCancelButton: true,
                icon: 'warning',
                preConfirm: function (val) {
                    if (val) {
                        axios.delete('wishlist/' + id).then(function (res) {
                            if (res.data.errno === 0) {
                                swal.fire('{{__('sweetalert.operation_success')}}', '', 'success');
                                location.reload();
                            } else {
                                swal.fire('{{__('sweetalert.operation_error')}}', res.data.message, 'error');
                            }
                        }, function () {
                            swal.fire('{{__('sweetalert.operation_error')}}', '', 'error');
                        })
                    }
                }
            });
        })
    </script>
@endsection
