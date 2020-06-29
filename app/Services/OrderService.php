<?php


namespace App\Services;


use App\Models\Order;
use App\Models\ProductSku;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    private $order;

    public function store(User $user, int $address_id, array $items, string $remark)
    {
        try {
            DB::transaction(function () use ($user, $address_id, $items, $remark) {
                $order = new Order([
                    'remark' => $remark,
                    'address' => $address_id,
                    'total_price' => 0
                ]);

                $order->user()->associate($user);
                $order->save();
                $totalPrice = 0;
                foreach ($items as $item) {
                    $sku = ProductSku::find($item['sku_id']);
                    Log::error($sku);
                    $orderItem = $order->items()->make([
                        'price' => $sku->price,
                        'quantity' => $item['quantity'],
                    ]);
                    $orderItem->product()->associate($sku->product);
                    $orderItem->sku()->associate($sku);
                    $orderItem->save();
                    $totalPrice += ($sku->price * $item['quantity']);
                }
                $order->update([
                    'total_price' => $totalPrice
                ]);
                $this->order = $order;
            });
            return true;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }
}
