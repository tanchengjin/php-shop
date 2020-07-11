<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AutoShip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->delay(config('shop.ship_ttl'));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->order->ship_status === Order::SHIP_STATUS_DELIVERED) {
            try {
                $this->order->update([
                    'ship_status' => Order::SHIP_STATUS_RECEIVED
                ]);
            } catch (\Exception $exception) {
                Log::error($exception->getMessage());
            }
        } else {
            Log::error('order status error:' . $this->order->id);
        }
    }
}
