@extends('center.main')
@section('tab')
    <div class="tab-pane fade show active" id="dashboard">
        <h3>Dashboard </h3>
        <p>From your account dashboard. you can easily check &amp; view your <a href="{{route('center.order.index')}}">recent orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a href="#">Edit your password and account details.</a></p>
    </div>
@endsection
