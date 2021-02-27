<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    /**
     * Notifiable 是消息通知相关功能引用
     * HasFactory 是模型工厂相关功能的引用
     * Authenticatable 是授权相关功能的引用
     */
    use HasFactory, Notifiable;

    //数据库表
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * 过滤用户提交的字段，只有包含在该属性中的字段才能够被正常更新
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 当我们需要对用户密码或其它敏感信息在用户实例通过数组或 JSON 显示时进行隐藏
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
