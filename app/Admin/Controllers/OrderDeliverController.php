<?php

namespace App\Admin\Controllers;

use App\Exceptions\NotFoundException;
use App\Http\Requests\Admin\HandleRefundRequest;
use App\Http\Requests\Admin\ShipRequest;
use App\Jobs\AutoShip;
use App\Librarys\API;
use App\Models\Order;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderDeliverController extends AdminController
{
    use ValidatesRequests, API;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Order';

    public function index(Content $content)
    {
        return $content->title('代发货订单')->body($this->grid());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order());
        $grid->model()->orderBy('id', 'desc')->whereNotNull('paid_at')->where('ship_status', Order::SHIP_STATUS_PENDING);
        $grid->disableCreateButton();
        $grid->actions(function ($tools) {
            $tools->disableDelete();
            $tools->disableEdit();
        });
        $grid->column('id', __('Id'));
        $grid->column('no', __('No'));
        $grid->column('user.name', __('用户'));
        $grid->column('total_price', __('订单金额'));
        $grid->column('payment_no', __('支付订单号'));
        $grid->column('paid_at', __('支付时间'))->display(function ($paid) {
            if ($paid) {
                return date('Y-m-d H:i:s', strtotime($paid));
            }
        });
        $grid->column('reviewed', __('REVIEWED'));
        $grid->column('order_status', __('订单状态'))->display(function ($res) {
            if ($this->paid_at) {
                if ($this->refund_status === Order::REFUND_STATUS_APPLIED) {
                    return '<span class="label label-danger">退款中</span>';
                }

                if ($this->refund_status === Order::REFUND_STATUS_SUCCESS) {
                    return '<span class="label label-success">退款成功</span>';
                }

                if ($this->ship_status === Order::SHIP_STATUS_PENDING) {
                    return '<span class="label label-warning">待发货</span>';
                }

                if ($this->ship_status === Order::SHIP_STATUS_DELIVERED) {
                    return '<span class="label label-warning">已发货</span>';
                }

                if ($this->ship_status === Order::SHIP_STATUS_RECEIVED) {
                    return '<span class="label label-success">已收货</span>';
                }

                return '<span class="label label-default">已支付</span>';
            } else {
                if ($this->closed) {
                    return '<span class="label label-default">已关闭</span>';
                }
                return '<span class="label label-default">未支付</span>';
            }
        });
        $grid->column('rating', __('Ratting'));

        return $grid;
    }

    /**
     * @param Order $order
     * @param Content $content
     * @return Content
     */
    public function show($order, Content $content)
    {
        $order = Order::query()->findOrFail($order);
        return $content->header('查看订单')->body(view('admin.order.show', [
            'order' => $order
        ]));
    }

    public function handleRefund(Order $order, HandleRefundRequest $request)
    {
        $this->orderValidate($order, 'refund');

        if ($request->input('agree')) {
            $extra = $order->extra ?? [];
            if (isset($extra['refund_disagree_reason'])) {
                unset($extra['refund_disagree_reason']);
            }

            $order->update([
                'extra' => $extra,
            ]);

            $this->_orderRefund($order);
        } else {
            $extra = $order->extra ?? [];
            $extra['refund_disagree_reason'] = $request->input('reason');
            $order->update([
                'refund_status' => Order::REFUND_STATUS_PENDING,
                'extra' => $extra
            ]);
        }
        return $this->success();
    }

    private function _orderRefund(Order $order)
    {
        switch ($order->payment_method) {
            case Order::PAYMENT_ALIPAY:
                $no = Order::getAvailableRefundNo();
                $result = app('alipay')->refund([
                    'out_trade_no' => $order->no,
                    'refund_amount' => $order->total_price,
                    'out_request_no' => $no,
                ]);

                if ($result->sub_code) {
                    Log::error($result);
                    $extra = $order->extra ?? [];
                    $extra['refund_failed_code'] = $result->sub_code;
                    $order->update([
                        'refund_no' => $no,
                        'refund_status' => Order::REFUND_STATUS_FAILED,
                        'extra' => $extra
                    ]);
                } else {
                    $order->update([
                        'refund_no' => $no,
                        'refund_status' => Order::REFUND_STATUS_SUCCESS
                    ]);
                }
                break;
            case Order::PAYMENT_WECHAT:
                break;
            default:
                break;
        }
    }

    public function ship(Order $order, Request $request)
    {
        $this->validate($request, [
            'ship_company' => ['required'],
            'ship_no' => ['required']
        ], [
            'ship_company.required' => '请填写物流公司',
            'ship_no.required' => '请填写物流单号'
        ]);

        $this->orderValidate($order, 'ship');

        $ship_company = $request->get('ship_company');
        $ship_no = $request->get('ship_no');

        $ship_data['ship_company'] = $ship_company;
        $ship_data['ship_no'] = $ship_no;
        $order->update([
            'ship_data' => $ship_data,
            'ship_status' => Order::SHIP_STATUS_DELIVERED
        ]);

        dispatch(new AutoShip($order));

        return redirect()->back();

    }

    /**
     * 校验订单支付状态是否正常，用于订单的退款与发货
     * @param Order $order
     * @param string $method refund or ship
     * @throws NotFoundException
     */
    private function orderValidate(Order $order, $method)
    {
        if (!$order->paid_at) {
            throw new NotFoundException('该订单未支付');
        }

        if (!in_array($order->payment_method, array_keys(Order::$PaymentMap))) {
            throw new NotFoundException('该订单支付异常');
        }

        if ($method === 'refund') {
            if ($order->refund_status !== Order::REFUND_STATUS_APPLIED) {
                throw new NotFoundException('该订单已发起退款');
            }
        }

        if ($method === 'ship') {
            if ($order->ship_status !== Order::SHIP_STATUS_PENDING) {
                throw new NotFoundException('该订单已发货，不可重复发货');
            }
        }
    }
}
