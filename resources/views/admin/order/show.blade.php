<div class="box box-info">
    <div class="box-header">
        <div class="box-title">订单号: {{$order->no}}</div>
        <div class="box-tools"><a href="{{url('/admin/orders')}}">返回订单</a></div>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td>订单状态</td>
                <td colspan="3">{{$order->orderStatus}}</td>
            </tr>
            @if($order->refund_status === \App\Models\Order::REFUND_STATUS_APPLIED)
                <tr>
                    <td>退款理由</td>
                    <td colspan="3">{{$order->extra['refund_reason']??''}}</td>
                </tr>
            @endif
            <tr>
                <td>买家</td>
                <td>{{$order->user->name}}</td>
                <td>支付时间</td>
                <td>{{$order->paid_at}}</td>
            </tr>

            <tr>
                <td>收货地址</td>
                <td colspan="3">{{join($order->address)}}</td>
            </tr>
            @if($order->paid_at && isset($order->payment_method))
                <tr>
                    <td>支付平台</td>
                    <td>{{\App\Models\Order::$PaymentMap[$order->payment_method]}}</td>
                    <td>支付支付号</td>
                    <td>{{$order->payment_no}}</td>
                </tr>
            @endif
            <tr>
                <td rowspan="{{count($order->items)+1}}">商品列表</td>
                <td>商品信息</td>
                <td>购买数量</td>
                <td>价格</td>
            </tr>
            @foreach($order->items as $item)
                <tr>
                    <td>{{$item->product->title}} {{$item->sku->title}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price}}</td>
                </tr>
            @endforeach
            <tr>
                <td>订单总价</td>
                <td colspan="3">￥{{number_format($order->total_price,2)}}</td>
            </tr>
            @if($order->paid_at)
                @if($order->refund_status === \App\Models\Order::REFUND_STATUS_PENDING)
                    <tr>
                        <td>物流操作</td>
                        <td colspan="3">
                            <form action="{{url('admin/order/ship/'.$order->id)}}" class="form-inline"
                                  method="post">
                                {{csrf_field()}}
                                <div class="form-group @if($errors->has('ship_company')) has-error @endif">
                                    <label for="ship_company" class="control-label">物流公司</label>
                                    <input type="text" id="ship_company" class="form-control" name="ship_company">
                                    @if($errors->has('ship_company'))
                                        @foreach($errors->get('ship_company') as $message)
                                            <span class="help-block">{{$message}}</span>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group @if($errors->has('ship_company')) has-error @endif">
                                    <label for="ship_no" class="control-label">物流单号</label>
                                    <input type="text" id="ship_no" class="form-control" name="ship_no">
                                    @if($errors->has('ship_no'))
                                        @foreach($errors->get('ship_no') as $message)
                                            <span class="help-block">{{$message}}</span>
                                        @endforeach
                                    @endif
                                </div>

                                <button class="btn btn-primary">发货</button>

                            </form>
                        </td>
                    </tr>
                @endif
            @endif
            @if($order->refund_status === \App\Models\Order::REFUND_STATUS_APPLIED)
                <tr>
                    <td>退款操作</td>
                    <td colspan="3">
                        <div class="form-inline">
                            <button class="btn btn-primary" id="agree">同意</button>
                            <button class="btn btn-danger" id="disagree">拒绝</button>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#agree').click(function () {
            $.ajax({
                url: '{{url('admin/orders/refund/'.$order->id)}}',
                method: 'post',
                data: JSON.stringify({
                    agree: true,
                    '_token': '{{csrf_token()}}'
                }),
                contentType: 'application/json',
                success: function () {
                    window.location.reload();
                },
                error: function (err) {
                    return swal.fire('error', '', 'error');
                }
            })
        });

        $('#disagree').click(function () {
            swal.fire({
                title: '请输入拒绝退款理由',
                input: 'text',
                showCancelButton: true,
                preConfirm: function (val) {
                    if (!val) {
                        return swal.fire('error', '请输入拒绝退款理由!', 'error');
                    }

                    $.ajax({
                        'url': '{{url('admin/orders/refund/'.$order->id)}}',
                        method: 'post',
                        data: JSON.stringify({
                            reason: val,
                            agree: false,
                            _token: '{{csrf_token()}}',

                        }),
                        contentType: 'application/json',
                        success: function (res) {
                            if(res.data.errno === 0){
                                window.location.reload();
                            }else{
                                swal.fire('error',res.data.message,'error');
                            }
                        },
                        error: function (error) {
                            swal.fire('error', '', 'error')
                        }

                    });
                }
            });
        });
    });
</script>
