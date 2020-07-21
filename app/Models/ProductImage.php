<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public $timestamps=false;
    protected $fillable=['url'];
    protected $appends=[
        'full_url'
    ];

    public function getFullUrlAttribute()
    {
        return set_full_image($this->attributes['url']);
    }
}
