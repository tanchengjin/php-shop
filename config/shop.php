<?php

return [
    //订单有效时间，单位秒,默认半小时
    'order_ttl' => env('ORDER_TTL', 1800),
    //自动收货时间，自发货后开始计算，单位秒，默认7天
    'ship_ttl' => env('SHIP_TTL', 25200),
    #秒杀订单有效期,默认15分钟
    'order_seckill_ttl' => env('SECKILL_TTL', 900)
];
