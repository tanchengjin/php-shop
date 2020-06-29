@extends('main')
@section('content')
    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-70">
        <div class="container">
            <form action="{{route('orders.store')}}" method="post">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="cart_page table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th style="width: 5px"><input type="checkbox" class="select_all"></th>
                                        <th class="product_remove">{{__('cart.operation')}}</th>
                                        <th class="product_thumb">{{__('cart.image')}}</th>
                                        <th class="product_name">{{__('cart.product')}}</th>
                                        <th class="product-price">{{__('cart.price')}}</th>
                                        <th class="product_quantity">{{__('cart.quantity')}}</th>
                                        <th class="product_total">{{__('cart.total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr data-id="{{$cart->sku->id}}" data-price="{{$cart->sku->price}}"
                                            data-quantity="{{$cart->quantity}}">
                                            <td><input type="checkbox" class="checkbox"></td>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a
                                                    href="{{route('products.show',['id'=>$cart->sku->product->id])}}"><img
                                                        src="{{$cart->sku->product->first_image}}" alt=""></a></td>
                                            <td class="product_name"><a
                                                    href="{{route('products.show',['id'=>$cart->sku->product->id])}}">{{$cart->sku->product->title.' '.$cart->sku->title}}</a>
                                            </td>
                                            <td class="product-price">￥{{number_format($cart->sku->price,2)}}</td>
                                            <td class="product_quantity"><label>Quantity</label> <input min="1"
                                                                                                        max="100"
                                                                                                        value="{{$cart->quantity}}"
                                                                                                        type="number"
                                                                                                        name="quantity">
                                            </td>
                                            <td class="product_total">{{number_format($cart->sku->price*$cart->quantity,2)}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="cart_submit">
                                <button type="submit">update cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>Coupon</h3>
                                <div class="coupon_inner">
                                    <p>Enter your coupon code if you have one.</p>
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>{{__('cart.price')}}</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>{{__('order.order_subtotal')}}</p>
                                        <p class="cart_amount">£215.00</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>{{__('order.shipping')}}</p>
                                        <p class="cart_amount"><span>Flat Rate:</span> £255.00</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>{{__('order.total')}}</p>
                                        <p class="cart_amount">£215.00</p>
                                    </div>
                                    <div class="checkout_btn">
{{--                                        <a href="#">Proceed to Checkout</a>--}}
                                        <a id="create_order" type="button" href="javascript:void(0);">提交</a>
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
            //全选checkbox
            $('.select_all').click(function () {

                let status = $(this).prop('checked');
                let checkbox = $('input[type=checkbox][class=checkbox]:not("disabled")');
                let total = 0;
                let item = [];
                checkbox.each(function () {
                    $(this).prop('checked', status);
                    let price = $(this).closest('tr').data('price');
                    let quantity = $(this).closest('tr').data('quantity');
                    item.push({
                        'price': price,
                        'quantity': quantity
                    });
                });
                //所有商品总价
                total = setCartPrice(item);

            });

            $('input[type=checkbox]').on('change', function () {

                if ($(this).prop('checked')) {
                    //click
                    console.log('ok')
                } else {
                    //cancel
                }
                var s = $('input[type=checkbox][class=checkbox]');
                let box = $(this).closest('tr');
                console.log(s);
            });

            /**
             * 计算所有商品价格
             * @param item
             * @returns {number}
             */
            function setCartPrice(item) {
                let total = 0;
                $.each(item, function (key, value) {
                    total += value.price * value.quantity;
                });

                return total;
            }

            $('#create_order').click(function () {
                let res = {

                    items: [],
                    address_id: 1,
                    remark:'123',
                };

                $('tr[data-id]').each(function () {
                    //没有选中则跳出
                    let checkbox = $(this).find('input[type=checkbox][class=checkbox]');
                    if (checkbox.prop('disabled') || !checkbox.prop('checked')) {
                        return;
                    }
                    let quantity = $(this).find('input[name=quantity]').val();
                    console.log(quantity)
                    //buy quantity return if illegal
                    if (quantity <= 0 || isNaN(quantity)) {
                        return;
                    }

                    res.items.push({
                        'quantity': quantity,
                        'sku_id': $(this).data('id')
                    });
                });

                axios.post('{{route('orders.store')}}',res).then(function(res){
                    if (res.data.errno === 0) {
                        location.href="{{route('center.order.index')}}";
                    } else {
                        if (res.data.message) {
                            swal.fire('error', res.data.message, 'error');
                        } else {
                            swal.fire('error', '{{__('sweetalert.error')}}', 'error');
                        }
                    }
                },function(err){
                    swal.fire('error','{{__('sweetalert.error_internal_server')}}','error')
                });

            });
        });
    </script>
@endsection
