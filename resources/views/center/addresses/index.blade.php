@extends('center.main')
@section('tab')
    <div id="address">
        <div class="row">
            <h3 class="col-5">{{__('website.my_order')}}</h3>
            <div class="col-7">
                <a href="{{route('center.address.create')}}"
                   class="btn btn-outline-primary float-right">{{__('website.add')}}</a>
            </div>
        </div>
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
                        <td>
                            <a href="{{route('center.address.edit',['address'=>$address->id])}}"
                               class="view">{{__('website.edit')}}</a>
                            <button type="button"
                                    class="view address_delete"
                                    data-id="{{$address->id}}">{{__('website.delete')}}</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function () {
            $('.address_delete').on('click', function () {
                let id = $(this).data('id');
                let ob = (this).closest('tr');
                swal.fire({
                    title: 'Delete ?',
                    icon: 'question',
                    showCancelButton: true,
                    preConfirm(inputValue) {
                        if (inputValue) {
                            axios.delete('/center/address/' + id).then(function () {
                                ob.remove();
                            }, function () {
                                swal.fire('error', '', 'error');
                            })
                        }
                    }
                })
            })
        });
    </script>
@endsection
