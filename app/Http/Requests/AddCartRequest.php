<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

class AddCartRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku_id' => ['required', function ($attribute, $value, $fail) {
                if (!$sku = ProductSku::find($value)) {
                    return $fail('商品不存在');
                }

                if (!$sku->product->on_sale) {
                    return $fail('该商品已下架');
                }

                if ($sku->stock === 0) {
                    return $fail('商品已售空');
                }
                if ($this->input('quantity') > 0 && $sku->stock < $this->input('quantity')) {
                    return $fail('库存不足');
                }
            }],
            'quantity' => ['required', 'integer']
        ];
    }
}
