<?php

namespace App\Http\Controllers;

use App\Events\Reviewed;
use App\Exceptions\NotFoundException;
use App\Http\Requests\ReviewRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index($id)
    {
//        http://shop-fruit.com/order/43jxEYgLPQZOpnel5aKBzyVXvAWJ29Nl/review
        $id = hashids_order_id_decode($id);

        $item = OrderItem::findOrFail($id);
        $item->load(['product', 'sku', 'order']);


        if (!$item->order->paid_at) {
            throw new NotFoundException('未支付订单');
        }
        if ($item->order->ship_status !== Order::SHIP_STATUS_RECEIVED) {
            throw new NotFoundException('订单未收货');
        }
        if ($item->order->refund_status !== Order::REFUND_STATUS_PENDING) {
            throw new NotFoundException('退款订单不可评价');
        }
        $this->authorize('own', $item->order);


        return view('review.index', [
            'item' => $item
        ]);

    }

    public function store($id, ReviewRequest $request)
    {
        try {
            $id = hashids_order_id_decode($id);

            $orderItem = OrderItem::findOrFail($id);

            $this->authorize('own', $orderItem->order);

            if (!$orderItem->order->paid_at) {
                throw new NotFoundException('未支付订单');
            }
            if ($orderItem->order->ship_status !== Order::SHIP_STATUS_RECEIVED) {
                throw new NotFoundException('订单未收货');
            }
            if ($orderItem->order->refund_status !== Order::REFUND_STATUS_PENDING) {
                throw new NotFoundException('退款订单不可评价');
            }
            if (!is_null($orderItem->review)) {
                throw new NotFoundException('该订单已评论');
            }

            $review = $request->input('review');
            $rating = $request->input('rating');

            $orderItem->update([
                'review' => $review,
                'rating' => $rating,
                'reviewed_at' => Carbon::now()
            ]);

            event(new Reviewed($orderItem));

            $orderItem->order->update([
                'reviewed' => 1
            ]);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new NotFoundException('评论失败,请重试!');
        }

        return redirect()->back();
    }
}
