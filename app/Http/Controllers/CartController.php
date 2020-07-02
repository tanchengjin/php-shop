<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Librarys\API;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use API;

    public function store(AddCartRequest $request, CartService $cartService)
    {
        if ($cartService->add($request->user(), $request->input('sku_id'), $request->input('quantity'))) {
            return $this->success();
        }
        return $this->error();
    }

    public function index(Request $request)
    {

        $carts = $request->user()->carts()->get();
        return view('carts.index', [
            'carts'=>$carts,
            'addresses'=>$request->user()->addresses
        ]);
    }
}
