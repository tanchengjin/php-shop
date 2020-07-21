<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'title', 'subtitle', 'content', 'image', 'url'
    ];

    const URL_PRODUCT = 'product';
    const URL_WEB = 'web';
    public static $urlMap = [
        self::URL_PRODUCT => '本站商品跳转',
        self::URL_WEB => '互联网跳转'
    ];
    protected $appends=[
        'full_image'
    ];


    public function getFullImageAttribute(){
        return set_full_image($this->attributes['image']);
    }
}
