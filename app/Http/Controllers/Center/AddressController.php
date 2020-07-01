<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $addresses=$request->user()->addresses;
        return view('center.addresses.index',[
            'addresses'=>$addresses
        ]);
    }
}
