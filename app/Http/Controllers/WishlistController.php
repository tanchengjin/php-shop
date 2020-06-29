<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        $wishlists = $request->user()->wishlist()->with(['sku', 'sku.product'])->get();
        return view('center.wishlist.index', [
            'wishlists' => $wishlists
        ]);
    }

    public function store(WishlistRequest $request)
    {
        $wishlist = $request->user()->wishlist()->create([
            'product_sku_id' => $request->input('id')
        ]);
    }
}
