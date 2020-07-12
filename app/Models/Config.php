<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    const TYPE_IMAGE = 'image';
    const TYPE_TEXT = 'text';
    const TYPE_RADIO = 'radio';

    public static $typeMap = [
        self::TYPE_IMAGE => '图片',
        self::TYPE_TEXT => '文本',
        self::TYPE_RADIO => '单选框'
    ];
}
