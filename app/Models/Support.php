<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $fillable = [
        'title', 'content', 'image', 'order', 'enable'
    ];
}
