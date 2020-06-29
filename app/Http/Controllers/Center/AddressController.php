<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        return view('center.addresses.index');
    }
}
