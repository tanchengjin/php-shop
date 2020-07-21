<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    public $timestamps = false;

    protected $appends = [
        'full_image'
    ];

    public function getFullImageAttribute()
    {
        return set_full_image($this->attributes['image']);
    }
}
