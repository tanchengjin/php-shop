<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSupportImage extends Model
{
    public $timestamps = false;


    public function getFullImageAttribute()
    {
        $image = $this->attributes['image'];
        if (substr($image, 0, 4) === 'http') {
            return $image;
        } else {
            return trim(env('APP_URL')) . '/storage/' . trim($image, '/');
        }
    }
}
