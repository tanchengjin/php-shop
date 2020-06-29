<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Librarys\API;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use API;
    public function store(OrderRequest $request, OrderService $orderService)
    {
        if($orderService->store($request->user(), $request->input('address_id'), $request->input('items'), $request->input('remark'))){
            return $this->success();
        }else{
            return $this->error();
        }
    }
}
