<?php


namespace App\Services;


use App\Exceptions\NotFoundException;
use App\Jobs\CloseOrder;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSku;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService
{
    #普通订单创建
    public function store(User $user, Address $address, array $items, string $remark)
    {
        try {
            DB::transaction(function () use ($user, $address, $items, $remark) {
                $order = new Order([
                    'remark' => $remark,
                    'address' => [
                        'address' => $address->full_address,
                        'contact_name' => $address->contact_name,
                        'contact_phone' => $address->contact_phone,
                    ],
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

    #秒杀订单创建
    public function seckill(User $user, Address $address, ProductSku $sku, $quantity)
    {
        try {
            $order = DB::transaction(function () use ($user, $address, $sku, $quantity) {

                $order = new Order([
                    'address' => [
                        'address' => $address->full_address,
                        'zip' => $address->zip,
                        'contact_name' => $address->contact_name,
                        'contact_phone' => $address->contact_phone,
                    ],
                    'type' => Product::TYPE_SECKILL,
                    'total_price' => $sku->price * $quantity
                ]);
                $order->user()->associate($user);

                $order->save();
                $item = $order->items()->make([
                    'quantity' => $quantity,
                    'price' => $sku->price
                ]);

                $item->product()->associate($sku->product_id);
                $item->sku()->associate($sku);
                $item->save();

                if ($sku->subtractStock($quantity) <= 0) {
                    throw new NotFoundException('商品库存不足');
                }
                return $order;
            });

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }
        #队列延迟关闭订单
        dispatch(new CloseOrder($order, config('shop.order_seckill_ttl')));
        return $order;
    }
}
