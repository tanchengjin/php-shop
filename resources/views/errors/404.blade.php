@extends('main')
@section('content')
    <!--error section area start-->
    <div class="error_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="error_form">
                        <h1>404</h1>
                        <h2>{{__('website.page_not_found')}}</h2>
                        <p>{{__('website.page_not_found_content')}}<br>{{__('website.page_not_found_content_too')}}</p>
                        <form action="#">
                            <input placeholder="Search..." type="text">
                            <button type="submit"><i class="icon-search"></i></button>
                        </form>
                        <a href="{{route('products.index')}}">{{__('website.back_to_home')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--error section area end-->
@endsection
