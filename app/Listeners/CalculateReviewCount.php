<?php

namespace App\Listeners;

use App\Events\Reviewed;
use App\Models\OrderItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateReviewCount implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Reviewed $event
     * @return void
     */
    public function handle(Reviewed $event)
    {
        try {
            $orderItem = $event->getOrderItem();

            DB::transaction(function () use ($orderItem) {
                $result = OrderItem::query()
                    ->where('product_id', $orderItem->product_id)
                    ->whereHas('order', function ($query) {
                        $query->whereNotNull('paid_at');
                    })
                    ->first([
                        DB::raw('count(quantity) as review_count'),
                        DB::raw('avg(rating) as rating')
                    ]);

                $orderItem->order()->update([
                    'review_count' => $result->review_count,
                    'rating' => $result->rating
                ]);
            });

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
