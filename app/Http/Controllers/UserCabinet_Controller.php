<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCabinet_Controller extends Controller
{
    public function showUser()
    {
        return view('user_cabinet', [
            'user' => User::where('user_id', Auth::guard('web')->user()->user_id)->first()
        ]);
    }
    public function save(Request $request, int $user_id)
    {
        $user = User::where('email', $request->input('email'))->get();
        if (count($user) > 1){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Такой e-mail уже существует'
            ]);
        }
        elseif(!strripos($request->input('email'), '@')){
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Не корректный e-mail'
            ]);
        }
        else
            User::saveUser($request, $user_id);

        return redirect(route('user-cabinet'));
    }
}
