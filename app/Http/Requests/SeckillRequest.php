<?php

namespace App\Http\Requests;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSku;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeckillRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => [
                'required',
                Rule::exists('addresses', 'id')->where('user_id', $this->user()->id)
            ],
            'sku_id' => ['required', function ($key, $value, $fail) {

                if (!$sku = ProductSku::find($value)) {
                    return $fail('商品不存在');
                }

                if ($sku->product->type !== Product::TYPE_SECKILL) {
                    return $fail('该商品不支持秒杀');
                }

                $seckill = $sku->product->seckill;
                if (!$seckill->isStart) {
                    return $fail('秒杀未开始!');
                }

                if ($seckill->isOver) {
                    return $fail('秒杀已结束!');
                }

                if (!$sku->product->on_sale) {
                    return $fail('商品已下架');
                }

                if ($sku->stock === 0) {
                    return $fail('商品已售完');
                }

                if ($this->request->get('quantity') > $sku->stock) {
                    return $fail('商品库存不足');
                }

                #限购数量
                $limit_num = $sku->product->seckill->quantity_limit;
                if ($this->request->get('quantity') > $limit_num) {
                    return $fail('超过本商品限购数量!');
                }

                #查看已购买订单，或购买为后付商品，不可大于限购数量
                $num = Order::query()->where('user_id', $this->user()->id)
                    ->whereHas('items', function ($query) use ($value) {
                        $query->where('product_sku_id', $value);
                    })->where(function ($query) {
                        $query->where('closed', 0)->orWhereNotNull('paid_at');
                    })->count();
                if ($num >= $limit_num) {
                    return $fail('已超过本商品限购数量!');
                }

            }],
            'quantity' => ['required', 'integer']
        ];
    }

    public function attributes()
    {
        return [
            'address_id' => '收货地址',
            'sku_id' => '商品',
            'quantity' => '购买数量'
        ];
    }
}
