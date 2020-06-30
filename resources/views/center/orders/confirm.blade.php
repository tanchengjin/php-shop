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

                                <div class="col-lg-6 mb-20">
                                    <label>First Name <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>Last Name <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Company Name</label>
                                    <input type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="country">country <span>*</span></label>
                                    <select class="select_option" name="cuntry" id="country">
                                        <option value="2">bangladesh</option>
                                        <option value="3">Algeria</option>
                                        <option value="4">Afghanistan</option>
                                        <option value="5">Ghana</option>
                                        <option value="6">Albania</option>
                                        <option value="7">Bahrain</option>
                                        <option value="8">Colombia</option>
                                        <option value="9">Dominican Republic</option>

                                    </select>
                                </div>

                                <div class="col-12 mb-20">
                                    <label>Street address <span>*</span></label>
                                    <input placeholder="House number and street name" type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Town / City <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="col-12 mb-20">
                                    <label>State / County <span>*</span></label>
                                    <input type="text">
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label>Phone<span>*</span></label>
                                    <input type="text">

                                </div>
                                <div class="col-lg-6 mb-20">
                                    <label> Email Address <span>*</span></label>
                                    <input type="text">

                                </div>
                                <div class="col-12 mb-20">
                                    <input id="account" type="checkbox" data-target="createp_account"/>
                                    <label for="account" data-toggle="collapse" data-target="#collapseOne"
                                           aria-controls="collapseOne">Create an account?</label>

                                    <div id="collapseOne" class="collapse one" data-parent="#accordion">
                                        <div class="card-body1">
                                            <label> Account password <span>*</span></label>
                                            <input placeholder="password" type="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <input id="address" type="checkbox" data-target="createp_account"/>
                                    <label class="righ_0" for="address" data-toggle="collapse"
                                           data-target="#collapsetwo" aria-controls="collapseOne">Ship to a different
                                        address?</label>

                                    <div id="collapsetwo" class="collapse one" data-parent="#accordion">
                                        <div class="row">
                                            <div class="col-lg-6 mb-20">
                                                <label>First Name <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label>Last Name <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label>Company Name</label>
                                                <input type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="select_form_select">
                                                    <label for="countru_name">country <span>*</span></label>
                                                    <select class="select_option" name="cuntry" id="countru_name">
                                                        <option value="2">bangladesh</option>
                                                        <option value="3">Algeria</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Ghana</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Bahrain</option>
                                                        <option value="8">Colombia</option>
                                                        <option value="9">Dominican Republic</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-20">
                                                <label>Street address <span>*</span></label>
                                                <input placeholder="House number and street name" type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <input placeholder="Apartment, suite, unit etc. (optional)" type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label>Town / City <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="col-12 mb-20">
                                                <label>State / County <span>*</span></label>
                                                <input type="text">
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <label>Phone<span>*</span></label>
                                                <input type="text">

                                            </div>
                                            <div class="col-lg-6">
                                                <label> Email Address <span>*</span></label>
                                                <input type="text">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="order-notes">
                                        <label for="order_note">Order Notes</label>
                                        <textarea id="order_note"
                                                  placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
                                            <td>{{$item->product->title}} {{$item->sku->title}}<strong> × {{$item->quantity}}</strong></td>
                                            <td> ￥{{$item->price}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>{{__('order.order_subtotal')}}</th>
                                        <td>￥ {{number_format($order->total_price)}}</td>
                                    </tr>
                                    <tr>
                                        <th>{{__('order.shipping')}}</th>
                                        <td><strong>￥0</strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>{{__('order.order_total')}}</th>
                                        <td><strong>￥{{number_format($order->total_price)}}</strong></td>
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
                                    <button type="submit">{{__('order.alipay')}}</button>
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
