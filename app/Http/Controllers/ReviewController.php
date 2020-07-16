<?php

namespace App\Http\Controllers;

use App\Events\Reviewed;
use App\Exceptions\NotFoundException;
use App\Http\Requests\ReviewRequest;
use App\Models\OrderItem;
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
        $this->authorize($item->order);


        return view('review.index', [
            'item' => $item
        ]);

    }

    public function store($id, ReviewRequest $request)
    {
        try {
            $id = hashids_order_id_decode($id);

            $orderItem = OrderItem::findOrFail($id);

            if (!$orderItem->order->paid_at) {
                throw new NotFoundException('未支付订单');
            }
            $this->authorize($orderItem->order);

            $review = $request->input('review');
            $rating = $request->input('rating');

            DB::transaction(function () use ($orderItem, $review, $rating) {
                $orderItem->update([
                    'review' => $review,
                    'rating' => $rating
                ]);

                $orderItem->order->update([
                    'reviewed' => true
                ]);
            });
            event(new Reviewed($orderItem));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new NotFoundException('评论失败,请重试!');
        }
        return redirect()->back();
    }
}
