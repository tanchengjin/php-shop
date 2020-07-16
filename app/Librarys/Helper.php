<?php

function hashid($connect = 'id')
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connect);
}

function hashids($str, $connect)
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connect)->encode($str);
}

#普通id加密
function hashids_id($str)
{
    return hashids($str, 'id');
}

#普通id解密
function hashids_id_decode($str)
{
    try {
        return hashid()->decode($str)[0];
    } catch (\Exception $exception) {
        throw new \App\Exceptions\NotFoundException();
    }
}

#order and order item id
function hashids_order_id($str)
{
    return hashids($str, 'order_id');
}

#order and order item id
function hashids_order_id_decode($str)
{
    try {
        $decode = hashid('order_id')->decode($str);
        if (isset($decode[0])) {
            return $decode[0];
        }
    } catch (\Exception $exception) {

    }
    throw new \App\Exceptions\NotFoundException();
}


function toDateString($date)
{
    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toFormattedDateString();
}
