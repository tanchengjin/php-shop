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
                                        <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated"
                                             id="progress"
                                             style="width: {{$order->ttl}}%"></div>
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
                            @if($order->paid_at)

                                <div class="coupon_code left">
                                    <h3>订单信息</h3>
                                    <div class="coupon_inner">
                                        <div class="line">
                                            <div class="line-label">订单号</div>
                                            <div class="line-value">{{$order->no}}</div>
                                        </div>

                                        <div class="line">
                                            <div class="line-label">支付时间</div>
                                            <div class="line-value">{{$order->created_at}}</div>
                                        </div>

                                        <div class="line">
                                            <div class="line-label">订单状态</div>
                                            <div class="line-value">{{$order->orderStatus}}</div>
                                        </div>
                                        @if(isset($order->extra['refund_disagree_reason']) && $order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
                                            <div class="line">
                                                <div class="line-label">拒绝理由</div>
                                                <div
                                                    class="line-value">{{$order->extra['refund_disagree_reason']}}</div>
                                            </div>
                                        @endif

                                        <div class="line">
                                            <div class="line-label">物流状态</div>
                                            <div
                                                class="line-value">{{\App\Models\Order::$shipStatusMap[$order->ship_status]}}</div>
                                        </div>

                                        <div class="line">
                                            <div class="line-label">物流信息</div>
                                            <div
                                                class="line-value">{{$order->ship_data?join('-',$order->ship_data):'-'}}</div>
                                        </div>

                                        <div class="line">
                                            <div class="line-label">收货地址</div>
                                            <div class="line-value">{{implode(' ',$order->address)}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif

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
                                    <div class="checkout_btn">

                                        @if($order->paid_at)
                                            {{--                                            申请退款--}}
                                            @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING || $order->refund_status === \App\Models\Order::REFUND_STATUS_FAILED)
                                                <button class="apply_refund"
                                                        type="button">{{__('order.apply_refund')}}</button>
                                            @endif
                                        @elseif($order->closed)
                                            <button class="disabled" type="button">该订单已关闭</button>
                                        @else
                                            <a href="{{route('orders.confirm',$order->id)}}">{{__('order.pay')}}</a>
                                        @endif
                                        {{--                                        物流信息--}}
                                        @if($order->ship_status === \App\Models\Order::SHIP_STATUS_DELIVERED)
                                            <a href="javascript:void(0)" id="received">{{__('order.received')}}</a>
                                        @endif
                                    </div>
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
        $(document).ready(function () {
            var time = '{{config('shop.order_ttl')}}';
            var start_time = {{strtotime($order->created_at)}};
            ins = setInterval(function () {
                let current_time = Math.round(new Date().getTime() / 1000).toString();
                let el = current_time - start_time;
                let percent = Math.round((el / time) * 100);

                if (percent >= 100) {
                    console.log('return')
                    clearInterval(ins);
                }
                $('#progress').css('width', percent + '%');


            }, 500);


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

                        axios.post('{{route('payment.refund',$order->id)}}', {
                            'reason': inputValue
                        }).then(function (res) {
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


            $('#received').click(function () {
                axios.post('{{route('orders.received',$order->id)}}', {
                    '_token': '{{csrf_token()}}'
                }).then(function (res) {
                    if (res.data.errno === 0) {
                        window.location.reload();
                    } else {
                        swal.fire('error', res.data.message, 'error');
                    }
                }, function (error) {
                });
            });
        });
    </script>
@endsection
