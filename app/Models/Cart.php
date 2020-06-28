<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps=false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

}
