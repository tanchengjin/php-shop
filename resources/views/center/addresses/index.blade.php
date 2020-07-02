@extends('center.main')
@section('tab')
    <div id="address">
        <h3>{{__('website.my_order')}}</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>{{__('website.address_contact_name')}}</th>
                    <th>{{__('website.address_contact_phone')}}</th>
                    <th>{{__('website.address_detail')}}</th>
                    <th>{{__('website.action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>{{$address->contact_name}}</td>
                        <td>{{$address->contact_phone}}</td>
                        <td>{{$address->address}}</td>
                        <td><a href="{{route('center.order.show',['id'=>$address->id])}}"
                               class="view">{{__('website.view')}}</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
