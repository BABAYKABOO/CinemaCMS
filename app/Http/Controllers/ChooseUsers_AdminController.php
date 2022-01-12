<?php

namespace App\Http\Controllers;

use App\Filters\UsersFilter;
use App\Models\User;
use Illuminate\Http\Request;

class ChooseUsers_AdminController extends Controller
{
    public function showUsers(UsersFilter $request)
    {
        return view('admin.choose_users', [
            'users' => User::filter($request)->get()
        ]);
    }
    public function choose(Request $request)
    {
        $request->session()->forget('users');
        foreach($request->Users as $user_id)
            $request->session()->push('users', User::where('user_id', $user_id)->first());

        return redirect(route('admin-send_methods'));
    }
}
