<?php


namespace App\Services;


use App\User;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function store(User $user, int $address_id, array $items, string $remark)
    {
        DB::transaction(function () use ($user, $address_id, $items, $remark) {

        });
    }
}
