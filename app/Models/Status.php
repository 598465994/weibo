<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    /**
     * 报错：：Add [content] to fillable property to allow mass assignment on [App\Models\Status].
     * 该报错是没有在模型中指定content字段不能被更新
     */
    protected $fillable = [
        'content'
    ];

    public function user()
    {
        //指明一条微博属于一个用户
        return $this->belongsTo(User::class);
    }
}
