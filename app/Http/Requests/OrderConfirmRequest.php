<?php

namespace App\Http\Requests;

use App\Exceptions\NotFoundException;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class OrderConfirmRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['required', function ($attribute, $id, $fail) {
                if (!$order = Order::find($id)) {
                    throw new NotFoundException('不存在的订单');
                }

                if ($order->closed) {
                    throw new NotFoundException('该订单已关闭');
                }
            }],
        ];
    }
}
