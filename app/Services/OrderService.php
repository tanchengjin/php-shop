<?php


namespace App\Services;


use App\Jobs\CloseOrder;
use App\Models\Order;
use App\Models\ProductSku;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
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
                    $sku->subtractStock($item['quantity']);
                    $totalPrice += ($sku->price * $item['quantity']);
                }
                $order->update([
                    'total_price' => $totalPrice
                ]);

                dispatch(new CloseOrder($order));
                $ids = collect($order->items)->pluck('product_sku_id')->all();
                (new CartService())->remove($ids);
            });
            return true;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }
}
