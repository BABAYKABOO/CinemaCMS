<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authorize;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    public function admin_index()
    {
        if(Auth::guard('admin')->check())
            return redirect(route('admin-statistic'));

        return view('auth.auth');
    }

    public function admin_auth(Authorize $request)
    {
        $user = Admin::where('admin_email', $request->input('admin_email'))->first();
        $pass = Hash::check($request->input('password'), $user->password);
        if (!$pass){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'password' => 'Не верный пароль'
            ]);
        }
        $data = [
            'admin_email' => $request->input('admin_email'),
            'password' => $request->input('password'),
        ];
        if (Auth::guard('admin')->attempt($data))
            return redirect(route('admin-statistic'));
        return redirect(route('admin-statistic'));
    }

    public function admin_logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect(route('main'));
    }



    public function user_index()
    {
        if(Auth::guard('web')->check())
            return redirect(url()->previous());

        return view('auth.user_auth');
    }

    public function user_auth(Request $request)
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
                if ($request->session()->has('timetable_id'))
                    return redirect(route('book',  $request->session()->pull('timetable_id')));
                else
                    return redirect(route('user-cabinet'));
        }
        return redirect(route('user-login'));
    }

    public function user_index_reg()
    {
        return view('auth.user_reg');
    }

    public function user_reg(Request $request)
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
                'password' => $request->input('password')
            ];
            User::insert([
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
            if (Auth::guard('web')->attempt($data))
                if ($request->session()->has('timetable_id'))
                    return redirect(route('book',  $request->session()->pull('timetable_id')));
                else
                    return redirect(route('user-cabinet'));
        }
    }
    public function user_logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect(route('main'));
    }
}
