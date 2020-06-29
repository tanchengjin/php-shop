<?php

namespace App\Http\Requests;

use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => ['required', 'integer'],
            'remark' => 'required',
            'items' => ['required', 'array'],
            'items.*.sku_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if (!$sku = ProductSku::find($value)) {
                    return $fail('商品不存在');
                }

                if (!$sku->product->on_sale) {
                    return $fail('商品已下架');
                }

                if ($sku->stock === 0) {
                    return $fail('商品库已售空');
                }
                //获取当前索引
                preg_match('/\d+/', $attribute, $m);
                $quantity = $this->input('items.' . $m[0] . '.quantity');
                if ($quantity > 0 && $quantity > $sku->stock) {
                    return $fail('商品库存不足');
                }
            }],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }
}
