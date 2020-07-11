<?php

namespace App\Listeners;

use App\Events\Paid;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CalculateSale implements ShouldQueue
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
     * @param Paid $event
     * @return void
     */
    public function handle(Paid $event)
    {
        $order = $event->getOrder();

        foreach ($order->items as $item) {
            $product = $item->product;

            $sold_count = OrderItem::query()->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('paid_at');
                })->sum('quantity');

            $product->update([
                'sold_count' => $sold_count
            ]);
        }
    }
}
