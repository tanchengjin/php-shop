@extends('main')
@section('content')
    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-70" id="vue_cart">
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
                                            <td><input type="checkbox" class="checkbox"
                                                       v-model="test" :value="{{$cart->sku->price*$cart->quantity}}">
                                            </td>
                                            <td class="product_remove"><a href="#"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            <td class="product_thumb"><a
                                                    href="{{route('products.show',['id'=>$cart->sku->product->id])}}"><img
                                                        src="{{$cart->sku->product->first_image}}" alt=""></a></td>
                                            <td class="product_name"><a
                                                    href="{{route('products.show',['id'=>$cart->sku->product->id])}}">{{$cart->sku->product->title.' '.$cart->sku->title}}</a>
                                            </td>
                                            <td class="product-price">￥{{number_format($cart->sku->price,2)}}</td>
                                            <td class="product_quantity"><input min="1"
                                                                                max=""
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
                            <div class="row form-group" style="margin-top: 50px;">
                                <label for="address_id" class="col-3 col-form-label text-right">收货地址</label>
                                <div class="col-6">
                                    <select name="address_id" id="" class="form-control" style="width: 100%;">
                                        @foreach($addresses as $address)
                                            <option value="{{$address->id}}">{{$address->full_address}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row form-group" style="margin-top: 50px;">
                                <label for="remark" class="col-3 col-form-label text-right">订单备注</label>
                                <div class="col-6">
                                    <textarea class="form-control" name="remark" id="remark"
                                              style="resize:none"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area start-->
                <div class="coupon_area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code left">
                                <h3>{{__('coupon.coupon')}}</h3>
                                <div class="coupon_inner">
                                    <p>{{__('coupon.coupon_description')}}</p>
                                    <input placeholder="{{__('coupon.coupon_code')}}" type="text">
                                    <button type="submit">{{__('coupon.apply_coupon')}}</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="coupon_code right">
                                <h3>{{__('cart.price')}}</h3>
                                <div class="coupon_inner">
                                    <div class="cart_subtotal">
                                        <p>{{__('order.order_subtotal')}}</p>
                                        <p class="cart_amount" id="subtotalBox">￥ 0</p>
                                    </div>
                                    <div class="cart_subtotal ">
                                        <p>{{__('order.shipping')}}</p>
                                        <p class="cart_amount" id="shippingBox"><span>Flat Rate:</span> ￥ 0</p>
                                    </div>
                                    <a href="#">Calculate shipping</a>

                                    <div class="cart_subtotal">
                                        <p>{{__('order.total')}}</p>
                                        <p class="cart_amount" id="totalBox">￥ 0</p>
                                    </div>
                                    <div class="checkout_btn">
                                        {{--                                        <a href="#">Proceed to Checkout</a>--}}
                                        @if(count($carts)>=1)
                                            <a id="create_order" type="button"
                                               href="javascript:void(0);">{{__('review.submit')}}</a>
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

            //全选checkbox
            $('.select_all').click(function () {
                let status = $(this).prop('checked');
                let checkbox = $('input[type=checkbox][class=checkbox]:not("disabled")');
                let total = 0;
                // let item = [];
                checkbox.each(function () {
                    $(this).prop('checked', status);
                    // let price = $(this).closest('tr').data('price');
                    // let quantity = $(this).closest('tr').data('quantity');
                    // item.push({
                    //     'price': price,
                    //     'quantity': quantity
                    // });
                });
                let totalPrice = getTotalPrice();
                setPriceBox(totalPrice);

            });

            $('input[type=checkbox]').on('change', function () {
                let totalPrice = getTotalPrice();
                setPriceBox(totalPrice);
            });


            $('#create_order').click(function () {
                let res = {

                    items: [],
                    address_id: $('select[name=address_id]').val(),
                    remark: '123',
                };

                $('tr[data-id]').each(function () {
                    //没有选中则跳出
                    let checkbox = $(this).find('input[type=checkbox][class=checkbox]');
                    if (checkbox.prop('disabled') || !checkbox.prop('checked')) {
                        return;
                    }
                    let quantity = $(this).find('input[name=quantity]').val();

                    //buy quantity return if illegal
                    if (quantity <= 0 || isNaN(quantity)) {
                        return;
                    }

                    res.items.push({
                        'quantity': quantity,
                        'sku_id': $(this).data('id')
                    });
                });

                axios.post('{{route('orders.store')}}', res).then(function (res) {
                    if (res.data.errno === 0) {
                        location.href = "{{route('center.order.index')}}";
                    } else {
                        if (res.data.message) {
                            swal.fire('error', res.data.message, 'error');
                        } else {
                            swal.fire('error', '{{__('sweetalert.error')}}', 'error');
                        }
                    }
                }, function (err) {
                    if (err.response.status === 422) {
                        let res = '<div>';
                        $.each(err.response.data.errors, function (index, item) {
                            $.each(item, function (key, message) {
                                res += '<div>' + message + '</div>';
                            });
                        });
                        res += '</div>';
                        swal.fire('error', res, 'error')
                    } else {
                        swal.fire('error', '{{__('sweetalert.error_internal_server')}}', 'error')

                    }
                });

            });

            /**
             * 计算所有选中的商品价格
             * @returns {number}
             */
            function getTotalPrice() {
                let totalPrice = 0;
                $('tr[data-id]').find('input[type=checkbox]:checked').each(function () {
                    totalPrice += parseFloat($(this).closest('tr').data('price') * $(this).closest('tr').data('quantity'));
                })
                return totalPrice;
            }

            function setPriceBox(subtotal = 0, shipping = 0, coupon = 0) {
                $('#subtotalBox').html('￥' + subtotal.toFixed(2));
                $('#shippingBox').html('￥' + shipping);
                $('#totalBox').html('￥' + subtotal.toFixed(2))
            }
        });
    </script>
@endsection
