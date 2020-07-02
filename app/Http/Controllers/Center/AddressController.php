<?php

namespace App\Http\Controllers\Center;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Librarys\API;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    use API;

    public function index(Request $request)
    {
        $addresses = $request->user()->addresses;
        return view('center.addresses.index', [
            'addresses' => $addresses
        ]);
    }

    public function create()
    {
        return view('center.addresses.edit_and_add', [
            'address' => new Address(),
        ]);
    }

    public function edit(Address $address, Request $request)
    {
        $this->authorize('own', $address);
        return view('center.addresses.edit_and_add', [
            'address' => $address
        ]);
    }


    public function store(AddressRequest $request)
    {
        try {
            $request->user()->addresses()->create($request->only([
                'province', 'city', 'district', 'contact_name', 'contact_phone', 'zip', 'address'
            ]));
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return back()->withErrors('操作失败，请重试!')->withInput();
        }
        return redirect()->route('center.address.index');
    }

    public function update(Address $address, AddressRequest $request)
    {
        $this->authorize('own', $address);
        $address->update($request->only([
            'province', 'city', 'district', 'contact_name', 'contact_phone', 'zip', 'address'
        ]));
        return redirect()->route('center.address.index');
    }

    public function destroy(Address $address, Request $request)
    {
        $this->authorize('own', $address);
        $address->delete();
        return $this->success();
    }
}
