<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders=$request->user()->orders()->orderBy('created_at','desc')->get();
        return view('center.orders.order',[
            'orders'=>$orders
        ]);
    }
}
