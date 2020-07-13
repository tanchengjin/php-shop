<?php

function hashids($str, $connect)
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connect)->encode($str);
}

function hashids_id($str)
{
    return hashids($str, 'id');
}

function toDateString($date)
{
   return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$date)->toFormattedDateString();
}
