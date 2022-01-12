<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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

    static function saveUser(Request $request, int $user_id)
    {
        User::where('user_id', $user_id)->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'nickname' => $request->input('nickname'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
            'password' =>  bcrypt($request->input('password')),
            'card' => $request->input('card'),
            'ua_ru' => $request->input('language') == 'ru' ? 1 : 0,
            'sex' => $request->input('sex') == 'w' ? 1 : 0,
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday'),
            'city'  => $request->input('city'),
        ]);
    }
    static function deleteUser(int $user_id)
    {
        Booking::where('user_id', $user_id)->delete();
        User::where('user_id', $user_id)->delete();
    }
}
