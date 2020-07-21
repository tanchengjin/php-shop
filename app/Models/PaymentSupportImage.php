<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSupportImage extends Model
{
    public $timestamps = false;


    public function getFullImageAttribute()
    {
        return set_full_image($this->attributes['image']);
    }
}
