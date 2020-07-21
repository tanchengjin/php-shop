<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'title', 'content', 'image', 'order', 'enable'
    ];

    protected $appends = [
        'full_image'
    ];

    public function getFullImageAttribute()
    {
        return set_full_image($this->attributes['image']);
    }
}
