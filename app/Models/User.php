<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'nickname',
        'email',
        'address',
        'password',
        'card',
        'ua/ru',
        'sex',
        'phone',
        'birthday',
        'city',
        'created_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        $data = explode(' ',$value);
        return $data[0];
    }

}
