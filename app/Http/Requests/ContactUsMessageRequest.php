<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsMessageRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','min:1'],
            'email' => ['required','min:5','email'],
            'subject' => ['required','min:3'],
            'message' => ['required','min:9'],
        ];
    }
}
