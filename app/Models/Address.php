<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'province', 'city', 'district', 'zip', 'address', 'contact_name', 'contact_phone',
    ];
}
