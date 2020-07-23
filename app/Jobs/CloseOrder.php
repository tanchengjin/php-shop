<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\ProductSku;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CloseOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     * @param Order $order
     * @param int $ttl
     * @return void
     */
    public function __construct(Order $order, $ttl = null)
    {
        $this->order = $order;
        if (is_null($ttl)) {
            $ttl = config('shop.order_ttl');
        }
        $this->delay($ttl);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->order->load(['items']);
            DB::transaction(function () {
                foreach ($this->order->items as $item) {
                    $sku = ProductSku::find($item['product_sku_id']);
                    $sku->addStock($item['quantity']);
                }
                $this->order->update([
                    'closed' => 1
                ]);
            });
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
