@extends('main')
@section('breadcrumb_title',__('website.personal_center'))
@section('content')
    <!-- my account start  -->
    <section class="main_content_area" id="app">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="{{route('center.index')}}" class="nav-link {{url()->current() == route('center.index')?'active':''}}">{{__('website.dashboard')}}</a></li>
                                <li> <a href="{{route('center.order.index')}}" class="nav-link {{url()->current() == route('center.order.index')?'active':''}}">{{__('website.my_order')}}</a></li>
                                <li><a href="{{route('center.address.index')}}" class="nav-link {{url()->current() == route('center.address.index')?'active':''}}">{{__('website.address')}}</a></li>
                                <li><a href="#account-details" class="nav-link">{{__('website.message')}}</a></li>
                                <li>
                                    <a href="{{route('logout')}}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('website.logout')}}</a>
                                    <form action="{{route('logout')}}" method="post" id="logout-form">
                                        {{csrf_field()}}

                                    </form>
                                </li>
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
