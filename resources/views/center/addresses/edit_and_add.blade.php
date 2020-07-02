@extends('center.main')
@section('tab')
    <div>
        <div class="card">
            <div class="card-header">
                {{$address->id?'编辑':'新增'}}地址
            </div>
            <div class="card-body" id="app">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <h4>error</h4>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <user-address-create-and-edit inline-template>
                    @if($address->id)
                        <form action="{{route('center.address.update',$address->id)}}" role="form" method="post">
                            {{ method_field('PUT') }}
                            @else
                                <form action="{{route('center.address.store')}}" role="form" method="post">
                                    @endif
                                    {{csrf_field()}}
                                    <select-address inline-template @change="setAddress">
                                        <div class="form-group row">
                                            <label for="/" class="col-2 col-form-label text-right">省市区</label>
                                            <div class="col-3">
                                                <select name="province" id="province" class="form-control"
                                                        v-model="provinceId">
                                                    <option value="">请选择省</option>
                                                    <option v-for="(name,id) in provinces" :value="id">@{{ name }}
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-3">
                                                <select name="city" id="city" class="form-control" v-model="cityId">
                                                    <option value="">请选择市</option>
                                                    <option v-for="(name,id) in cities" :value="id">@{{ name }}</option>
                                                </select>
                                            </div>

                                            <div class="col-3">
                                                <select name="district" id="district" class="form-control"
                                                        v-model="districtId">
                                                    <option value="">请选择区</option>
                                                    <option v-for="(name,id) in districts" :value="id">@{{ name }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </select-address>

                                    <div class="form-group row">
                                        <label for="address" class="col-2 col-form-label text-right">详细地址</label>
                                        <div class="col-9">
                                            <input type="text" name="address" class="form-control" id="address"
                                                   value="{{$address->address??''}}">
                                        </div>
                                    </div>

                                    <input type="hidden" v-model="province" name="province">
                                    <input type="hidden" v-model="city" name="city">
                                    <input type="hidden" v-model="district" name="district">

                                    <div class="form-group row">
                                        <label for="contact_name" class="col-2 col-form-label text-right">联系人</label>
                                        <div class="col-9">
                                            <input type="text" name="contact_name" class="form-control"
                                                   id="contact_name"
                                                   value="{{$address->contact_name??''}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contact_phone" class="col-2 col-form-label text-right">联系电话</label>
                                        <div class="col-9">
                                            <input type="text" name="contact_phone" class="form-control"
                                                   id="contact_phone"
                                                   value="{{$address->contact_phone??''}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="zip" class="col-2 col-form-label text-right">邮编</label>
                                        <div class="col-9">
                                            <input type="text" name="zip" class="form-control" id="zip"
                                                   value="{{$address->zip??''}}">
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary" type="submit">提交</button>
                                        </div>
                                    </div>

                                </form>

                </user-address-create-and-edit>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        const vue = new Vue({
            'el': '#app',
        });
    </script>
@endsection

