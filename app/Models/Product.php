<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title','description','review_count','sold_count','ratting','on_sale','price'
    ];
}
