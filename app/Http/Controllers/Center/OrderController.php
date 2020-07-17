<?php

namespace App\Http\Controllers\Center;

use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->orderBy('created_at', 'desc')->get();
        return view('center.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
        if (!$order = Order::find($id)) {
            throw new NotFoundException();
        }
        $this->authorize('own',$order);
        return view('center.orders.show', [
            'order' => $order
        ]);
    }


}
