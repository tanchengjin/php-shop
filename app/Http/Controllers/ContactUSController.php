<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsMessageRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactUSController extends Controller
{
    public function index(Request $request)
    {
        return view('contactUs.index');
    }

    public function store(ContactUsMessageRequest $request)
    {
        try {
            ContactUs::query()->create($request->only([
                'subject', 'name', 'email', 'message'
            ]));
        } catch (\Exception $exception) {
            Log::error('contact us message error:' . $exception->getMessage());
        }
        return redirect()->route('contactUs.index')->withInput([
            'status'=>true
        ]);
    }
}
