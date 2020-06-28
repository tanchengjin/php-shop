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
                    'product_sku_id' => $sku_id,
                    'quantity' => $quantity,
                ]);
                $cart->user()->associate($user);
                $cart->save();
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return false;
        }
        return true;
    }
}