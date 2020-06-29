@extends('center.main')
@section('tab')
    <div id="orders">
        <h3>{{__('website.my_order')}}</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>{{__('website.order_no')}}</th>
                    <th>{{__('website.order_date')}}</th>
                    <th>{{__('website.order_status')}}</th>
                    <th>{{__('website.order_total')}}</th>
                    <th>{{__('website.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->no}}</td>
                        <td>{{$order->created_at}}</td>
                        <td><span class="success">Completed</span></td>
                        <td>￥{{number_format($order->total_price,2)}}</td>
                        <td><a href="cart.html" class="view">{{__('website.view')}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
