<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', function ($attribute, $value, $fail) {
                if (!$sku = ProductSku::find($value)) {
                    return $fail('商品不存在');
                }

                if (!$sku->product->on_sale) {
                    return $fail('商品已下架');
                }
            }]
        ];
    }
}
