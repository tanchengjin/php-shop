<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'review' => ['required','min:1','max:255'],
            'rating' => ['required', 'between:1,5', 'integer'],
        ];
    }
}
