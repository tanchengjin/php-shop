<?php

function hashid($connect='id'){
    return \Vinkla\Hashids\Facades\Hashids::connection($connect);
}

function hashids($str, $connect)
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connect)->encode($str);
}

function hashids_id($str)
{
    return hashids($str, 'id');
}

function hashids_id_decode($str){
    try{
        return hashid()->decode($str)[0];
    }catch (\Exception $exception){
        throw new \App\Exceptions\NotFoundException();
    }
}

function toDateString($date)
{
   return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$date)->toFormattedDateString();
}
