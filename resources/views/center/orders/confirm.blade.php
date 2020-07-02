@extends('main')
@section('content')
    <!--Checkout page section-->
    <div class="Checkout_section mt-70">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="user-actions">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login"
                               aria-expanded="true">Click here to login</a>

                        </h3>
                        <div id="checkout_login" class="collapse" data-parent="#accordion">
                            <div class="checkout_info">
                                <p>If you have shopped with us before, please enter your details in the boxes below. If
                                    you are a new customer please proceed to the Billing & Shipping section.</p>
                                <form action="#">
                                    <div class="form_group">
                                        <label>Username or email <span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="form_group">
                                        <label>Password <span>*</span></label>
                                        <input type="text">
                                    </div>
                                    <div class="form_group group_3 ">
                                        <button type="submit">Login</button>
                                        <label for="remember_box">
                                            <input id="remember_box" type="checkbox">
                                            <span> Remember me </span>
                                        </label>
                                    </div>
                                    <a href="#">Lost your password?</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="user-actions">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            Returning customer?
                            <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon"
                               aria-expanded="true">Click here to enter your code</a>

                        </h3>
                        <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                            <div class="checkout_info coupon_info">
                                <form action="#">
                                    <input placeholder="Coupon code" type="text">
                                    <button type="submit">Apply coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="checkout_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>Billing Details</h3>
                            <div class="row">

                                <div class="col-lg-12 mb-20">
                                    <label>{{__('website.address_contact_name')}}</label>
                                    <input type="text" disabled value="{{$order->address['contact_name']}}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>{{__('website.address_contact_phone')}}</label>
                                    <input type="text" disabled value="{{$order->address['contact_phone']}}">
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="country">{{__('website.address')}}</label>
                                    <select class="select_option" name="cuntry" id="country" disabled>
                                        <option value="">{{$order->address['address']}}</option>
                                    </select>
                                </div>


                                <div class="col-12">
                                    <div class="">
                                        <label for="order_note">{{__('order.order_remark')}}</label>
                                        <textarea  style="resize:none" id="order_note" class="form-control" disabled>{{$order->remark}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <form action="#">
                            <h3>{{__('order.your_order')}}</h3>
                            <div class="order_table table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>{{__('order.product')}}</th>
                                        <th>{{__('order.total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{$item->product->title}} {{$item->sku->title}}<strong>
                                                    × {{$item->quantity}}</strong></td>
                                            <td> ￥{{$item->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('order.order_subtotal')}}</th>
                                        <td>￥ {{number_format($order->total_price,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('order.shipping')}}</th>
                                        <td><strong>￥0</strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>{{__('order.order_total')}}</th>
                                        <td><strong>￥{{number_format($order->total_price,2)}}</strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment_method">
                                <div class="panel-default">
                                    <input id="payment" name="check_method" type="radio" data-target="createp_account"/>
                                    <label for="payment" data-toggle="collapse" data-target="#method"
                                           aria-controls="method">Create an account?</label>

                                    <div id="method" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State
                                                / County, Store Postcode.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-default">
                                    <input id="payment_defult" name="check_method" type="radio"
                                           data-target="createp_account"/>
                                    <label for="payment_defult" data-toggle="collapse" data-target="#collapsedefult"
                                           aria-controls="collapsedefult">PayPal <img src="/assets/img/icon/papyel.png"
                                                                                      alt=""></label>

                                    <div id="collapsedefult" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="order_button">
                                    <button class="to_pay">
                                        <a href="{{route('orders.payment.alipay',['order'=>$order->id])}}"
                                           target="_blank">{{__('order.alipay')}}</a>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout page section end-->
@endsection

@section('javascript')
    <script>
        $('.to_pay').on('click', function () {
            swal.fire({
                title: '是否支付成功?',
                icon: "question",
                confirmButtonText: '已支付',
                showCancelButton: true,
                cancelButtonText: '未支付',
                preConfirm(inputValue) {
                    if (inputValue) {
                        location.href = "{{route('center.order.index')}}"
                    }
                }
            });
        });
    </script>
@endsection
