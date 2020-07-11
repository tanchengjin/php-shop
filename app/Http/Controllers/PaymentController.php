<?php

namespace App\Http\Controllers;

use App\Events\Paid;
use App\Exceptions\NotFoundException;
use App\Librarys\API;
use App\Models\Order;
use Carbon\Carbon;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Yansongda\Supports\Log;

class PaymentController extends Controller
{
    use API;

    public function alipay(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        if ($order->closed || $order->paid_at) {
            throw new NotFoundException('订单状态不正确!');
        }
        //队列没有正常启动，判断逻辑
        if (Carbon::now()->gt($order->created_at->addSecond(config('shop.order_ttl')))) {
            throw new NotFoundException('该订单已过期');
        }
        $order = [
            'out_trade_no' => $order->no,
            'total_amount' => $order->total_price,
            'subject' => '支付订单 ' . $order->no
        ];
        return app('alipay')->web($order);
    }

    /**
     * 支付宝 server 回调
     * @return string
     */
    public function alipayNotify()
    {
        try {
            $data = app('alipay')->verify();

            if (!in_array($data->trade_status, ['TRADE_FINISHED', 'TRADE_SUCCESS'])) {
                Log::error('finish or success error');
                return 'error';

            }
            if (!$order = Order::where('no', $data->out_trade_no)->first()) {
                Log::error('order no not found', $data->all());
                return 'error';
            }


            if ($order->paid_at) {
                return app('alipay')->success();
            }
            $order->update([
                'payment_no' => $data->trade_no,
//                'paid_price' => $data->total_amount,
                'payment_method' => 'alipay',
                'paid_at' => Carbon::now(),
            ]);

            $this->eventPaid($order);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return 'error';
        }
        return app('alipay')->success();
    }

    /**
     * 支付宝前端回调
     * @param Request $request
     */
    public function alipayReturn(Request $request)
    {
        $data = app('alipay')->verify();

        return view('common.success', [
            'data' => $data
        ]);
    }

    #退款逻辑
    public function refund(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        $this->refundValidate($order);

        $user = $request->user();

        if (!$reason = $request->get('reason')) {
            throw new NotFoundException('请输入退款理由');
        }
        try {
            #判断支付类型，运行对应的退款方式
            switch ($order->payment_method) {
                case Order::PAYMENT_ALIPAY:
                    $extra = $order->extra ?? [];
                    $extra['refund_reason'] = $reason;
                    $order->update([
                        'refund_status' => Order::REFUND_STATUS_APPLIED,
                        'extra' => $extra
                    ]);
                    break;
                case Order::PAYMENT_WECHAT:
                    //TODO
                default:
                    break;
            }
        } catch (\Exception $exception) {
            \Illuminate\Support\Facades\Log::error($exception->getMessage());
            return $this->error();
        }
        return $this->success();
    }


    private function refundValidate(Order $order)
    {
        if (!$order->paid_at) {
            throw new NotFoundException('该订单未支付!');
        }

        if (!in_array($order->payment_method, array_keys(Order::$PaymentMap))) {
            throw new NotFoundException('订单状态异常!');
        }

        if ($order->refund_status !== 'pending') {
            throw new NotFoundException('已发起退款，不可重复退款!');
        }
    }

    public function eventPaid(Order $order)
    {
        event(new Paid($order));
    }

}
