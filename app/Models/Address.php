<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'province', 'city', 'district', 'zip', 'address', 'contact_name', 'contact_phone',
    ];

    public function getFullAddressAttribute()
    {;
        return $this->province . $this->city . $this->district . $this->address;
    }
}
