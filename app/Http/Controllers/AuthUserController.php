<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authorize;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function index()
    {
        if(Auth::guard('web')->check())
            return redirect(route('main'));

        return view('auth.user_auth');
    }
    public function auth(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!isset($user->email))
        {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Такого e-mail не существует'
            ]);
        }
        $pass = Hash::check($request->input('password'), $user->password);
        if (!$pass){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'password' => 'Не верный пароль'
            ]);
        }
        else {
            $data = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            if (Auth::guard('web')->attempt($data))
                return redirect(route('main'));
        }
        return redirect(route('user-login'));
    }

    public function registration()
    {
        return view('auth.user_reg');
    }

    public function reg(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if (isset($user->email)){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Такой e-mail уже существует'
            ]);
        }
        elseif(!strripos($request->input('email'), '@')){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Не корректный e-mail'
            ]);
        }
        elseif(strlen($request->input('password')) < 6){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'password' => 'Пароль должен быть длинее 6 символов'
            ]);
        }
        elseif($request->input('password') != $request->input('confirm_password'))
        {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'confirm_password' => 'Ошибка при повторном вводе пароля'
            ]);
        }
        else {
            $data = [
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password'))
            ];
            User::insert([
                'name' => $request->input('name'),
                'surname' => $request->input('surname'),
                'nickname' => $request->input('nickname'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'password' =>  bcrypt($request->input('password')),
                'card' => $request->input('card'),
                'ua/ru' => $request->input('ua/ru') == 'ru' ? 1 : 0,
                'sex' => $request->input('sex') == 'w' ? 1 : 0,
                'phone' => $request->input('phone'),
                'birthday' => $request->input('birthday'),
                'city'  => $request->input('city'),
            ]);
            if (Auth::guard('web')->attempt($data))
                return redirect(route('main'));
        }
        return redirect(route('user_registration'));
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect(route('main'));
    }
}
