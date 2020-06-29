@extends('main')
@section('content')
    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="{{route('center.index')}}" class="nav-link {{url()->current() == route('center.index')?'active':''}}">{{__('website.dashboard')}}</a></li>
                                <li> <a href="{{route('center.order.index')}}" class="nav-link {{url()->current() == route('center.order.index')?'active':''}}">{{__('website.my_order')}}</a></li>
                                <li><a href="#downloads" data-toggle="tab" class="nav-link">Downloads</a></li>
                                <li><a href="{{route('center.address.index')}}" class="nav-link {{url()->current() == route('center.address.index')?'active':''}}">{{__('website.address')}}</a></li>
                                <li><a href="#account-details" data-toggle="tab" class="nav-link">Account details</a></li>
                                <li><a href="login.html" class="nav-link">{{__('website.logout')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            @yield('tab')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- my account end   -->
@endsection
