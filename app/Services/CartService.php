<?php


namespace App\Services;


use App\Models\Cart;
use App\User;
use Illuminate\Support\Facades\Log;

class CartService
{
    public function add(User $user, int $sku_id, int $quantity)
    {
        try {
            if ($cart = $user->carts()->where('product_sku_id', $sku_id)->first()) {
                $cart->increment('quantity', $quantity);
            } else {
                #create shopping cart
                $cart = new Cart([
                    'quantity' => $quantity,
                ]);
                $cart->sku()->associate($sku_id);
                $cart->user()->associate($user);
                $cart->save();
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }
        return true;
    }

    public function remove($ids)
    {
        try {
            if (!is_array($ids)) {
                $ids = [$ids];
            }
            return Cart::query()->whereIn('id', $ids)->delete();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
        return false;
    }
}
