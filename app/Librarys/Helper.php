<?php

function hashids($str, $connect)
{
    return \Vinkla\Hashids\Facades\Hashids::connection($connect)->encode($str);
}

function hashids_id($str)
{
    return hashids($str, 'id');
}
