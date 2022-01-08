<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authorize;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class AuthAdminController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->check())
            return redirect(route('statistic'));

        return view('auth.auth');
    }
    public function auth(Authorize $request)
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
            return redirect(route('statistic'));
        return redirect(route('statistic'));
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect(route('main'));
    }
}
