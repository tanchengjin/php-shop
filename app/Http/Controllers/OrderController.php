<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\OrderRequest;
use App\Librarys\API;
use App\Models\Address;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use API;

    public function store(OrderRequest $request, OrderService $orderService)
    {
        if ($orderService->store($request->user(), Address::find($request->input('address_id')), $request->input('items'), $request->input('remark'))) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function confirm($id, Request $request)
    {
        if (!$order = Order::find($id)) {
            throw new NotFoundException('不存在的订单');
        }

        if ($order->closed) {
            throw new NotFoundException('该订单已关闭');
        }

        if ($order->paid_at) {
            throw new NotFoundException('订单已支付');
        }


        return view('center.orders.confirm', [
            'order' => $order
        ]);
    }

    public function received(Order $order)
    {
        if (!$order->paid_at) {
            throw new NotFoundException('该订单未支付');
        }

        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new NotFoundException('该订单未发货');
        }
        $order->update([
            'ship_status' => Order::SHIP_STATUS_RECEIVED
        ]);
        return $this->success();
    }
}
