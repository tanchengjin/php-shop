<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Librarys\API;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use API;

    public function index(Request $request)
    {
        $wishlists = $request->user()->wishlist()->with(['product'])->get();
        return view('center.wishlist.index', [
            'wishlists' => $wishlists
        ]);
    }

    public function store(WishlistRequest $request)
    {
        if ($request->user()->wishlist()->create(['product_id' => $request->input('id')])) {
            return $this->success();
        } else {
            return $this->error();
        }
    }

    public function destroy($id, Request $request)
    {
        if ($wishlist = $request->user()->wishlist()->where(['product_id' => $id])->first()) {
            $wishlist->delete();
            return $this->success();
        } else {
            return $this->fail('操作失败请重试');
        }
    }
}
