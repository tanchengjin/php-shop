@extends('main')
@section('content')
    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-70">
        <div class="container">
            <form action="#">
                <div class="row">
                    <div class="col-12">
                        @if(!$order->paid_at)
                            <div class="alert alert-danger">
                                @if($order->closed)
                                    该订单已关闭
                                @else
                                    请于 <strong>{{$order->created_at->addSecond(config('shop.order_ttl'))}}</strong>
                                    之前支付该订单
                                @endif
                            </div>
                        @endif
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                @if(!$order->paid_at)

                                    <div class="progress">
                                        <div class="progress-bar bg-danger" style="width: 40%"></div>
                                    </div>
                                @endif

                                <table>
                                    <thead>
                                    <tr>
                                        <th class="product_thumb">{{__('cart.image')}}</th>
                                        <th class="product_name">{{__('cart.product')}}</th>
                                        <th class="product-price">{{__('cart.price')}}</th>
                                        <th class="product_quantity">{{__('cart.quantity')}}</th>
                                        <th class="product_total">{{__('cart.total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="product_thumb"><a href="#"><img
                                                        src="{{$item->product->first_image}}" alt=""></a></td>
                                            <td class="product_name"><a
                                                    href="#">{{$item->product->title}} {{$item->sku->title}}</a>
                                            </td>
                                            <td class="product-price">￥{{number_format($item->price,2)}}</td>
                                            <td class="product_quantity">{{$item->quantity}}</td>
                                            <td class="product_total">
                                                ￥{{number_format($item->price*$item->quantity,2)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">

                        <div class="col-lg-6 col-md-6">
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>{{__('order.order_total')}}</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>{{__('order.order_subtotal')}}</p>
                                        <p class="cart_amount">{{number_format($order->total_price,2)}}</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>{{__('order.shipping')}}</p>
                                        <p class="cart_amount"><span>Flat Rate:</span>
                                            ￥{{number_format($order->shopping)}}</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>{{__('order.total')}}</p>
                                        <p class="cart_amount">￥{{number_format($order->total_price,2)}}</p>
                                    </div>
                                    @if($order->paid_at)
                                        <div class="checkout_btn">
                                            <button class="apply_refund">{{__('order.apply_refund')}}</button>

                                        </div>
                                    @elseif($order->closed)
                                        <div class="checkout_btn">
                                            <button class="disabled" type="button">该订单已关闭</button>
                                        </div>
                                    @else
                                        <div class="checkout_btn">
                                            <a href="{{route('orders.confirm',$order->id)}}">{{__('order.pay')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form>
        </div>
    </div>
    <!--shopping cart area end -->
@endsection

@section('javascript')
    <script>
        $('.apply_refund').click(function () {
            swal.fire({
                title: '请输入退款理由',
                input: 'text',
                showCancelButton: true,
                preConfirm: function (inputValue) {
                    if (!inputValue) {
                        swal.fire('请输入退款理由', '', 'error');
                        return;
                    }

                    axios.post('{{route('payment.refund',$order->id)}}').then(function (res) {
                        if (res.data.errno === 0) {
                            location.reload();
                        } else {
                            return swal.fire('error', res.data.message, 'error');
                        }
                    }, function (err) {
                        return swal.fire('error', '{{__('sweetalert.error_internal_server')}}', 'error');
                    });
                }
            });
        });
    </script>
@endsection
