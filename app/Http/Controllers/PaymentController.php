<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Models\Order;
use App\Services\PaymentService;
use Carbon\Carbon;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;
use Yansongda\Supports\Log;

class PaymentController extends Controller
{
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
            if (!$order = Order::query()->where('no', $data->out_trade_no)->first()) {
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
    public function refund(Order $order, Request $request, PaymentService $paymentService)
    {
        $user = $request->user();
        #判断支付类型，运行对应的退款方式
        switch ($order->payment_method) {
            case Order::PAYMENT_ALIPAY:
                $paymentService->alipayRefund(100, $user);
            case Order::PAYMENT_WECHAT:
                //TODO
            default:
                break;
        }
    }

    private function refundValidate(Order $order)
    {
        if (!$order->paid_at) {
            throw new NotFoundException('该订单未支付');
        }

        if (!in_array($order->payment_method, array_keys(Order::$refundStatusMap))) {
            throw new NotFoundException('订单状态异常');
        }
    }

}
