<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authorize;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.auth');
    }
    public function auth(Authorize $request)
    {
        $user = Admin::where('admin_email', $request->input('email'))->first();
        //$pass = Hash::check($request->input('password'), $user->admin_password);
        if ($request->input('password') != $user->admin_password){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'password' => 'Не верный пароль'
            ]);
        }
        $auth = Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password')]);

        return route('crm');
    }
}
